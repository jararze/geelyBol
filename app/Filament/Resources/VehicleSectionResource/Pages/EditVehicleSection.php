<?php

namespace App\Filament\Resources\VehicleSectionResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\VehicleSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVehicleSection extends EditRecord
{
    protected static string $resource = VehicleSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
