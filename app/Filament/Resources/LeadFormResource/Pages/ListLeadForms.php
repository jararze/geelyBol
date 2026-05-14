<?php

namespace App\Filament\Resources\LeadFormResource\Pages;

use App\Filament\Resources\LeadFormResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLeadForms extends ListRecords
{
    protected static string $resource = LeadFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
