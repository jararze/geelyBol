<?php

namespace App\Filament\Resources\VehicleSectionResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\VehicleSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVehicleSections extends ListRecords
{
    protected static string $resource = VehicleSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
