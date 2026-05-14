<?php

namespace App\Exports;

use App\Models\Lead;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LeadsExport implements FromCollection, WithHeadings, WithMapping
{
    /** @var array<int, int> */
    protected array $leadIds;

    /** @var array<int, string> */
    protected array $dataKeys = [];

    /**
     * @param  array<int, int>|null  $leadIds
     */
    public function __construct(?array $leadIds = null)
    {
        $this->leadIds = $leadIds ?? [];
    }

    public function collection(): Collection
    {
        $query = Lead::with(['leadForm', 'vehicle', 'vehicleVersion'])->orderByDesc('created_at');

        if (! empty($this->leadIds)) {
            $query->whereIn('id', $this->leadIds);
        }

        $leads = $query->get();

        $keys = [];
        foreach ($leads as $lead) {
            foreach (array_keys($lead->data ?? []) as $key) {
                $keys[$key] = true;
            }
        }
        $this->dataKeys = array_keys($keys);

        return $leads;
    }

    public function headings(): array
    {
        return array_merge([
            'ID',
            'Formulario',
            'Estado',
            'Vehiculo',
            'Version',
            'Fecha',
            'IP',
        ], $this->dataKeys);
    }

    public function map($lead): array
    {
        $base = [
            $lead->id,
            $lead->leadForm?->name,
            $lead->status,
            $lead->vehicle?->name,
            $lead->vehicleVersion?->name,
            optional($lead->created_at)->format('Y-m-d H:i:s'),
            $lead->ip_address,
        ];

        foreach ($this->dataKeys as $key) {
            $value = $lead->data[$key] ?? null;
            if (is_array($value)) {
                $value = implode(', ', array_map(fn ($v) => is_scalar($v) ? (string) $v : json_encode($v), $value));
            }
            $base[] = $value;
        }

        return $base;
    }
}
