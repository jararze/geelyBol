<?php

namespace App\Filament\Resources\VehicleResource\Pages;

use App\Filament\Resources\VehicleResource;
use App\Services\VehicleBlocksDefaults;
use Filament\Resources\Pages\CreateRecord;

class CreateVehicle extends CreateRecord
{
    protected static string $resource = VehicleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['page_blocks'])) {
            $data['page_blocks'] = VehicleBlocksDefaults::generate();
        }

        return $data;
    }
}
