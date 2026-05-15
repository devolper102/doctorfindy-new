<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PharmacyMedicine;

class PopulatePharmacyMedicineSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pharmacy:populate-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate slugs for all pharmacy medicines that don\'t have one';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting to populate slugs for pharmacy medicines...');
        
        $medicines = PharmacyMedicine::whereNull('slug')
            ->orWhere('slug', '')
            ->get();
        
        $count = $medicines->count();
        
        if ($count === 0) {
            $this->info('All medicines already have slugs!');
            return 0;
        }
        
        $this->info("Found {$count} medicines without slugs. Generating slugs...");
        
        $bar = $this->output->createProgressBar($count);
        $bar->start();
        
        foreach ($medicines as $medicine) {
            $medicine->ensureSlug();
            $bar->advance();
        }
        
        $bar->finish();
        $this->newLine();
        $this->info("Successfully populated slugs for {$count} medicines!");
        
        return 0;
    }
}
