<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use App\Models\VehicleCategory;
use App\Models\VehicleColor;
use App\Models\VehicleFeature;
use App\Models\VehicleSpecification;
use App\Models\VehicleVersion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        // ==================== CATEGORÍAS ====================

        $suvCategory = VehicleCategory::create([
            'name' => 'SUV',
            'slug' => 'suv',
            'label' => 'SUV',
            'order' => 1,
            'is_active' => true,
            'active_color' => 'bg-purple-600 text-white',
            'inactive_color' => 'text-gray-600 hover:text-purple-600',
            'border_color' => 'border-purple-600',
        ]);

        $electricosCategory = VehicleCategory::create([
            'name' => 'ELECTRICOS',
            'slug' => 'electricos',
            'label' => 'ELÉCTRICOS',
            'order' => 2,
            'is_active' => true,
            'active_color' => 'bg-purple-600 text-white',
            'inactive_color' => 'text-gray-600 hover:text-purple-600',
            'border_color' => 'border-purple-600',
        ]);

        // ==================== VEHÍCULO 1: STARRAY ====================

        $starray = Vehicle::create([
            'vehicle_category_id' => $suvCategory->id,
            'name' => 'STARRAY',
            'slug' => 'starray',
            'description' => 'La SUV Ultra-moderna',
            'long_description' => 'SUV de alta gama con avanzada tecnología y completa seguridad',
            'image' => 'frontend/images/vehicles/starray/Geely_Bolivia_Starray_Home.png',
            'gallery' => [
                'frontend/images/vehicles/starray/gallery1.jpg',
                'frontend/images/vehicles/starray/gallery2.jpg',
            ],
            'position' => 'center',
            'featured' => true,
            'order' => 1,
            'is_active' => true,
            'currency_before' => '$us.',
            'price_before' => '46490',
            'currency_now' => '$us.',
            'price_now' => '43990',
            'discount_label' => 'Ahora',
            'from_label' => 'Desde',
            'show_from_label' => true,
            'price_before_color' => 'text-gray-500',
            'price_before_decoration' => 'line-through',
            'price_now_color' => 'text-blue-600',
            'price_now_size' => 'text-2xl',
            'price_now_weight' => 'font-bold',
            'discount_label_color' => 'text-blue-600',
            'button_bg_color' => 'bg-black',
            'button_text_color' => 'text-white',
            'button_hover_bg' => 'hover:bg-gray-800',
            'show_badge' => false,
            'catalog_pdf_path' => 'frontend/images/vehicles/starray/Ficha web Starray.pdf',
            'catalog_file_name' => 'Catálogo-Geely-Starray.pdf',
        ]);

        // Especificaciones del STARRAY (para detalle)
        VehicleSpecification::create(['vehicle_id' => $starray->id, 'key' => 'Motor', 'value' => 'Turbo 1.5L', 'order' => 1]);
        VehicleSpecification::create(['vehicle_id' => $starray->id, 'key' => 'Potencia', 'value' => '177 HP', 'order' => 2]);
        VehicleSpecification::create(['vehicle_id' => $starray->id, 'key' => 'Transmisión', 'value' => 'CVT Automática', 'order' => 3]);
        VehicleSpecification::create(['vehicle_id' => $starray->id, 'key' => 'Tracción', 'value' => 'FWD', 'order' => 4]);
        VehicleSpecification::create(['vehicle_id' => $starray->id, 'key' => 'Combustible', 'value' => 'Gasolina', 'order' => 5]);
        VehicleSpecification::create(['vehicle_id' => $starray->id, 'key' => 'Capacidad', 'value' => '5 pasajeros', 'order' => 6]);
        VehicleSpecification::create(['vehicle_id' => $starray->id, 'key' => 'Año', 'value' => '2024', 'order' => 7]);

        // Features del STARRAY (para detalle)
        VehicleFeature::create(['vehicle_id' => $starray->id, 'feature' => 'Pantalla táctil de 12.3"', 'order' => 1]);
        VehicleFeature::create(['vehicle_id' => $starray->id, 'feature' => 'Sistema de navegación GPS', 'order' => 2]);
        VehicleFeature::create(['vehicle_id' => $starray->id, 'feature' => 'Cámara de reversa 360°', 'order' => 3]);
        VehicleFeature::create(['vehicle_id' => $starray->id, 'feature' => 'Asientos de cuero premium', 'order' => 4]);
        VehicleFeature::create(['vehicle_id' => $starray->id, 'feature' => 'Aire acondicionado automático', 'order' => 5]);
        VehicleFeature::create(['vehicle_id' => $starray->id, 'feature' => 'Sistema de seguridad avanzado', 'order' => 6]);

        // Versión 1: Starray Signature 1.5 Turbo
        $starraySignature = VehicleVersion::create([
            'vehicle_id' => $starray->id,
            'name' => 'Starray Signature 1.5 Turbo',
            'code' => 'gk-2-0',
            'order' => 1,
            'is_active' => true,
            'engine_displacement' => '1.499 c.c. TURBO con 174 HP',
            'transmission' => '7 velocidades doble embrague',
            'drivetrain' => 'FWD Delantera',
            'platform' => 'CMA',
            'year' => 2026,
            'list_price' => 46490,
            'discount' => 2500,
            'final_price' => 43990,
            'currency' => '$us.',
            'motor_type' => 'Motor Turbo de 4 cilindros en línea',
            'horsepower' => '174 HP',
            'torque' => '290/2000-3500 (Nm/rpm)',
            'fuel_type' => '',
            'city_consumption' => 'FWD Delantera',
            'highway_consumption' => 'Euro VI b',
            'emission_standard' => 'Euro VI b',
            'screen' => 'Táctil HD 13.2"',
            'seats' => 'Cuero sintético',
            'climate_control' => 'Automático bi-zona',
            'camera' => 'Reversa + HD 360°',
            'sensors' => 'delantero y trasero',
            'connectivity' => 'Bluetooth, MP3, Radio Am/FM y Apple CarPlay',
            'airbags' => '6 bolsas de aire',
            'abs' => 'ABS, EBD y BA',
            'stability_control' => 'ESP',
            'brake_assist' => 'BAS',
            'traction_control' => 'TCS',
            'seatbelts' => 'Pretensores y limitadores',
            'interior_image' => 'frontend/images/vehicles/starray/Geely_Bolivia_Starray_Interior.jpg',
        ]);

        // Colores para Starray Signature
        VehicleColor::create([
            'vehicle_version_id' => $starraySignature->id,
            'name' => 'Azul',
            'code' => 'blue',
            'hex_code' => '#0000ff',
            'image' => 'frontend/images/vehicles/starray/Starray Blue.png',
            'order' => 1,
            'is_active' => true,
        ]);

        VehicleColor::create([
            'vehicle_version_id' => $starraySignature->id,
            'name' => 'Plata',
            'code' => 'silver',
            'hex_code' => '#C0C0C0',
            'image' => 'frontend/images/vehicles/starray/Starray silver20 1.png',
            'order' => 2,
            'is_active' => true,
        ]);

        VehicleColor::create([
            'vehicle_version_id' => $starraySignature->id,
            'name' => 'Negro',
            'code' => 'negro',
            'hex_code' => '#1a1a1a',
            'image' => 'frontend/images/vehicles/starray/Starray Lado Izquierdo Negra PNG.png',
            'order' => 3,
            'is_active' => true,
        ]);

        VehicleColor::create([
            'vehicle_version_id' => $starraySignature->id,
            'name' => 'Blanco',
            'code' => 'blanco',
            'hex_code' => '#FFFFFF',
            'image' => 'frontend/images/vehicles/starray/Starray Lado Izquierdo Blanca PNG.png',
            'order' => 4,
            'is_active' => true,
        ]);

        // Versión 2: Starray Platinum 2.0 Turbo
        $starrayPlatinum = VehicleVersion::create([
            'vehicle_id' => $starray->id,
            'name' => 'Starray Platinum 2.0 Turbo',
            'code' => 'gk-2-5',
            'order' => 2,
            'is_active' => true,
            'engine_displacement' => '1.969 c.c. TURBO con 218 HP',
            'transmission' => '7 velocidades doble embrague',
            'drivetrain' => 'FWD Delantera',
            'platform' => 'CMA',
            'year' => 2026,
            'list_price' => 52490,
            'discount' => 2500,
            'final_price' => 49990,
            'currency' => '$us.',
            'motor_type' => 'Motor Turbo de 4 cilindros en línea',
            'horsepower' => '218 HP',
            'torque' => '325/1800-4500 (Nm/rpm)',
            'fuel_type' => 'Gasolina',
            'city_consumption' => 'FWD Delantera',
            'highway_consumption' => 'Euro VI',
            'emission_standard' => 'Euro VI',
            'screen' => 'Táctil HD 13.2"',
            'seats' => 'Cuero sintético',
            'climate_control' => 'Automático bi-zona',
            'camera' => 'Reversa + HD 360°',
            'sensors' => 'delantero y trasero',
            'connectivity' => 'Bluetooth, MP3, Radio Am/FM y Apple CarPlay',
            'airbags' => '6 bolsas de aire',
            'abs' => 'ABS, EBD y BA',
            'stability_control' => 'ESP',
            'brake_assist' => 'BAS',
            'traction_control' => 'TCS',
            'seatbelts' => 'Pretensores y limitadores',
            'interior_image' => 'frontend/images/vehicles/starray/Geely_Bolivia_Starray_Interior.jpg',
        ]);

        // Colores para Starray Platinum (mismos)
        VehicleColor::create(['vehicle_version_id' => $starrayPlatinum->id, 'name' => 'Azul', 'code' => 'blue', 'hex_code' => '#0000ff', 'image' => 'frontend/images/vehicles/starray/Starray Blue.png', 'order' => 1, 'is_active' => true]);
        VehicleColor::create(['vehicle_version_id' => $starrayPlatinum->id, 'name' => 'Plata', 'code' => 'silver', 'hex_code' => '#C0C0C0', 'image' => 'frontend/images/vehicles/starray/Starray silver20 1.png', 'order' => 2, 'is_active' => true]);
        VehicleColor::create(['vehicle_version_id' => $starrayPlatinum->id, 'name' => 'Negro', 'code' => 'negro', 'hex_code' => '#1a1a1a', 'image' => 'frontend/images/vehicles/starray/Starray Lado Izquierdo Negra PNG.png', 'order' => 3, 'is_active' => true]);
        VehicleColor::create(['vehicle_version_id' => $starrayPlatinum->id, 'name' => 'Blanco', 'code' => 'blanco', 'hex_code' => '#FFFFFF', 'image' => 'frontend/images/vehicles/starray/Starray Lado Izquierdo Blanca PNG.png', 'order' => 4, 'is_active' => true]);

        // ==================== VEHÍCULO 2: CITYRAY ====================

        Vehicle::create([
            'vehicle_category_id' => $suvCategory->id,
            'name' => 'CITYRAY',
            'slug' => 'cityray',
            'description' => 'El SUV que impone Estilo y Tecnología',
            'image' => 'frontend/images/vehicles/cityray/Geely_Bolivia_Cityray_Home.jpg',
            'position' => 'left',
            'featured' => true,
            'order' => 2,
            'is_active' => true,
            'currency_before' => '$us.',
            'price_before' => '36490',
            'currency_now' => '$us.',
            'price_now' => '34990',
            'discount_label' => 'Ahora',
            'from_label' => 'Desde',
            'show_from_label' => true,
            'price_before_color' => 'text-gray-500',
            'price_before_decoration' => 'line-through',
            'price_now_color' => 'text-blue-600',
            'price_now_size' => 'text-xl',
            'price_now_weight' => 'font-bold',
            'discount_label_color' => 'text-blue-600',
            'button_bg_color' => 'bg-black',
            'button_text_color' => 'text-white',
            'button_hover_bg' => 'hover:bg-gray-800',
            'show_badge' => false,
            'catalog_pdf_path' => 'frontend/images/vehicles/cityray/Ficha web CityRay.pdf',
            'catalog_file_name' => 'Catálogo-Geely-CityRay.pdf',
        ]);

        // ==================== VEHÍCULO 3: GX3 PRO ====================

        Vehicle::create([
            'vehicle_category_id' => $suvCategory->id,
            'name' => 'GX3 PRO',
            'slug' => 'gx3-pro',
            'description' => 'La SUV Moderna, Práctica y Accesible',
            'image' => 'frontend/images/vehicles/gx3pro/Geely_Bolivia_GX3_PRO_Home.png',
            'position' => 'right',
            'featured' => true,
            'order' => 3,
            'is_active' => true,
            'currency_before' => '$us',
            'price_before' => '21990',
            'currency_now' => '$us.',
            'price_now' => '19990',
            'discount_label' => 'Ahora',
            'from_label' => 'Desde',
            'show_from_label' => true,
            'price_before_color' => 'text-gray-500',
            'price_before_decoration' => 'line-through',
            'price_now_color' => 'text-blue-600',
            'price_now_size' => 'text-xl',
            'price_now_weight' => 'font-bold',
            'discount_label_color' => 'text-blue-600',
            'button_bg_color' => 'bg-black',
            'button_text_color' => 'text-white',
            'button_hover_bg' => 'hover:bg-gray-800',
            'show_badge' => false,
            'catalog_pdf_path' => 'frontend/images/vehicles/gx3pro/Ficha web GX3 PRO.pdf',
            'catalog_file_name' => 'Catálogo-Geely-GX3-Pro.pdf',
        ]);

        // ==================== VEHÍCULO 4: COOLRAY ====================

        Vehicle::create([
            'vehicle_category_id' => $suvCategory->id,
            'name' => 'COOLRAY',
            'slug' => 'coolray',
            'description' => 'La SUV PERFECTA PARA LA VIDA URBANA',
            'image' => 'frontend/images/vehicles/coolray/Geely_Bolivia_Coolray_Home.png',
            'position' => 'right',
            'featured' => true,
            'order' => 4,
            'is_active' => true,
            'currency_before' => '$us',
            'price_before' => '26990',
            'currency_now' => '$us.',
            'price_now' => '25990',
            'discount_label' => 'Ahora',
            'from_label' => 'Desde',
            'show_from_label' => true,
            'price_before_color' => 'text-gray-500',
            'price_before_decoration' => 'line-through',
            'price_now_color' => 'text-blue-600',
            'price_now_size' => 'text-xl',
            'price_now_weight' => 'font-bold',
            'discount_label_color' => 'text-blue-600',
            'button_bg_color' => 'bg-black',
            'button_text_color' => 'text-white',
            'button_hover_bg' => 'hover:bg-gray-800',
            'show_badge' => false,
            'catalog_pdf_path' => 'frontend/images/vehicles/coolray/Ficha web CoolRay.pdf',
            'catalog_file_name' => 'Catálogo-Geely-CoolRay.pdf',
        ]);

        // ==================== VEHÍCULO 5: ELÉCTRICO ====================

        Vehicle::create([
            'vehicle_category_id' => $electricosCategory->id,
            'name' => 'MUY PRONTO',
            'slug' => 'muy-pronto',
            'description' => '',
            'image' => 'frontend/images/vehicles/electrico/Geely_Bolivia_Electrico_Home_Cover.png',
            'position' => 'center',
            'featured' => false,
            'order' => 1,
            'is_active' => true,
            'currency_before' => 'Bs.',
            'price_before' => '600000',
            'currency_now' => '$us.',
            'price_now' => '45000',
            'discount_label' => 'Ahora',
            'from_label' => 'Desde',
            'show_from_label' => false,
            'price_before_color' => 'text-gray-500',
            'price_before_decoration' => 'line-through',
            'price_now_color' => 'text-green-600',
            'price_now_size' => 'text-2xl',
            'price_now_weight' => 'font-bold',
            'discount_label_color' => 'text-green-600',
            'button_bg_color' => 'bg-green-600',
            'button_text_color' => 'text-white',
            'button_hover_bg' => 'hover:bg-green-700',
            'show_badge' => false,
        ]);

        $this->command->info('✅ ¡Datos cargados exitosamente!');
        $this->command->info('📊 2 Categorías | 5 Vehículos | 2 Versiones STARRAY | 8 Colores');
    }
}
