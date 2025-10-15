<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SubcategoryAttribute;
use App\Models\SubcategoryAttributeValue;

class CopySubcategoryAttributes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * Example:
     * php artisan subcategory:copy 1 2
     */
    protected $signature = 'subcategory:copy {source_id} {target_id}';

    /**
     * The console command description.
     */
    protected $description = 'Copy all attribute mappings (and values) from one subcategory to another';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sourceId = $this->argument('source_id');
        $targetId = $this->argument('target_id');

        $this->info("Copying attributes from Subcategory ID {$sourceId} → {$targetId}...");

        $sourceMappings = SubcategoryAttribute::where('subcategory_id', $sourceId)->get();

        if ($sourceMappings->isEmpty()) {
            $this->error("No attribute mappings found for subcategory {$sourceId}.");
            return Command::FAILURE;
        }

        $copied = 0;
        foreach ($sourceMappings as $mapping) {
            // Skip if target already has this attribute
            $exists = SubcategoryAttribute::where('subcategory_id', $targetId)
                ->where('attribute_id', $mapping->attribute_id)
                ->exists();

            if ($exists) {
                $this->warn("Skipped attribute ID {$mapping->attribute_id} (already exists).");
                continue;
            }

            // Copy main mapping
            $newMapping = SubcategoryAttribute::create([
                'subcategory_id' => $targetId,
                'attribute_id' => $mapping->attribute_id,
                'is_required' => $mapping->is_required,
                'sort_order' => $mapping->sort_order,
            ]);

            // Copy attribute values
            $values = SubcategoryAttributeValue::where([
                'subcategory_id' => $sourceId,
                'attribute_id' => $mapping->attribute_id,
            ])->get();

            foreach ($values as $value) {
                SubcategoryAttributeValue::create([
                    'subcategory_id' => $targetId,
                    'attribute_id' => $value->attribute_id,
                    'attribute_value_id' => $value->attribute_value_id,
                    'is_default' => $value->is_default,
                ]);
            }

            $copied++;
        }

        $this->info("✅ Successfully copied {$copied} attribute mappings (including values).");
        return Command::SUCCESS;
    }
}
