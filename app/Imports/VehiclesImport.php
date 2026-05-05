<?php

namespace App\Imports;

use App\Models\Vehicle;
use App\Models\VehicleCategory;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class VehiclesImport implements ToModel, WithBatchInserts, WithChunkReading, WithHeadingRow, WithValidation
{
    private const CATEGORY_ALIASES = [
        'suv' => 'suv',
        'electrico' => 'electricos',
        'electricos' => 'electricos',
        'camioneta' => 'camionetas',
        'camionetas' => 'camionetas',
    ];

    private const SPEC_KEYS = [
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

    /**
     * We persist via updateOrCreate inside model() so existing rows are matched
     * by slug instead of duplicated. Returning null prevents WithBatchInserts
     * from trying to batch-insert mismatched column sets across rows.
     */
    public function model(array $row): ?Vehicle
    {
        $name = trim((string) ($row['nombre'] ?? ''));
        if ($name === '') {
            return null;
        }

        $slug = Str::slug($name);
        $categoryId = $this->resolveCategoryId($row['categoria'] ?? null);

        $specs = [];
        foreach (self::SPEC_KEYS as $key) {
            if (array_key_exists($key, $row) && $row[$key] !== null && $row[$key] !== '') {
                $specs[$key] = (string) $row[$key];
            }
        }

        $attributes = [
            'name' => $name,
            'vehicle_category_id' => $categoryId,
            'price_before' => $this->stringOrNull($row['precio_desde'] ?? null),
            'price_now' => $this->stringOrNull($row['precio_ahora'] ?? null),
            'badge_text' => $this->stringOrNull($row['badge'] ?? null),
            'description' => $this->stringOrNull($row['descripcion'] ?? null),
            'is_published' => $this->parseBool($row['publicado'] ?? null),
            'specs' => $specs ?: null,
        ];

        if ($attributes['vehicle_category_id'] === null) {
            unset($attributes['vehicle_category_id']);
        }

        Vehicle::updateOrCreate(['slug' => $slug], $attributes);

        return null;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'categoria' => ['nullable', 'string'],
            'precio_desde' => ['nullable'],
            'precio_ahora' => ['nullable'],
        ];
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }

    private function resolveCategoryId(?string $rawCategory): ?int
    {
        if (! $rawCategory) {
            return null;
        }

        $key = Str::slug($rawCategory);
        $slug = self::CATEGORY_ALIASES[$key] ?? $key;

        return VehicleCategory::where('slug', $slug)->value('id');
    }

    private function stringOrNull($value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        return (string) $value;
    }

    private function parseBool($value): bool
    {
        if (is_bool($value)) {
            return $value;
        }

        $normalized = Str::lower(trim((string) $value));

        return in_array($normalized, ['1', 'si', 'sí', 'true', 'yes', 'publicado'], true);
    }
}
