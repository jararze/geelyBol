<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\HeroSlide;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\Promotion;
use App\Models\SalesAgent;
use App\Models\SiteSetting;
use App\Models\Vehicle;
use App\Models\VehicleHeroConfig;
use App\Models\VehicleSection;
use App\Models\VehicleSectionItem;
use Illuminate\Database\Seeder;

class FilamentDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedSiteSettings();
        $this->seedHeroSlides();
        $this->seedBranches();
        $this->seedSalesAgents();
        $this->seedPages();
        $this->seedPromotions();
        $this->seedVehicleHeroConfigs();
        $this->seedMenuItems();
        $this->seedVehicleSections();
    }

    private function seedSiteSettings(): void
    {
        $settings = [
            // General
            ['group' => 'general', 'key' => 'company_name', 'value' => 'Geely Bolivia', 'type' => 'text'],
            ['group' => 'general', 'key' => 'copyright_year', 'value' => '2025', 'type' => 'text'],
            ['group' => 'general', 'key' => 'logo_white', 'value' => '/frontend/images/logo-blanco.svg', 'type' => 'image'],
            ['group' => 'general', 'key' => 'logo_black', 'value' => 'frontend/images/logo-negro.svg', 'type' => 'image'],

            // Contact
            ['group' => 'contact', 'key' => 'phone', 'value' => '(591)2-2795000', 'type' => 'text'],
            ['group' => 'contact', 'key' => 'address', 'value' => 'Av. Costanera # 1003, Los Pinos - La Paz, Bolivia', 'type' => 'text'],
            ['group' => 'contact', 'key' => 'whatsapp_number', 'value' => '59177595558', 'type' => 'text'],
            ['group' => 'contact', 'key' => 'whatsapp_message', 'value' => 'Hola, me gustaría obtener más información sobre los vehículos Geely.', 'type' => 'text'],

            // Social
            ['group' => 'social', 'key' => 'facebook', 'value' => 'https://www.facebook.com/profile.php?id=61579700183059', 'type' => 'url'],
            ['group' => 'social', 'key' => 'instagram', 'value' => 'https://www.instagram.com/geelybolivia', 'type' => 'url'],
            ['group' => 'social', 'key' => 'youtube', 'value' => 'http://www.youtube.com/@Geely.Bolivia', 'type' => 'url'],
            ['group' => 'social', 'key' => 'tiktok', 'value' => 'https://www.tiktok.com/@geely.bo', 'type' => 'url'],

            // Tracking
            ['group' => 'tracking', 'key' => 'google_analytics_id', 'value' => 'G-NKP2SEL7DB', 'type' => 'text'],
            ['group' => 'tracking', 'key' => 'tiktok_pixel_id', 'value' => 'D2IU57RC77UFE4JPK160', 'type' => 'text'],
            ['group' => 'tracking', 'key' => 'meta_pixel_id', 'value' => '1101498498623755', 'type' => 'text'],
            ['group' => 'tracking', 'key' => 'gtm_id', 'value' => 'GTM-MV85ZF26', 'type' => 'text'],

            // Benefits
            ['group' => 'benefits', 'key' => 'benefit_1', 'value' => json_encode(['number' => '5', 'unit' => 'AÑOS', 'label' => 'GARANTÍA EXTENDIDA']), 'type' => 'json'],
            ['group' => 'benefits', 'key' => 'benefit_2', 'value' => json_encode(['number' => '150.000', 'unit' => 'KM', 'label' => '']), 'type' => 'json'],
            ['group' => 'benefits', 'key' => 'benefit_3', 'value' => json_encode(['number' => '6', 'unit' => 'SERVICIOS', 'label' => 'Y MANTENIMIENTOS INCLUIDOS']), 'type' => 'json'],
            ['group' => 'benefits', 'key' => 'benefit_4', 'value' => json_encode(['number' => '3', 'unit' => 'AÑOS', 'label' => 'EN']), 'type' => 'json'],
            ['group' => 'benefits', 'key' => 'title', 'value' => 'CON GEELY OBTIENES MÁS', 'type' => 'text'],
            ['group' => 'benefits', 'key' => 'description', 'value' => 'Geely te da los mejores beneficios y condiciones del mercado para que disfrutes al máximo tu vehículo.', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['group' => $setting['group'], 'key' => $setting['key']],
                ['value' => $setting['value'], 'type' => $setting['type']]
            );
        }
    }

    private function seedHeroSlides(): void
    {
        HeroSlide::updateOrCreate(['id' => 1], [
            'title' => 'GX3 PRO LLEGÓ',
            'subtitle' => 'El SUV compacto más esperado del año',
            'media_type' => 'image',
            'media_src' => 'frontend/images/ban2710_web.jpg',
            'media_src_mobile' => 'frontend/images/ban2710_phone.jpg',
            'gradient_from' => '#fbbf24',
            'gradient_to' => '#f59e0b',
            'button_text' => 'Descubre más',
            'button_action' => 'scroll-to-models',
            'text_color' => '#ffffff',
            'overlay_opacity' => 0.30,
            'order' => 1,
            'is_active' => true,
        ]);
    }

    private function seedBranches(): void
    {
        $branches = [
            ['name' => 'SANTA CRUZ', 'city' => 'Santa Cruz', 'address' => 'Av. Doble Vía La Guardia N° 3325 Esq. Calle Rio Vilcas, entre 3er y 4to anillo', 'map_link' => 'https://maps.app.goo.gl/YQfPVMbUyNH6RjrU8', 'order' => 1],
            ['name' => 'LA PAZ', 'city' => 'La Paz', 'address' => 'Calacoto, Calle 15 esq. Roberto Prudencio #520', 'map_link' => 'https://maps.app.goo.gl/veuGtGn2iECCP9Ez8', 'order' => 2],
            ['name' => 'EL ALTO', 'city' => 'El Alto', 'address' => 'Av. 6 de Marzo N° 1306 Frente Regimiento Ingavi', 'map_link' => 'https://maps.app.goo.gl/veuGtGn2iECCP9Ez8', 'order' => 3],
            ['name' => 'COCHABAMBA', 'city' => 'Cochabamba', 'address' => 'Av. Pando N° 1191, Recoleta', 'map_link' => 'https://maps.app.goo.gl/veuGtGn2iECCP9Ez8', 'order' => 4],
            ['name' => 'ORURO', 'city' => 'Oruro', 'address' => 'Av. 6 de Agosto #853', 'map_link' => 'https://maps.app.goo.gl/DBPsGLxpBea5TroT6', 'order' => 5],
        ];

        foreach ($branches as $branch) {
            Branch::updateOrCreate(
                ['name' => $branch['name']],
                array_merge($branch, ['is_active' => true])
            );
        }
    }

    private function seedSalesAgents(): void
    {
        $agentsByCity = [
            'Santa Cruz' => [
                ['name' => 'Pablo Beltrán', 'email' => 'pbeltran@taiyomotors.com.bo', 'served_cities' => ['santa-cruz', 'sucre', 'tarija', 'trinidad']],
                ['name' => 'Douglas Velasco', 'email' => 'dvelasco@taiyomotors.com.bo', 'served_cities' => ['santa-cruz', 'sucre', 'tarija', 'trinidad']],
            ],
            'Cochabamba' => [
                ['name' => 'Caleb Adriazola', 'email' => 'cadriazola@taiyomotors.com.bo', 'served_cities' => ['cochabamba']],
            ],
            'Oruro' => [
                ['name' => 'Ivan Baptista', 'email' => 'ibaptista@taiyomotors.com.bo', 'served_cities' => ['oruro']],
            ],
            'La Paz' => [
                ['name' => 'Luis Cupari', 'email' => 'lcupari@taiyomotors.com.bo', 'served_cities' => ['la-paz', 'potosi']],
                ['name' => 'Pablo Fernández', 'email' => 'pfernandez@taiyomotors.com.bo', 'served_cities' => ['la-paz']],
            ],
            'El Alto' => [
                ['name' => 'Alejandro Rojas', 'email' => 'arojas@taiyomotors.com.bo', 'served_cities' => ['el-alto']],
            ],
        ];

        foreach ($agentsByCity as $city => $agents) {
            $branch = Branch::where('city', $city)->first();
            if (!$branch) {
                continue;
            }

            foreach ($agents as $agent) {
                SalesAgent::updateOrCreate(
                    ['email' => $agent['email']],
                    array_merge($agent, ['branch_id' => $branch->id, 'is_active' => true])
                );
            }
        }

        // Seed vehicle section headers and image_mobile (same as image for card images)
        $vehicleHeaders = [
            'starray' => [
                'image_mobile' => 'frontend/images/vehicles/starray/Geely_Bolivia_Starray_Home.png',
                'feature_title' => 'EL SUV ULTRA MODERNO',
                'feature_subtitle' => '3 Razones para elegir a Geely Starray:',
                'versions_title' => 'VERSIONES Y PRECIOS',
                'versions_subtitle' => 'Elige tu versión de Starray',
            ],
            'gx3-pro' => [
                'image_mobile' => 'frontend/images/vehicles/gx3pro/Geely_Bolivia_GX3_PRO_Home.png',
                'feature_title' => 'Multiplica tus posibilidades',
                'feature_subtitle' => '3 razones para elegir a Geely GX3 Pro:',
                'versions_title' => 'VERSIONES Y PRECIOS',
                'versions_subtitle' => 'Elige tu versión de GX3 Pro',
            ],
            'cityray' => [
                'image_mobile' => 'frontend/images/vehicles/cityray/Geely_Bolivia_Cityray_Home.jpg',
                'feature_title' => 'El SUV Tecnológico',
                'feature_subtitle' => '3 razones para elegir a Geely Cityray:',
                'versions_title' => 'VERSIONES Y PRECIOS',
                'versions_subtitle' => 'Elige tu versión de Cityray',
            ],
            'coolray' => [
                'image_mobile' => 'frontend/images/vehicles/coolray/Geely_Bolivia_Coolray_Home.png',
                'feature_title' => 'Donde lo urbano se vuelve Premium',
                'feature_subtitle' => '3 razones para elegir a Geely COOLRAY',
                'versions_title' => 'VERSIONES Y PRECIOS',
                'versions_subtitle' => 'Elige tu versión de COOLRAY',
            ],
        ];

        foreach ($vehicleHeaders as $slug => $headers) {
            Vehicle::where('slug', $slug)->update($headers);
        }
    }

    private function seedPages(): void
    {
        Page::updateOrCreate(['slug' => 'about'], [
            'title' => 'GEELY',
            'subtitle' => null,
            'content' => 'En Geely Bolivia, ofrecemos vehículos que combinan diseño de vanguardia, tecnología avanzada y rendimiento excepcional. Descubre nuestra gama y experimenta la conducción del futuro.',
            'image' => 'frontend/images/logo-negro.svg',
            'image_mobile' => 'frontend/images/logo-negro.svg',
            'button_text' => 'Descubre más',
            'button_url' => 'https://global.geely.com/',
            'is_active' => true,
        ]);

        Page::updateOrCreate(['slug' => 'posventa'], [
            'title' => 'POSVENTA',
            'subtitle' => null,
            'content' => 'En Geely Bolivia, nos comprometemos con tu tranquilidad. Nuestro programa de posventa incluye garantía extendida, servicios de mantenimiento incluidos y atención personalizada.',
            'image' => 'frontend/images/geely-building.png',
            'image_mobile' => 'frontend/images/Geely_Bolivia_building_mobile.jpg',
            'button_text' => 'Agenda ahora',
            'button_url' => '/forms',
            'is_active' => true,
        ]);
    }

    private function seedPromotions(): void
    {
        $vehicles = Vehicle::all()->keyBy('slug');

        $promos = [
            ['slug' => 'starray', 'title' => '$us. 1,000 DE DESCUENTO', 'amount' => 1000, 'desc' => 'Aprovecha el descuento especial en Geely Starray', 'image' => 'frontend/images/prom1.png'],
            ['slug' => 'gx3-pro', 'title' => '$us. 500 DE DESCUENTO', 'amount' => 500, 'desc' => 'Aprovecha el descuento especial en Geely GX3 Pro', 'image' => 'frontend/images/vehicles/gx3pro/Geely_Bolivia_GX3_PRO_Promo.png'],
            ['slug' => 'cityray', 'title' => '$us. 2000 DE DESCUENTO', 'amount' => 2000, 'desc' => 'Aprovecha el descuento especial en Geely Cityray', 'image' => 'frontend/images/vehicles/cityray/Geely_Bolivia_Promociones.png'],
            ['slug' => 'coolray', 'title' => '$us. 1500 DE DESCUENTO', 'amount' => 1500, 'desc' => 'Aprovecha el descuento especial en Geely Coolray', 'image' => 'frontend/images/vehicles/coolray/GEELY_BOLIVIA_COOLRAY_DESCUENTOS.png'],
        ];

        foreach ($promos as $i => $promo) {
            $vehicle = $vehicles->get($promo['slug']);
            Promotion::updateOrCreate(
                ['title' => $promo['title'], 'vehicle_id' => $vehicle?->id],
                [
                    'description' => $promo['desc'],
                    'discount_amount' => $promo['amount'],
                    'discount_currency' => '$us.',
                    'image' => $promo['image'],
                    'image_mobile' => $promo['image'],
                    'button_text' => 'Cotizar ahora',
                    'button_url' => '/forms',
                    'order' => $i + 1,
                    'is_active' => true,
                ]
            );
        }
    }

    private function seedVehicleHeroConfigs(): void
    {
        $configs = [
            'starray' => [
                'background_image' => 'frontend/images/vehicles/starray/Geely_Bolivia_Starray_Hero_Desktop.jpg',
                'background_image_mobile' => 'frontend/images/vehicles/starray/Geely_Bolivia_Starray_Hero_Mobile.jpg',
                'title_type' => 'image',
                'title_image' => 'frontend/images/vehicles/starray/Geely_Starray_Logo.png',
                'title' => 'STARRAY',
                'title_color' => '#ffffff',
                'subtitle' => 'El SUV más impactante',
                'subtitle_color' => '#ffffff',
                'text_color' => '#ffffff',
                'specs_text_color' => '#000000',
                'selected_specs' => [
                    ['key' => 'motor', 'prefix' => 'Hasta', 'value' => '2.0', 'unit' => 'Turbo', 'label' => 'Motor'],
                    ['key' => 'potencia', 'prefix' => 'Hasta', 'value' => '218', 'unit' => 'hp', 'label' => 'Potencia'],
                    ['key' => 'velocidades', 'prefix' => '', 'value' => '7', 'unit' => 'Velocidades', 'label' => 'Transmisión DCT'],
                    ['key' => 'plataforma', 'prefix' => '', 'value' => 'CMA', 'unit' => '', 'label' => 'Plataforma Europea'],
                ],
            ],
            'gx3-pro' => [
                'background_image' => 'frontend/images/vehicles/gx3pro/Geely_Bolivia_GX3PRO_Hero_Desktop.jpg',
                'background_image_mobile' => 'frontend/images/vehicles/gx3pro/Geely_Bolivia_GX3PRO_Hero_Mobile.jpg',
                'title_type' => 'text',
                'title' => 'GX3 PRO',
                'title_color' => '#000000',
                'subtitle' => 'SUV Práctico y dinámico',
                'subtitle_color' => '#000000',
                'text_color' => '#000000',
                'specs_text_color' => '#000000',
                'selected_specs' => [
                    ['key' => 'motor', 'prefix' => '', 'value' => '1.5', 'unit' => '', 'label' => 'Motor'],
                    ['key' => 'potencia', 'prefix' => '', 'value' => '103', 'unit' => 'hp', 'label' => 'Potencia'],
                    ['key' => 'velocidades', 'prefix' => '', 'value' => '8', 'unit' => '', 'label' => 'Velocidades'],
                    ['key' => 'traccion', 'prefix' => '', 'value' => 'CVT', 'unit' => '', 'label' => 'Transmisión'],
                ],
            ],
            'cityray' => [
                'background_image' => 'frontend/images/vehicles/cityray/Geely_Bolivia_Cityray_Hero_Desktop_blanco.jpg.jpeg',
                'background_image_mobile' => 'frontend/images/vehicles/cityray/Geely_Bolivia_Cityray_Hero_Mobile_blanco.jpg.jpeg',
                'title_type' => 'text',
                'title' => 'CITYRAY',
                'title_color' => '#FFFFFF',
                'subtitle' => 'La SUV que impone Estilo y Tecnología',
                'subtitle_color' => '#FFFFFF',
                'text_color' => '#FFFFFF',
                'specs_text_color' => '#ffffff',
                'selected_specs' => [
                    ['key' => 'motor', 'prefix' => '', 'value' => '1.5', 'unit' => 'Turbo', 'label' => 'Motor'],
                    ['key' => 'potencia', 'prefix' => '', 'value' => '174', 'unit' => 'hp', 'label' => 'Potencia'],
                    ['key' => 'velocidades', 'prefix' => '', 'value' => '7', 'unit' => 'Velocidades', 'label' => 'Transmisión DCT'],
                    ['key' => 'traccion', 'prefix' => '', 'value' => '4', 'unit' => '', 'label' => 'Modos de conducción'],
                ],
            ],
            'coolray' => [
                'background_image' => 'frontend/images/vehicles/coolray/1 GEELY_BOLIVIA_COOLRAY.jpg',
                'background_image_mobile' => 'frontend/images/vehicles/coolray/Geely_Bolivia_Coolray_Hero_Mobile.jpg',
                'title_type' => 'text',
                'title' => 'COOLRAY',
                'title_color' => '#FFFFFF',
                'subtitle' => 'SUV PERFECTA PARA LA VIDA URBANA',
                'subtitle_color' => '#FFFFFF',
                'text_color' => '#FFFFFF',
                'specs_text_color' => '#000000',
                'selected_specs' => [
                    ['key' => 'motor', 'prefix' => '', 'value' => '1.5', 'unit' => '', 'label' => 'Motor'],
                    ['key' => 'potencia', 'prefix' => '', 'value' => '122', 'unit' => 'hp', 'label' => 'Potencia'],
                    ['key' => 'velocidades', 'prefix' => '', 'value' => '5', 'unit' => '', 'label' => 'Velocidades'],
                    ['key' => 'traccion', 'prefix' => '', 'value' => '5', 'unit' => 'MT|CVT', 'label' => 'Transmisión'],
                ],
            ],
            'galaxy-e5' => [
                'background_image' => 'frontend/images/vehicles/ex5/Geely_Bolivia_EX5_Desktop.jpg',
                'background_image_mobile' => 'frontend/images/vehicles/ex5/Geely_Bolivia_EX5_Mobile.jpg',
                'title_type' => 'image',
                'title_image' => 'frontend/images/vehicles/ex5/logo_EX5_web.png',
                'title' => '',
                'title_color' => '#FFFFFF',
                'subtitle' => '',
                'subtitle_color' => '#FFFFFF',
                'text_color' => '#FFFFFF',
                'specs_text_color' => '#000000',
                'selected_specs' => [],
            ],
        ];

        foreach ($configs as $slug => $config) {
            $vehicle = Vehicle::where('slug', $slug)->first();
            if (!$vehicle) {
                continue;
            }

            VehicleHeroConfig::updateOrCreate(
                ['vehicle_id' => $vehicle->id],
                array_merge($config, ['is_active' => true])
            );
        }
    }

    private function seedMenuItems(): void
    {
        $vehiculos = MenuItem::updateOrCreate(
            ['label' => 'Vehículos', 'location' => 'header'],
            ['url' => '#modelos', 'order' => 1, 'is_active' => true]
        );

        $subMenuItems = [
            ['label' => 'SUV', 'url' => '#modelos', 'order' => 1],
            ['label' => 'Eléctricos', 'url' => '#modelos', 'order' => 2],
            ['label' => 'Camionetas', 'url' => '#modelos', 'order' => 3],
        ];

        foreach ($subMenuItems as $item) {
            MenuItem::updateOrCreate(
                ['label' => $item['label'], 'parent_id' => $vehiculos->id],
                array_merge($item, ['location' => 'header', 'is_active' => true])
            );
        }

        $topLevelItems = [
            ['label' => 'Direcciones', 'url' => '#direcciones', 'order' => 2],
            ['label' => 'Sobre Geely', 'url' => '#about', 'order' => 3],
            ['label' => 'Servicios', 'url' => '#servicios', 'order' => 4],
        ];

        foreach ($topLevelItems as $item) {
            MenuItem::updateOrCreate(
                ['label' => $item['label'], 'location' => 'header'],
                array_merge($item, ['location' => 'header', 'is_active' => true])
            );
        }

        $posventa = MenuItem::updateOrCreate(
            ['label' => 'Posventa', 'location' => 'header'],
            ['url' => '#posventa', 'order' => 5, 'is_active' => true]
        );

        $posventaSub = [
            ['label' => 'Test Drive', 'url' => '/forms', 'order' => 1],
            ['label' => 'Beneficios', 'url' => '#beneficios', 'order' => 2],
            ['label' => 'Ver Todo', 'url' => '#posventa', 'order' => 3],
        ];

        foreach ($posventaSub as $item) {
            MenuItem::updateOrCreate(
                ['label' => $item['label'], 'parent_id' => $posventa->id],
                array_merge($item, ['location' => 'header', 'is_active' => true])
            );
        }

        MenuItem::updateOrCreate(
            ['label' => 'Contáctanos', 'location' => 'header'],
            ['url' => '/forms', 'order' => 6, 'is_active' => true]
        );
    }

    private function seedVehicleSections(): void
    {
        $this->seedFeatureSliderSections();
        $this->seedTestDriveSections();
        $this->seedVideoReviewSections();
        $this->seedGallerySections();
        $this->seedSectionBreakerSections();
    }

    private function seedSectionBreakerSections(): void
    {
        $configs = [
            'starray' => [
                'content' => [
                    'title' => 'GEELY STARRAY',
                    'subtitle' => 'Caracteristicas',
                    'title_size' => 'text-4xl lg:text-4xl',
                    'subtitle_size' => 'text-lg lg:text-xl',
                    'title_color' => 'text-blue-600',
                    'subtitle_color' => 'text-black',
                    'title_font_weight' => 'font-bold',
                    'subtitle_font_weight' => 'font-normal',
                    'text_align' => 'text-left',
                    'max_width' => 'max-w-full',
                    'spacing' => 'space-y-4',
                ],
                'styles' => [
                    'title_gradient' => false,
                    'title_gradient_colors' => 'bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent',
                    'subtitle_gradient' => false,
                    'subtitle_gradient_colors' => 'bg-gradient-to-r from-gray-600 to-gray-800 bg-clip-text text-transparent',
                ],
            ],
            'gx3-pro' => [
                'content' => [
                    'title' => 'GEELY GX3 PRO',
                    'subtitle' => 'Caracteristicas',
                    'title_size' => 'text-4xl lg:text-4xl',
                    'subtitle_size' => 'text-lg lg:text-xl',
                    'title_color' => 'text-blue-900',
                    'subtitle_color' => 'text-black',
                    'title_font_weight' => 'font-bold',
                    'subtitle_font_weight' => 'font-normal',
                    'text_align' => 'text-left',
                    'max_width' => 'max-w-full',
                    'spacing' => 'space-y-4',
                ],
                'styles' => [
                    'title_gradient' => false,
                    'title_gradient_colors' => 'bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent',
                    'subtitle_gradient' => false,
                    'subtitle_gradient_colors' => 'bg-gradient-to-r from-gray-600 to-gray-800 bg-clip-text text-transparent',
                ],
            ],
            'cityray' => [
                'content' => [
                    'title' => 'GEELY CITYRAY',
                    'subtitle' => 'Caracteristicas',
                    'title_size' => 'text-4xl lg:text-4xl',
                    'subtitle_size' => 'text-lg lg:text-xl',
                    'title_color' => 'text-blue-900',
                    'subtitle_color' => 'text-black',
                    'title_font_weight' => 'font-bold',
                    'subtitle_font_weight' => 'font-normal',
                    'text_align' => 'text-left',
                    'max_width' => 'max-w-full',
                    'spacing' => 'space-y-4',
                ],
                'styles' => [
                    'title_gradient' => false,
                    'title_gradient_colors' => 'bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent',
                    'subtitle_gradient' => false,
                    'subtitle_gradient_colors' => 'bg-gradient-to-r from-gray-600 to-gray-800 bg-clip-text text-transparent',
                ],
            ],
            'coolray' => [
                'content' => [
                    'title' => 'GEELY COOLRAY',
                    'subtitle' => 'Caracteristicas',
                    'title_size' => 'text-4xl lg:text-4xl',
                    'subtitle_size' => 'text-lg lg:text-xl',
                    'title_color' => 'text-blue-900',
                    'subtitle_color' => 'text-black',
                    'title_font_weight' => 'font-bold',
                    'subtitle_font_weight' => 'font-normal',
                    'text_align' => 'text-left',
                    'max_width' => 'max-w-full',
                    'spacing' => 'space-y-4',
                ],
                'styles' => [
                    'title_gradient' => false,
                    'title_gradient_colors' => 'bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent',
                    'subtitle_gradient' => false,
                    'subtitle_gradient_colors' => 'bg-gradient-to-r from-gray-600 to-gray-800 bg-clip-text text-transparent',
                ],
            ],
        ];

        foreach ($configs as $slug => $config) {
            $vehicle = Vehicle::where('slug', $slug)->first();
            if (!$vehicle) continue;

            VehicleSection::updateOrCreate(
                ['vehicle_id' => $vehicle->id, 'section_type' => 'section_breaker'],
                [
                    'title' => $config['content']['title'] ?? 'Section Breaker',
                    'config' => $config,
                    'order' => 0,
                    'is_active' => true,
                ]
            );
        }
    }

    private function seedFeatureSliderSections(): void
    {
        $vehicleSections = [
            'starray' => [
                'potente_dinamico' => [
                    'title' => 'POTENTE Y DINAMICO',
                    'config' => ['direction' => 'left', 'section_key' => 'potente_dinamico'],
                    'order' => 1,
                    'items' => [
                        ['title' => 'Motor 2.0 Turbo', 'subtitle' => '218 hp Potencia', 'description' => 'Motor 2.0 Turbo con 218 hp que te brinda respuesta rápida en ciudad y potencia constante en carretera. El poder que necesitas, cuando lo necesites.', 'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente0.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Estabilidad y Seguridad', 'subtitle' => 'PLATAFORMA CMA', 'description' => 'Una arquitectura modular e inteligente que garantiza agilidad, potencia y la máxima seguridad cada vez que conduzcas.', 'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente1.jpg', 'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'],
                        ['title' => 'POTENTE Y DINAMICO', 'subtitle' => 'Máxima Fluidez / Transmisión DCT de 7 Velocidades', 'description' => 'Te ofrece el arranque perfecto para cada situación, asegurando una respuesta inmediata al acelerador y una conducción excepcionalmente fluida.', 'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente2.jpg', 'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'],
                        ['title' => 'Máxima Fluidez', 'subtitle' => 'Transmisión DCT de 7 Velocidades', 'description' => 'Te ofrece el arranque perfecto para cada situación, asegurando una respuesta inmediata al acelerador y una conducción excepcionalmente fluida.', 'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente02.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Frenado', 'subtitle' => 'de 100KM a 0Km', 'description' => 'El verdadero poder no solo es acelerar, sino saber detenerse. Starray redefine la seguridad en la categoría con una distancia de frenado líder en su clase desde 100 km/h.', 'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente3.jpg', 'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'],
                        ['title' => 'Conducción', 'subtitle' => '3 Modos de Conducción', 'description' => 'Con los modos de conducción seleccionables, transforma tu Starray al instante para adaptarla a tus preferencias. Elige entre una conducción orientada a la eficiencia con el modo Eco, una que privilegia el Comfort, o una que maximiza la respuesta para una experiencia más dinámica con el modo Sport.', 'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente4.jpg', 'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'],
                        ['title' => 'Prueba del Alce', 'subtitle' => 'Prueba del Alce', 'description' => 'Con el rendimiento líder en la Prueba del Alce, Starray demuestra estabilidad en situaciones de emergencia y control excepcional para maniobras rápidas y seguras.', 'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente5.jpg', 'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'],
                    ],
                ],
                'interior_lujoso' => [
                    'title' => 'INTERIOR LUJOSO Y TOTALMENTE EQUIPADO',
                    'config' => ['direction' => 'right', 'section_key' => 'interior_lujoso'],
                    'order' => 2,
                    'items' => [
                        ['title' => 'Espacios de Almacenamiento', 'subtitle' => '', 'description' => 'Con 32 espacios de almacenamiento inteligentemente ubicados en toda la cabina, Starray está diseñada para adaptarse a todas tus necesidades de espacio y confort.', 'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior10.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Pantalla 13.2" HD', 'subtitle' => '', 'description' => 'Experimenta la pantalla de Starray con una visualización nítida y una interfaz intuitiva diseñada para una interacción fluida y sin distracciones.', 'main_image' => 'frontend/images/vehicles/starray/interior/Starray Pantalla.png', 'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'],
                        ['title' => 'Diseño y Comodidad', 'subtitle' => '', 'description' => 'Relájate en asientos de ecocuero de alta calidad, que combinan una estética moderna con un soporte superior, ajuste eléctrico y función de memoria.', 'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior8.jpg', 'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'],
                        ['title' => 'Techo Panorámico', 'subtitle' => 'Más Grande de su Clase', 'description' => 'El lujo es espacio y luminosidad. El techo panorámico de Starray llena la cabina de luz natural, creando una sensaciòn de apertura sin límites.', 'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior2.jpg', 'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'],
                        ['title' => 'Diseño Interior Bi-tono', 'subtitle' => '', 'description' => 'El lujo es visual y sensorial. El diseño interior bi-tono de la Starray eleva la cabina a un nuevo nivel de sofisticación, modernidad y elegancia.', 'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior3.jpg', 'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'],
                        ['title' => 'Sistema de Sonido', 'subtitle' => 'Infinity by Harman', 'description' => '9 parlantes diseñados para envolverte en un sonido multidimensional y de alta calidad.', 'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior5.jpg', 'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'],
                        ['title' => 'Cargador Inalámbrico', 'subtitle' => '', 'description' => 'Mantén tu celular con energía gracias al cargador inalámbrico de 15 watts.', 'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior4.jpg', 'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'],
                        ['title' => 'HUD Holográfico de 25.2"', 'subtitle' => '', 'description' => 'El copiloto que te permite mantener la mirada en el camino, proyectando información vital como la velocidad y las indicaciones de navegación directamente en tu campo de visión.', 'main_image' => 'frontend/images/vehicles/starray/interior/Geely_Bolivia_Starray_Interior9.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Visores de Sol con Lentes Integradas', 'subtitle' => '', 'description' => 'El lujo está en los pequeños detalles: los visores de sol de Starray, únicos en el mundo, reducen el resplandor y mejoran la visibilidad en los días soleados.', 'main_image' => 'frontend/images/vehicles/starray/interior/ViseraStarray-ezgif.com-webp-to-jpg-converter.jpg', 'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'],
                    ],
                ],
                'tecnologia' => [
                    'title' => 'TECNOLOGÍA: TABLET, HUD HOLOGRÁFICO Y MÁS',
                    'config' => ['direction' => 'left', 'section_key' => 'tecnologia'],
                    'order' => 3,
                    'items' => [
                        ['title' => 'Pantalla 13.2" HD', 'subtitle' => '', 'description' => 'Experimenta la pantalla de Starray con una visualización nítida y una interfaz intuitiva, diseñada para una interacción fluida y sin distracciones.', 'main_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia1.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Pantalla 13.2" HDHUD Holográfico de 25.2', 'subtitle' => '', 'description' => 'Experimenta la pantalla de Starray con una visualización nítida y una interfaz intuitiva diseñada para una interacción fluida y sin distracciones.', 'main_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia2.jpg', 'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'],
                        ['title' => 'Pantalla 13.2" HD', 'subtitle' => '', 'description' => 'El copiloto que te permite mantener la mirada en el camino, proyectando información vital como la velocidad y las indicaciones de navegación directamente en tu campo de visión.', 'main_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia3.jpg', 'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'],
                        ['title' => '', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia4.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Sistema de Sonido', 'subtitle' => 'Infinity by Harman', 'description' => '9 parlantes diseñados para envolverte en un sonido multidimensional y de alta calidad.', 'main_image' => 'frontend/images/vehicles/starray/tecnologia/Geely_Bolivia_Starray_Tecnologia5.jpg', 'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'],
                    ],
                ],
                'seguridad' => [
                    'title' => 'SEGURIDAD TOTAL: MÁS DE 8 ASISTENTES SMART',
                    'config' => ['direction' => 'right', 'section_key' => 'seguridad'],
                    'order' => 4,
                    'items' => [
                        ['title' => 'Sistema ADAS', 'subtitle' => '', 'description' => 'Desde mantenerte en tu carril hasta alertarte sobre una posible colisión, el sistema completo de ADAS trabaja en conjunto para prevenir accidentes y hacer cada viaje más seguro.', 'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_Seguridad1.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Visión de Starray de 540°', 'subtitle' => '', 'description' => 'Elimina todos los puntos ciegos con la visión panorámica de 540°, para una precisión milimétrica en estacionamientos y maniobras.', 'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_seguridad2.jpg', 'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'],
                        ['title' => 'Control Crucero Adaptativo', 'subtitle' => '', 'description' => 'Es un asistente inteligente que se encarga de mantener automáticamente una distancia segura con el vehículo de adelante, frenando y acelerando por ti.', 'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_seguridad3.jpg', 'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'],
                        ['title' => '', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_seguridad4.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => '', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_seguridad5.jpg', 'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'],
                        ['title' => '', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_seguridad6.jpg', 'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'],
                        ['title' => '', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_seguridad7.jpg', 'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'],
                        ['title' => '', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_seguridad8.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => '', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/starray/seguridad/Geely_Bolivia_Starray_seguridad9.jpg', 'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'],
                    ],
                ],
            ],

            'gx3-pro' => [
                'potente_dinamico' => [
                    'title' => 'POTENTE Y COMPACTA',
                    'config' => ['direction' => 'left', 'section_key' => 'potente_dinamico'],
                    'order' => 1,
                    'items' => [
                        ['title' => '1.5 Motor', 'subtitle' => '103 HP Potencia', 'description' => 'La SUV que necesitas para la ciudad y la vida urbana.', 'main_image' => 'frontend/images/vehicles/gx3pro/potenteydinamico/GX3 Pro Aro.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => '', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/gx3pro/potenteydinamico/Geely_Bolivia_GX3_PRO_2.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => '', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/gx3pro/potenteydinamico/Geely_Bolivia_GX3_PRO_3.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => '', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/gx3pro/potenteydinamico/Geely_Bolivia_GX3_PRO_4.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => '', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/gx3pro/potenteydinamico/Geely_Bolivia_GX3_PRO_11.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                    ],
                ],
                'interior_lujoso' => [
                    'title' => 'TOTALMENTE EQUIPADA',
                    'config' => ['direction' => 'right', 'section_key' => 'interior_lujoso'],
                    'order' => 2,
                    'items' => [
                        ['title' => '', 'subtitle' => '', 'description' => 'Pantalla de 8" con CarLink, asientos de ecocuero y techo solar', 'main_image' => 'frontend/images/vehicles/gx3pro/interior/Geely_Bolivia_GX3_PRO_Interior_1.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => '', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/gx3pro/interior/Geely_Bolivia_GX3_PRO_Interior_2.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => '', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/gx3pro/interior/Geely_Bolivia_GX3_PRO_Interior_9.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => '', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/gx3pro/interior/Geely_Bolivia_GX3_PRO_Interior_10.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => '', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/gx3pro/interior/Geely_Bolivia_GX3_PRO_Interior_12.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                    ],
                ],
                'seguridad' => [
                    'title' => 'SEGURIDAD INTEGRAL',
                    'config' => ['direction' => 'left', 'section_key' => 'seguridad'],
                    'order' => 3,
                    'items' => [
                        ['title' => '', 'subtitle' => '', 'description' => 'Carrocería diseñada para absorber y disipar la energía de un impacto, protegiendo la integridad de los pasajeros.', 'main_image' => 'frontend/images/vehicles/gx3pro/seguridad/Geely_Bolivia_GX3_PRO_5.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => '', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/gx3pro/seguridad/Geely_Bolivia_GX3_PRO_8.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                    ],
                ],
            ],

            'cityray' => [
                'potente_dinamico' => [
                    'title' => 'POTENTE Y DINÁMICO',
                    'config' => ['direction' => 'left', 'section_key' => 'potente_dinamico'],
                    'order' => 1,
                    'items' => [
                        ['title' => 'Motor', 'subtitle' => '1.5 Turbo', 'description' => 'Con 174 hp para un desempeño dinámico', 'main_image' => 'frontend/images/vehicles/cityray/potenteydinamico/1.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Potente', 'subtitle' => 'Dinámico', 'description' => 'Transmisión DCT de 7 velocidades que entrega un manejo ágil y eficiente', 'main_image' => 'frontend/images/vehicles/cityray/potenteydinamico/2.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Frenado', 'subtitle' => '', 'description' => 'Sistema de frenado avanzado con ABS, EBD y BA que conforman un sistema de conducción inteligente y urbano', 'main_image' => 'frontend/images/vehicles/cityray/potenteydinamico/3.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Conducción', 'subtitle' => '', 'description' => '4 modos de conducción Economy/Sport/Comfort/Intelligent que se ajustan a tus preferencias', 'main_image' => 'frontend/images/vehicles/cityray/potenteydinamico/4.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Seguridad avanzada', 'subtitle' => '', 'description' => 'con control crucero adaptativo para mantener una velocidad constante y una distancia segura, lo que permite un viaje más suave y menos estresante.', 'main_image' => 'frontend/images/vehicles/cityray/potenteydinamico/5.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                    ],
                ],
                'interior_lujoso' => [
                    'title' => 'INTERIOR LUJOSO Y TOTALMENTE EQUIPADO',
                    'config' => ['direction' => 'right', 'section_key' => 'interior_lujoso'],
                    'order' => 2,
                    'items' => [
                        ['title' => 'Interior Premium', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/cityray/interior/1 Geely_Bolivia_Techo Solar Pano.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Techo solar panorámico', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/cityray/interior/2 Geely_Bolivia_Techo Solar Pano.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Pantalla táctil HD de 13.2"', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/cityray/interior/3 Geely_Bolivia_Pantalla Tactil HD.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Diseño moderno', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/cityray/interior/4 Geely_Bolvia_Diseño Moderno.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Interior Premium con Iluminación ambiente', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/cityray/interior/5 Geely_Bolivia_Interior premium iluminado.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Cargador inalámbrico', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/cityray/interior/6 Geely_Bolivia_Cargador Inalambrico.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Espacios amplios', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/cityray/interior/7 Geely_Bolivia_Espacios Amplios.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Detalles Estilizados', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/cityray/interior/8.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Comodidad', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/cityray/interior/9.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Confort', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/cityray/interior/10.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                    ],
                ],
                'tecnologia' => [
                    'title' => 'TECNOLOGÍA: TABLET, HUD HOLOGRÁFICO Y MÁS',
                    'config' => ['direction' => 'left', 'section_key' => 'tecnologia'],
                    'order' => 3,
                    'items' => [
                        ['title' => 'Pantalla táctil HD de 13.2"', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/cityray/tecnologia/1 Geely_Bolivia_Pantalla Tactil HD.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Panel de instrumentos digital LCD de 10.2"', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/cityray/tecnologia/2 Geely_Bolivia_Panel de instrumentos.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Apple CarPlay®', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/cityray/tecnologia/3 Geely_Bolivia_AppleCarPlay.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Portón trasero eléctrico', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/cityray/tecnologia/4.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Tablero Ergonómico intuitivo', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/cityray/tecnologia/5.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                    ],
                ],
                'seguridad' => [
                    'title' => 'SEGURIDAD TOTAL: MÁS DE 8 ASISTENTES SMART',
                    'config' => ['direction' => 'right', 'section_key' => 'seguridad'],
                    'order' => 4,
                    'items' => [
                        ['title' => 'Cámara 360°', 'subtitle' => 'Que te muestran todo lo que hay alrededor del auto y debajo, para no tener ningún obstáculo', 'description' => '', 'main_image' => 'frontend/images/vehicles/cityray/seguridad/6.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Control Crucero Adaptativo', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/cityray/seguridad/2 Geely_Bolivia_Control Crucero.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Bolsas de aire frontales, laterales y de cortina', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/cityray/seguridad/3 Geely_Bolivia_Airbags.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Sistema de control de tracción (TCS), Sistema electrónico de estabilidad (ESP®), Asistente de ascenso en pendiente (HAC) y Asistente de descenso en pendiente (HDC)', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/cityray/seguridad/4.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Frenado automático de emergencia (AEB)', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/cityray/seguridad/5.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => '', 'subtitle' => '', 'description' => '', 'main_image' => 'frontend/images/vehicles/cityray/seguridad/1 Geely_Bolivia_Camara 360.jpg', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                    ],
                ],
            ],

            'coolray' => [
                'potente_dinamico' => [
                    'title' => 'MODERNA Y EXCLUSIVA',
                    'config' => ['direction' => 'left', 'section_key' => 'potente_dinamico'],
                    'order' => 1,
                    'items' => [
                        ['title' => 'Motor 1.5 Turbo', 'subtitle' => '122 HP Potencia', 'description' => 'La SUV que necesitas para la ciudad y la vida urbana', 'main_image' => 'frontend/images/vehicles/coolray/potenteydinamico/1.png', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Estilo Moderno y Vanguardista', 'subtitle' => '', 'description' => 'Combinando tecnología y diseño para destacar en cada recorrido', 'main_image' => 'frontend/images/vehicles/coolray/potenteydinamico/2.png', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Diseño Moderno y Elegante', 'subtitle' => '', 'description' => 'Un estilo urbano que combina dinamismo y sofisticación.', 'main_image' => 'frontend/images/vehicles/coolray/potenteydinamico/3.png', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Espacio Versátil y Práctico', 'subtitle' => '', 'description' => 'Un maletero amplio que se adapta a tus aventuras y necesidades diarias.', 'main_image' => 'frontend/images/vehicles/coolray/potenteydinamico/4.png', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Luces LED de Última Generación', 'subtitle' => '', 'description' => 'Un diseño distintivo que realza la seguridad y la personalidad del vehículo.', 'main_image' => 'frontend/images/vehicles/coolray/potenteydinamico/5.png', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                    ],
                ],
                'interior_lujoso' => [
                    'title' => 'TOTALMENTE EQUIPADA Y VERSÁTIL',
                    'config' => ['direction' => 'right', 'section_key' => 'interior_lujoso'],
                    'order' => 2,
                    'items' => [
                        ['title' => 'Elegancia en Cada Detalle', 'subtitle' => '', 'description' => 'Asientos de ecocuero que brindan comodidad y estilo', 'main_image' => 'frontend/images/vehicles/coolray/interior/1.png', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Volante Multi-Función', 'subtitle' => '', 'description' => 'Control total al alcance de tus manos para una conducción cómoda y segura.', 'main_image' => 'frontend/images/vehicles/coolray/interior/2.png', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Transmisión Eficiente', 'subtitle' => '', 'description' => 'Cambios suaves y precisos que garantizan una experiencia de manejo fluida.', 'main_image' => 'frontend/images/vehicles/coolray/interior/3.png', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                    ],
                ],
                'seguridad' => [
                    'title' => 'SEGURIDAD INTEGRAL',
                    'config' => ['direction' => 'left', 'section_key' => 'seguridad'],
                    'order' => 3,
                    'items' => [
                        ['title' => 'Seguridad al Estacionar', 'subtitle' => '', 'description' => 'Sensores traseros que cuidan cada maniobra.', 'main_image' => 'frontend/images/vehicles/coolray/seguridad/1.png', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                        ['title' => 'Confianza en Cada Ruta', 'subtitle' => '', 'description' => 'Sistema de frenos ABS+EBD que responde cuando más lo necesitas.', 'main_image' => 'frontend/images/vehicles/coolray/seguridad/2.png', 'background_overlay' => 'bg-gradient-to-r from-blue-600/80 to-transparent'],
                    ],
                ],
            ],
        ];

        foreach ($vehicleSections as $slug => $sections) {
            $vehicle = Vehicle::where('slug', $slug)->first();
            if (!$vehicle) continue;

            foreach ($sections as $sectionKey => $sectionData) {
                $section = VehicleSection::updateOrCreate(
                    ['vehicle_id' => $vehicle->id, 'section_type' => 'feature_slider', 'title' => $sectionData['title']],
                    [
                        'config' => $sectionData['config'],
                        'order' => $sectionData['order'],
                        'is_active' => true,
                    ]
                );

                // Clear existing items and recreate
                $section->items()->delete();

                foreach ($sectionData['items'] as $i => $item) {
                    VehicleSectionItem::create([
                        'vehicle_section_id' => $section->id,
                        'title' => $item['title'],
                        'subtitle' => $item['subtitle'],
                        'description' => $item['description'],
                        'main_image' => $item['main_image'],
                        'thumbnail_image' => $item['main_image'],
                        'background_overlay' => $item['background_overlay'],
                        'order' => $i,
                        'is_active' => true,
                    ]);
                }
            }
        }
    }

    private function seedTestDriveSections(): void
    {
        $configs = [
            'starray' => [
                'title' => 'TEST DRIVE STARRAY',
                'description' => 'Descubre por ti mismo la potencia y tecnología del Geely Starray.',
                'config' => [
                    'background_image' => 'frontend/images/vehicles/starray/7080348 1.png',
                    'background_image_mobile' => 'frontend/images/vehicles/starray/Geely_Test_Drive_Mobile.jpg',
                    'text_color' => 'black',
                    'button_text' => 'Agenda ahora',
                    'button_url' => '/forms',
                ],
            ],
            'gx3-pro' => [
                'title' => 'TEST DRIVE GX3 PRO',
                'description' => 'Experimenta la eficiencia y versatilidad del Geely GX3 Pro.',
                'config' => [
                    'background_image' => 'frontend/images/vehicles/gx3pro/Geely_Bolivia_GX3_Test_Drive_Desktop.jpg',
                    'background_image_mobile' => 'frontend/images/vehicles/gx3pro/Geely_Bolivia_GX3_PRO_Test_Drive_Mobile.jpg',
                    'text_color' => 'black',
                    'button_text' => 'Agenda ahora',
                    'button_url' => '/forms',
                ],
            ],
            'cityray' => [
                'title' => 'TEST DRIVE CITYRAY',
                'description' => 'Experimenta la eficiencia y versatilidad del Geely Cityray.',
                'config' => [
                    'background_image' => 'frontend/images/vehicles/cityray/Geely_Test_Drive_Desktop_Cityray.jpg',
                    'background_image_mobile' => 'frontend/images/vehicles/cityray/Geely_Test_Drive_Mobile_Cityray.jpg',
                    'text_color' => 'black',
                    'button_text' => 'Agenda ahora',
                    'button_url' => '/forms',
                ],
            ],
            'coolray' => [
                'title' => 'TEST DRIVE COOLRAY',
                'description' => 'Experimenta la eficiencia y versatilidad del Geely Coolray.',
                'config' => [
                    'background_image' => 'frontend/images/vehicles/coolray/Geely_Test_Drive_Desktop_Coolray.jpg',
                    'background_image_mobile' => 'frontend/images/vehicles/coolray/Geely_Test_Drive_Mobile_Coolray.jpg',
                    'text_color' => 'white',
                    'button_text' => 'Agenda ahora',
                    'button_url' => '/forms',
                ],
            ],
        ];

        foreach ($configs as $slug => $data) {
            $vehicle = Vehicle::where('slug', $slug)->first();
            if (!$vehicle) continue;

            VehicleSection::updateOrCreate(
                ['vehicle_id' => $vehicle->id, 'section_type' => 'test_drive'],
                [
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'config' => $data['config'],
                    'order' => 10,
                    'is_active' => true,
                ]
            );
        }
    }

    private function seedVideoReviewSections(): void
    {
        $configs = [
            'starray' => [
                'title' => 'VIDEOS Y RESEÑAS',
                'subtitle' => 'Conoce todo sobre Geely Starray con los siguientes videos',
                'items' => [
                    ['title' => 'This is where the ride can get for your video', 'subtitle' => 'REVIEW STARRAY', 'channel' => 'Reseñas', 'thumbnail_image' => '/frontend/images/1.png', 'video_url' => 'https://www.youtube.com/embed/XFKtYQuqWPI', 'duration' => '05:31', 'views' => '125K views'],
                    ['title' => 'This is where the ride can get for your video', 'subtitle' => 'REVIEW STARRAY', 'channel' => 'Reseñas', 'thumbnail_image' => '/frontend/images/1.png', 'video_url' => 'https://www.youtube.com/embed/Bi1i4T8tMGM?si=TA5Vvy3PptKLwG5p', 'duration' => '05:31', 'views' => '125K views'],
                ],
            ],
            'gx3-pro' => [
                'title' => 'VIDEOS Y RESEÑAS',
                'subtitle' => 'Conoce todo sobre Geely GX3 PRO con los siguientes videos',
                'items' => [
                    ['title' => 'This is where the ride can get for your video', 'subtitle' => 'REVIEW GX3 PRO', 'channel' => 'Reseñas', 'thumbnail_image' => '/frontend/images/vehicles/gx3pro/Geely_Bolivia_GX3_PRO_Portada_Reviews.jpg', 'video_url' => 'https://www.youtube.com/embed/631B54-0P80?si=foam_lPDmAwoHR5G', 'duration' => '05:31', 'views' => '125K views'],
                    ['title' => 'This is where the ride can get for your video', 'subtitle' => 'REVIEW GX3 PRO', 'channel' => 'Reseñas', 'thumbnail_image' => '/frontend/images/vehicles/gx3pro/Geely_Bolivia_GX3_PRO_Portada_Reviews.jpg', 'video_url' => 'https://www.youtube.com/embed/8oVUOlZtQ9U?si=Ov1jSCoJ26OrX2nM', 'duration' => '05:31', 'views' => '125K views'],
                ],
            ],
            'cityray' => [
                'title' => 'VIDEOS Y RESEÑAS',
                'subtitle' => 'Conoce todo sobre Geely CITYRAY con los siguientes videos',
                'items' => [
                    ['title' => 'This is where the ride can get for your video', 'subtitle' => 'REVIEW CITYRAY', 'channel' => 'Reseñas', 'thumbnail_image' => '/frontend/images/vehicles/cityray/Geely Cityray Review Poratada.jpg', 'video_url' => 'https://www.youtube.com/embed/fcVfqc5WCHc?si=WIvSDGyFGt73yByX', 'duration' => '05:31', 'views' => '125K views'],
                ],
            ],
            'coolray' => [
                'title' => 'VIDEOS Y RESEÑAS',
                'subtitle' => 'Conoce todo sobre Geely COOLRAY con los siguientes videos',
                'items' => [
                    ['title' => 'This is where the ride can get for your video', 'subtitle' => 'REVIEW COOLRAY', 'channel' => 'Reseñas', 'thumbnail_image' => '/frontend/images/vehicles/coolray/GEELY_BOLIVIA_PORTADA VIDEO.png', 'video_url' => 'https://www.youtube.com/embed/Nc0YfZ8V0Mw?si=vgXDbQiE-KlljUlq', 'duration' => '05:31', 'views' => '125K views'],
                ],
            ],
        ];

        foreach ($configs as $slug => $data) {
            $vehicle = Vehicle::where('slug', $slug)->first();
            if (!$vehicle) continue;

            $section = VehicleSection::updateOrCreate(
                ['vehicle_id' => $vehicle->id, 'section_type' => 'video_review'],
                [
                    'title' => $data['title'],
                    'subtitle' => $data['subtitle'],
                    'order' => 20,
                    'is_active' => true,
                ]
            );

            $section->items()->delete();

            foreach ($data['items'] as $i => $item) {
                VehicleSectionItem::create([
                    'vehicle_section_id' => $section->id,
                    'title' => $item['title'],
                    'subtitle' => $item['subtitle'],
                    'channel' => $item['channel'],
                    'thumbnail_image' => $item['thumbnail_image'],
                    'video_url' => $item['video_url'],
                    'duration' => $item['duration'],
                    'views' => $item['views'],
                    'order' => $i,
                    'is_active' => true,
                ]);
            }
        }
    }

    private function seedGallerySections(): void
    {
        $configs = [
            'starray' => [
                'config' => ['columns' => 3, 'gap' => 'gap-0', 'container_height' => 'h-[700px]'],
                'items' => [
                    ['column_position' => 1, 'row_span' => 1, 'main_image' => 'frontend/images/mosaico/1.png', 'alt_text' => 'Interior detail', 'overlay' => false],
                    ['column_position' => 1, 'row_span' => 1, 'main_image' => 'frontend/images/mosaico/2.jpg', 'alt_text' => 'Seat detail', 'overlay' => false],
                    ['column_position' => 2, 'row_span' => 2, 'main_image' => 'frontend/images/mosaico/3.jpg', 'alt_text' => 'Car front view', 'overlay' => false],
                    ['column_position' => 3, 'row_span' => 1, 'main_image' => 'frontend/images/mosaico/4.png', 'alt_text' => 'Grille detail', 'overlay' => false],
                    ['column_position' => 3, 'row_span' => 1, 'main_image' => 'frontend/images/mosaico/5.png', 'alt_text' => 'Dashboard', 'overlay' => false],
                ],
            ],
            'gx3-pro' => [
                'config' => ['columns' => 2, 'gap' => 'gap-0', 'container_height' => 'h-[700px]'],
                'items' => [
                    ['column_position' => 1, 'row_span' => 1, 'main_image' => 'frontend/images/vehicles/gx3pro/mosaic/GX3 Pro Trasero.jpg', 'alt_text' => 'Interior detail', 'overlay' => false],
                    ['column_position' => 1, 'row_span' => 1, 'main_image' => 'frontend/images/vehicles/gx3pro/mosaic/0_4-zoom_322a3488.jpg', 'alt_text' => 'Seat detail', 'overlay' => false],
                    ['column_position' => 2, 'row_span' => 1, 'main_image' => 'frontend/images/vehicles/gx3pro/mosaic/GX3 Pro Diagonal.jpg', 'alt_text' => 'Grille detail', 'overlay' => false],
                    ['column_position' => 2, 'row_span' => 1, 'main_image' => 'frontend/images/vehicles/gx3pro/mosaic/GX3 Pro Aro.jpg', 'alt_text' => 'Dashboard', 'overlay' => false],
                ],
            ],
            'cityray' => [
                'config' => ['columns' => 3, 'gap' => 'gap-0', 'container_height' => 'h-[700px]'],
                'items' => [
                    ['column_position' => 1, 'row_span' => 1, 'main_image' => 'frontend/images/vehicles/cityray/mosaic/1.jpg', 'alt_text' => 'Interior detail', 'overlay' => false],
                    ['column_position' => 1, 'row_span' => 1, 'main_image' => 'frontend/images/vehicles/cityray/mosaic/2.jpg', 'alt_text' => 'Seat detail', 'overlay' => false],
                    ['column_position' => 2, 'row_span' => 2, 'main_image' => 'frontend/images/vehicles/cityray/mosaic/3.jpg', 'alt_text' => 'Car front view', 'overlay' => false],
                    ['column_position' => 2, 'row_span' => 2, 'main_image' => 'frontend/images/vehicles/cityray/mosaic/4.jpg', 'alt_text' => 'Grille detail', 'overlay' => false],
                    ['column_position' => 3, 'row_span' => 1, 'main_image' => 'frontend/images/vehicles/cityray/mosaic/5.jpg', 'alt_text' => 'Dashboard', 'overlay' => false],
                    ['column_position' => 3, 'row_span' => 2, 'main_image' => 'frontend/images/vehicles/cityray/mosaic/6.jpg', 'alt_text' => 'Dashboard', 'overlay' => false],
                ],
            ],
            'coolray' => [
                'config' => ['columns' => 3, 'gap' => 'gap-0', 'container_height' => 'h-[700px]'],
                'items' => [
                    ['column_position' => 1, 'row_span' => 2, 'main_image' => 'frontend/images/vehicles/coolray/mosaic/1.jpg', 'alt_text' => 'Interior detail', 'overlay' => false],
                    ['column_position' => 2, 'row_span' => 2, 'main_image' => 'frontend/images/vehicles/coolray/mosaic/2.jpg', 'alt_text' => 'Seat detail', 'overlay' => false],
                    ['column_position' => 3, 'row_span' => 2, 'main_image' => 'frontend/images/vehicles/coolray/mosaic/3.jpg', 'alt_text' => 'Grille detail', 'overlay' => false],
                ],
            ],
        ];

        foreach ($configs as $slug => $data) {
            $vehicle = Vehicle::where('slug', $slug)->first();
            if (!$vehicle) continue;

            $section = VehicleSection::updateOrCreate(
                ['vehicle_id' => $vehicle->id, 'section_type' => 'gallery'],
                [
                    'title' => 'GALERÍA DE IMÁGENES',
                    'config' => $data['config'],
                    'order' => 30,
                    'is_active' => true,
                ]
            );

            $section->items()->delete();

            foreach ($data['items'] as $i => $item) {
                VehicleSectionItem::create([
                    'vehicle_section_id' => $section->id,
                    'column_position' => $item['column_position'],
                    'row_span' => $item['row_span'],
                    'main_image' => $item['main_image'],
                    'alt_text' => $item['alt_text'],
                    'overlay' => $item['overlay'],
                    'order' => $i,
                    'is_active' => true,
                ]);
            }
        }
    }
}
