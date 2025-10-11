<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateHealthIcons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tools:update-icons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update tool icons to proper values';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $updates = [
            'BmiCalculator' => 'scale',
            'CaloriesBurnedCalculator' => 'fire',
            'WaterIntakeCalculator' => 'droplet',
            'BodySurfaceAreaCalculator' => 'body',
            'SitemapGenerator' => 'map',
        ];

        foreach ($updates as $component => $icon) {
            $updated = \DB::table('tools')
                ->where('component_name', $component)
                ->update(['icon' => $icon]);
            
            if ($updated) {
                $this->info("✓ Updated {$component} icon to {$icon}");
            }
        }

        $this->info("\n🎉 All tool icons updated successfully!");
        return 0;
    }
}
