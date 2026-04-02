<?php

namespace App\Livewire\Front;

use App\Models\SiteSetting;
use Livewire\Component;

class Footer extends Component
{
    public $companyName;
    public $copyrightYear;
    public $phone;
    public $email;
    public $backgroundColor = '#000000';
    public $textColor = '#ffffff';
    public $linkColor = '#cccccc';
    public $columns;
    public $socialNetworks;
    public $legalLinks;
    public $logo;

    public function mount()
    {
        $this->loadFooterData();
    }

    private function loadFooterData()
    {
        $general = SiteSetting::getGroup('general');
        $contact = SiteSetting::getGroup('contact');
        $social = SiteSetting::getGroup('social');

        $this->companyName = $general['company_name'] ?? 'Geely Bolivia';
        $this->copyrightYear = $general['copyright_year'] ?? date('Y');
        $this->phone = $contact['phone'] ?? '(591)2-2795000';
        $this->email = $contact['address'] ?? 'Av. Costanera # 1003, Los Pinos - La Paz, Bolivia';

        $this->logo = [
            'image' => $general['logo_white'] ?? '/frontend/images/logo-blanco.svg',
            'alt' => $general['company_name'] ?? 'Geely Bolivia',
        ];

        $this->columns = [
            [
                'id' => 'models',
                'title' => '',
                'links' => []
            ],
            [
                'id' => 'company',
                'title' => '',
                'links' => [
                    ['text' => 'Acerca de nosotros', 'route' => 'https://www.geely.com/en/brand/see-the-world-in-full'],
                    ['text' => 'Noticias', 'route' => 'https://global.geely.com/en/news'],
                ]
            ],
            [
                'id' => 'services',
                'title' => '',
                'links' => []
            ]
        ];

        $this->socialNetworks = $this->buildSocialNetworks($social);

        $this->legalLinks = [];
    }

    private function buildSocialNetworks(array $social): array
    {
        $networks = [];
        $map = [
            'facebook' => 'Facebook',
            'instagram' => 'Instagram',
            'youtube' => 'YouTube',
            'tiktok' => 'TikTok',
        ];

        foreach ($map as $key => $name) {
            if (!empty($social[$key])) {
                $networks[] = [
                    'name' => $name,
                    'icon' => $key,
                    'url' => $social[$key],
                ];
            }
        }

        return $networks;
    }

    // LEGACY - datos hardcodeados originales del footer
    // private function loadLegacyFooterData() {
    //     $this->companyName = 'Geely Bolivia';
    //     $this->copyrightYear = 2025;
    //     $this->phone = '(591)2-2795000';
    //     $this->email = 'Av. Costanera # 1003, Los Pinos - La Paz, Bolivia';
    //     $this->socialNetworks = [
    //         ['name' => 'Facebook', 'icon' => 'facebook', 'url' => 'https://www.facebook.com/profile.php?id=61579700183059'],
    //         ['name' => 'Instagram', 'icon' => 'instagram', 'url' => 'https://www.instagram.com/geelybolivia'],
    //         ['name' => 'YouTube', 'icon' => 'youtube', 'url' => 'http://www.youtube.com/@Geely.Bolivia'],
    //         ['name' => 'TikTok', 'icon' => 'tiktok', 'url' => 'https://www.tiktok.com/@geely.bo'],
    //     ];
    // }

    public function redirectTo($route)
    {
        return redirect()->route($route);
    }

    public function openSocialNetwork($url)
    {
        return redirect()->away($url);
    }
    public function render()
    {
        return view('livewire.front.footer');
    }
}
