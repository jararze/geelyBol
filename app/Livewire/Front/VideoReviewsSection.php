<?php

namespace App\Livewire\Front;

use Livewire\Component;

class VideoReviewsSection extends Component
{

    public $currentSlide = 0;
    public $videosData = [];

    private $defaultVideosData = [
        'section_background' => 'bg-black',
        'section_padding' => 'py-16',

        'header' => [
            'title' => 'VIDEOS Y RESEÑAS',
            'subtitle' => 'Conoce todo sobre Geely Starray con los siguientes videos',
            'title_size' => 'text-3xl lg:text-4xl',
            'subtitle_size' => 'text-lg',
            'title_color' => 'text-white',
            'subtitle_color' => 'text-gray-300'
        ],

        'videos' => [
            [
                'id' => 'video-1',
                'title' => 'This is where the ride can get for your video',
                'subtitle' => 'REVIEW GX3 PRO',
                'channel' => 'CARS & LIFESTYLES',
                'thumbnail' => '/frontend/images/1.png',
                'video_url' => 'https://www.youtube-nocookie.com/embed/POBCHlhgO0Q?rel=0&modestbranding=1',
                'duration' => '05:31',
                'views' => '125K views'
            ],
        ],

        'autoplay' => [
            'enabled' => true,
            'delay' => 6000
        ],

        'navigation' => [
            'dots_container_class' => 'flex justify-center mt-8',
            'dots_wrapper_class' => 'bg-gray-800 rounded-full px-4 py-2 flex space-x-2',
            'dots_style' => 'w-3 h-3 bg-gray-500 hover:bg-gray-400 rounded-full',
            'active_dot_style' => 'w-8 h-3 bg-blue-500 rounded-full'
        ]
    ];

    public function mount($videosData = [])
    {
        $this->videosData = array_merge($this->defaultVideosData, $videosData);
        $this->currentSlide = 0;
    }

    public function goToSlide($index)
    {
        $this->currentSlide = $index;
    }

    public function nextSlide()
    {
        $totalSlides = count($this->videosData['videos']);
        $this->currentSlide = ($this->currentSlide + 1) % $totalSlides;
    }

    public function prevSlide()
    {
        $totalSlides = count($this->videosData['videos']);
        $this->currentSlide = ($this->currentSlide - 1 + $totalSlides) % $totalSlides;
    }

    public function getCurrentVideo()
    {
        return $this->videosData['videos'][$this->currentSlide] ?? [];
    }

    public function playVideo($videoId)
    {
        // Aquí puedes agregar lógica para abrir el video
        session()->flash('message', 'Reproduciendo video...');
    }
    public function render()
    {
        return view('livewire.front.video-reviews-section');
    }
}
