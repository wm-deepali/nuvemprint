<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\PricingRule;
use App\Models\PricingRuleAttribute;
use App\Models\PricingRuleAttributeQuantity;
use App\Models\PricingRuleAttributeDependency;

class CopyPricingRules extends Command
{
    /**
     * Command signature.
     *
     * Example:
     * php artisan pricing-rules:copy 5 8
     */
    protected $signature = 'pricing-rules:copy {source_subcategory_id} {target_subcategory_id}';

    protected $description = 'Copy all pricing rules (and related data) from one subcategory to another';

    public function handle()
    {
        $sourceId = $this->argument('source_subcategory_id');
        $targetId = $this->argument('target_subcategory_id');

        $this->info("Copying Pricing Rules from Subcategory #{$sourceId} → #{$targetId}...");

        $rules = PricingRule::where('subcategory_id', $sourceId)->get();

        if ($rules->isEmpty()) {
            $this->error("No pricing rules found for Subcategory ID {$sourceId}.");
            return Command::FAILURE;
        }

        $copied = 0;

        DB::beginTransaction();

        try {
            foreach ($rules as $rule) {
                // ✅ Duplicate main rule
                $newRule = $rule->replicate();
                $newRule->subcategory_id = $targetId;
                $newRule->save();

                // ✅ Fetch all attributes for this rule
                $attributes = PricingRuleAttribute::where('pricing_rule_id', $rule->id)->get();

                foreach ($attributes as $attr) {
                    $newAttr = $attr->replicate();
                    $newAttr->pricing_rule_id = $newRule->id;
                    $newAttr->save();

                    // ✅ Copy quantity ranges
                    $quantities = PricingRuleAttributeQuantity::where('pricing_rule_attribute_id', $attr->id)->get();
                    foreach ($quantities as $qty) {
                        $newQty = $qty->replicate();
                        $newQty->pricing_rule_attribute_id = $newAttr->id;
                        $newQty->save();
                    }

                    // ✅ Copy dependencies
                    $dependencies = PricingRuleAttributeDependency::where('pricing_rule_attribute_id', $attr->id)->get();
                    foreach ($dependencies as $dep) {
                        $newDep = $dep->replicate();
                        $newDep->pricing_rule_attribute_id = $newAttr->id;
                        $newDep->save();
                    }
                }

                $copied++;
            }

            DB::commit();
            $this->info("✅ Successfully copied {$copied} pricing rules to Subcategory #{$targetId}.");

            return Command::SUCCESS;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("❌ Error: " . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
