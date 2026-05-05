<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Excel as ExcelFacade;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GenerateVehiclesTemplate extends Command
{
    protected $signature = 'vehicles:generate-template';

    protected $description = 'Genera la plantilla Excel para importacion masiva de vehiculos en public/templates/vehicles_template.xlsx';

    public function handle(): int
    {
        $headings = [
            'nombre',
            'categoria',
            'precio_desde',
            'precio_ahora',
            'badge',
            'descripcion',
            'publicado',
            'motor',
            'potencia',
            'transmision',
            'traccion',
            'combustible',
            'consumo',
            'capacidad_tanque',
            'asientos',
            'largo',
            'ancho',
            'alto',
            'peso',
        ];

        $rows = [
            [
                'Starray',
                'suv',
                '32990',
                '29990',
                'NUEVO',
                'SUV familiar con tecnologia de ultima generacion.',
                'si',
                '2.0L Turbo',
                '218 HP',
                'Automatica 7DCT',
                '4x4',
                'Gasolina',
                '8.5L/100km',
                '60L',
                '7',
                '4785mm',
                '1900mm',
                '1689mm',
                '1815kg',
            ],
            [
                'Citiray',
                'suv',
                '21990',
                '19990',
                'POPULAR',
                'SUV compacto y versatil para la ciudad.',
                'si',
                '1.5L Turbo',
                '177 HP',
                'CVT',
                '4x2',
                'Gasolina',
                '7.2L/100km',
                '50L',
                '5',
                '4404mm',
                '1831mm',
                '1653mm',
                '1450kg',
            ],
        ];

        $export = new class($headings, $rows) implements FromArray, WithHeadings, WithStyles
        {
            use Exportable;

            public function __construct(private array $headings, private array $rows) {}

            public function array(): array
            {
                return $this->rows;
            }

            public function headings(): array
            {
                return $this->headings;
            }

            public function styles(Worksheet $sheet): array
            {
                return [
                    1 => ['font' => ['bold' => true]],
                ];
            }
        };

        $directory = public_path('templates');
        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $absolute = public_path('templates/vehicles_template.xlsx');
        $export->store('vehicles_template.xlsx', null, ExcelFacade::XLSX);

        $candidates = [
            storage_path('app/public/vehicles_template.xlsx'),
            storage_path('app/private/vehicles_template.xlsx'),
            storage_path('app/vehicles_template.xlsx'),
        ];

        foreach ($candidates as $candidate) {
            if (file_exists($candidate)) {
                @copy($candidate, $absolute);
                @unlink($candidate);
                break;
            }
        }

        if (! file_exists($absolute)) {
            $this->error('No se pudo generar la plantilla en '.$absolute);

            return self::FAILURE;
        }

        $this->info('Plantilla generada en '.$absolute);

        return self::SUCCESS;
    }
}
