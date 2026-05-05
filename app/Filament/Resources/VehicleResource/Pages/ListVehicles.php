<?php

namespace App\Filament\Resources\VehicleResource\Pages;

use App\Filament\Resources\VehicleResource;
use App\Imports\VehiclesImport;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ListVehicles extends ListRecords
{
    protected static string $resource = VehicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),

            Action::make('importExcel')
                ->label('Importar desde Excel')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('primary')
                ->schema([
                    FileUpload::make('file')
                        ->label('Archivo Excel')
                        ->disk('local')
                        ->directory('imports/vehicles')
                        ->visibility('private')
                        ->acceptedFileTypes([
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            'application/vnd.ms-excel',
                        ])
                        ->required()
                        ->helperText('Solo archivos .xlsx. Use la plantilla descargable como base.'),
                ])
                ->action(function (array $data): void {
                    try {
                        $absolutePath = Storage::disk('local')->path($data['file']);
                        Excel::import(new VehiclesImport, $absolutePath);

                        Notification::make()
                            ->success()
                            ->title('Importacion completada')
                            ->body('Los vehiculos se importaron/actualizaron correctamente.')
                            ->send();
                    } catch (\Throwable $e) {
                        Notification::make()
                            ->danger()
                            ->title('Error al importar')
                            ->body($e->getMessage())
                            ->persistent()
                            ->send();
                    }
                }),

            Action::make('downloadTemplate')
                ->label('Descargar plantilla Excel')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('gray')
                ->url(fn () => route('vehicles.template'))
                ->openUrlInNewTab(),
        ];
    }
}
