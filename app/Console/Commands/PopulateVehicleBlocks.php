<?php

namespace App\Console\Commands;

use App\Models\Vehicle;
use App\Services\VehicleBlocksDefaults;
use Illuminate\Console\Command;

class PopulateVehicleBlocks extends Command
{
    protected $signature = 'vehicles:populate-blocks {--force : Sobrescribe vehiculos que ya tienen page_blocks}';

    protected $description = 'Asigna page_blocks por defecto a los vehiculos existentes (basado en VehicleBlocksDefaults).';

    public function handle(): int
    {
        $vehicles = Vehicle::with('versions')->get();
        $total = $vehicles->count();

        if ($total === 0) {
            $this->info('No hay vehiculos en la base de datos.');

            return self::SUCCESS;
        }

        $force = (bool) $this->option('force');
        $updated = 0;
        $skipped = 0;

        $bar = $this->output->createProgressBar($total);
        $bar->start();

        foreach ($vehicles as $vehicle) {
            $hasBlocks = ! empty($vehicle->page_blocks);

            if ($hasBlocks && ! $force) {
                $skipped++;
                $bar->advance();

                continue;
            }

            $vehicle->page_blocks = VehicleBlocksDefaults::generate($vehicle);
            $vehicle->save();
            $updated++;
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("$updated vehiculos actualizados, $skipped omitidos por tener page_blocks.");

        return self::SUCCESS;
    }
}
