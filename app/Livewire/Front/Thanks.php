<?php


namespace App\Livewire\Front;

use Livewire\Component;

class Thanks extends Component
{
    public $submission = [];
    public $category = null;
    public $slug = null;

    public function mount($category = null, $slug = null)
    {
        $this->category = $category;
        $this->slug = $slug;

        // Obtener datos de la sesión
        $this->submission = session('form_submission') ?? [];

        // Si no hay datos en sesión, redirigir al formulario
        if (empty($this->submission)) {
            if ($this->category && $this->slug) {
                return $this->redirect(route('forms.detail', [
                    'category' => $this->category,
                    'slug' => $this->slug
                ]), navigate: false);
            }
            return $this->redirect(route('forms.base'), navigate: false);
        }
    }

    public function render()
    {
        return view('livewire.front.thanks')->layout('components.layouts.frontend.front');
    }
}
