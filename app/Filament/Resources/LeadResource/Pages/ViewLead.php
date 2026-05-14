<?php

namespace App\Filament\Resources\LeadResource\Pages;

use App\Filament\Resources\LeadResource;
use App\Models\Lead;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;

class ViewLead extends ViewRecord
{
    protected static string $resource = LeadResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        /** @var Lead $record */
        $record = $this->record;
        if ($record && $record->status === Lead::STATUS_NEW) {
            $record->update(['status' => Lead::STATUS_READ]);
        }

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('mark_contacted')
                ->label('Marcar como contactado')
                ->icon('heroicon-o-phone-arrow-up-right')
                ->color('primary')
                ->visible(fn () => $this->record->status !== Lead::STATUS_CONTACTED)
                ->action(function () {
                    $this->record->update([
                        'status' => Lead::STATUS_CONTACTED,
                        'handled_by' => auth()->id(),
                        'handled_at' => now(),
                    ]);
                    $this->fillForm();
                }),
            Action::make('mark_converted')
                ->label('Marcar como convertido')
                ->icon('heroicon-o-check-badge')
                ->color('success')
                ->action(function () {
                    $this->record->update([
                        'status' => Lead::STATUS_CONVERTED,
                        'handled_by' => auth()->id(),
                        'handled_at' => now(),
                    ]);
                    $this->fillForm();
                }),
            Action::make('archive')
                ->label('Archivar')
                ->icon('heroicon-o-archive-box')
                ->color('gray')
                ->action(function () {
                    $this->record->update(['status' => Lead::STATUS_ARCHIVED]);
                    $this->fillForm();
                }),
        ];
    }
}
