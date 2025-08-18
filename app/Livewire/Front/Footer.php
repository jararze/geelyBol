<?php

namespace App\Livewire\Front;

use Livewire\Component;

class Footer extends Component
{
    public $companyName = 'PT GEELY AUTO BOLIVIA';
    public $copyrightYear = 2025;
    public $phone = '0000-0000-000';
    public $email = '...@geely.com';
    public $backgroundColor = '#000000';
    public $textColor = '#ffffff';
    public $linkColor = '#cccccc';
    public $columns;
    public $socialNetworks;
    public $legalLinks;

    public $logo = [
        'image' => 'frontend/images/logo-negro.svg',
        'alt' => 'Geely Bolivia',
    ];

    public function mount()
    {
        $this->loadFooterData();
    }

    private function loadFooterData()
    {
        $this->columns = [
            [
                'id' => 'models',
                'title' => '',
                'links' => [
                    ['text' => 'EX5', 'route' => 'models.ex5'],
                    ['text' => 'Book Now', 'route' => 'book.now'],
                    ['text' => 'Posventa', 'route' => 'posventa'],
                    ['text' => 'Notifícame', 'route' => 'notify']
                ]
            ],
            [
                'id' => 'company',
                'title' => '',
                'links' => [
                    ['text' => 'Acerca de nosotros', 'route' => 'about'],
                    ['text' => 'Calculadora', 'route' => 'calculator'],
                    ['text' => 'Noticias', 'route' => 'news'],
                    ['text' => 'Contáctanos', 'route' => 'contact']
                ]
            ],
            [
                'id' => 'services',
                'title' => '',
                'links' => [
                    ['text' => 'Test Drive', 'route' => 'test-drive'],
                    ['text' => 'Concesionario', 'route' => 'dealership'],
                    ['text' => 'Promo & Event', 'route' => 'promotions']
                ]
            ]
        ];

        $this->socialNetworks = [
            ['name' => 'WhatsApp', 'icon' => 'whatsapp', 'url' => 'https://wa.me/59100000000'],
            ['name' => 'Facebook', 'icon' => 'facebook', 'url' => 'https://www.facebook.com/profile.php?id=61579700183059'],
            ['name' => 'Instagram', 'icon' => 'instagram', 'url' => 'https://www.instagram.com/geelybolivia'],
            ['name' => 'LinkedIn', 'icon' => 'linkedin', 'url' => 'https://linkedin.com/company/geelybolivia'],
            ['name' => 'YouTube', 'icon' => 'youtube', 'url' => 'http://www.youtube.com/@Geely.Bolivia'],
            ['name' => 'TikTok', 'icon' => 'tiktok', 'url' => 'https://www.tiktok.com/@geely.bo']
        ];

        $this->legalLinks = [
            ['text' => 'Privacidad & Política', 'route' => 'privacy'],
            ['text' => 'Política de cookies', 'route' => 'cookies'],
            ['text' => 'Términos y Condiciones', 'route' => 'terms']
        ];
    }

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
