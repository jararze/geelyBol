<?php

namespace App\Livewire\Front;

use App\Models\SiteSetting;
use Livewire\Component;

class BenefitsSection extends Component
{
    public $sectionTitle;
    public $sectionDescription;

    public $backgroundType = 'image';
    public $backgroundImage = 'assets/images/bg-benefits.png';
    public $backgroundOverlay = true;
    public $backgroundColor = '#3b82f6';
    public $gradientEndColor = '#1e40af';
    public $gradientDirection = '0';
    public $overlayOpacity = 0;

    public $footerText = 'Lo que ocurra primero';
    public $benefits;

    public $cardBackgroundImage = 'assets/images/box.png';

    public function mount()
    {
        $this->loadBenefits();
    }

    public function getBackgroundStyle()
    {
        switch ($this->backgroundType) {
            case 'image':
                if (!$this->backgroundImage) {
                    return $this->getGradientStyle(); // Quita asset() de aquí
                }

                // Usa asset() para la imagen
                $imageUrl = asset($this->backgroundImage);

                $overlay = $this->backgroundOverlay
                    ? "linear-gradient(rgba(0,0,0,{$this->overlayOpacity}), rgba(0,0,0,{$this->overlayOpacity})), "
                    : '';

                return "background: {$overlay}url('{$imageUrl}') center/cover no-repeat;";

            case 'solid':
                return "background-color: {$this->backgroundColor};";

            case 'gradient':
            default:
                return $this->getGradientStyle();
        }
    }

    private function getGradientStyle()
    {
        return "background: linear-gradient({$this->gradientDirection}, {$this->backgroundColor}, {$this->gradientEndColor});";
    }

    private function loadBenefits()
    {
        $benefitsGroup = SiteSetting::getGroup('benefits');

        if (!empty($benefitsGroup)) {
            $this->sectionTitle = $benefitsGroup['title'] ?? 'CON GEELY OBTIENES MÁS';
            $this->sectionDescription = $benefitsGroup['description'] ?? '';

            $this->benefits = [];
            for ($i = 1; $i <= 4; $i++) {
                $key = "benefit_{$i}";
                if (!empty($benefitsGroup[$key])) {
                    $data = json_decode($benefitsGroup[$key], true);
                    if ($data) {
                        $this->benefits[] = [
                            'id' => "benefit-{$i}",
                            'number' => $data['number'] ?? '',
                            'unit' => $data['unit'] ?? '',
                            'label' => $data['label'] ?? '',
                            'position' => $i,
                        ];
                    }
                }
            }

            if (!empty($this->benefits)) {
                return;
            }
        }

        // LEGACY - datos hardcodeados
        $this->sectionTitle = 'CON GEELY OBTIENES MÁS';
        $this->sectionDescription = 'Geely te da los mejores beneficios y condiciones del mercado para que puedas empezar a conducir con total tranquilidad.';
        $this->benefits = [
            ['id' => 'warranty-years', 'number' => '5', 'unit' => 'AÑOS', 'label' => 'GARANTÍA EXTENDIDA', 'position' => 1],
            ['id' => 'warranty-km', 'number' => '150.000', 'unit' => 'KM', 'label' => '', 'position' => 2],
            ['id' => 'services', 'number' => '6', 'unit' => 'SERVICIOS', 'label' => 'Y MANTENIMIENTOS INCLUIDOS', 'position' => 3],
            ['id' => 'maintenance-years', 'number' => '3', 'unit' => 'AÑOS', 'label' => 'EN', 'position' => 4],
        ];
    }

    public function setGradientBackground($startColor, $endColor, $direction = '135deg')
    {
        $this->backgroundType = 'gradient';
        $this->backgroundColor = $startColor;
        $this->gradientEndColor = $endColor;
        $this->gradientDirection = $direction;
    }

    public function setImageBackground($imageUrl, $useOverlay = true, $overlayOpacity = 0.7, $rotation = 0)
    {
        $this->backgroundType = 'image';
        $this->backgroundImage = $imageUrl;
        $this->backgroundOverlay = $useOverlay;
        $this->overlayOpacity = $overlayOpacity;
        $this->backgroundRotation = $rotation;
    }

    public function toggleBackgroundType()
    {
        $this->backgroundType = $this->backgroundType === 'gradient' ? 'image' : 'gradient';
    }

    public function render()
    {
        return view('livewire.front.benefits-section');
    }
}
