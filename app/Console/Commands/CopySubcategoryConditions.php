<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AttributeCondition;
use Illuminate\Support\Facades\DB;

class CopySubcategoryConditions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * Example:
     * php artisan copy:subcategory-conditions 2 5
     *
     * @var string
     */
    protected $signature = 'copy:subcategory-conditions {fromId} {toId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy all attribute conditions from one subcategory to another';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $fromId = $this->argument('fromId');
        $toId = $this->argument('toId');

        $this->info("Copying attribute conditions from Subcategory ID {$fromId} to Subcategory ID {$toId}...");

        DB::beginTransaction();
        try {
            $conditions = AttributeCondition::with('affectedValues')->where('subcategory_id', $fromId)->get();

            if ($conditions->isEmpty()) {
                $this->warn('No conditions found for the source subcategory.');
                return Command::SUCCESS;
            }

            foreach ($conditions as $condition) {
                $newCondition = AttributeCondition::create([
                    'subcategory_id' => $toId,
                    'parent_attribute_id' => $condition->parent_attribute_id,
                    'parent_value_id' => $condition->parent_value_id,
                    'affected_attribute_id' => $condition->affected_attribute_id,
                    'action' => $condition->action,
                ]);

                if ($condition->affectedValues->isNotEmpty()) {
                    $newCondition->affectedValues()->attach($condition->affectedValues->pluck('id')->toArray());
                }
            }

            DB::commit();

            $this->info('✅ All attribute conditions copied successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('❌ Error: ' . $e->getMessage());
        }

        return Command::SUCCESS;
    }
}
