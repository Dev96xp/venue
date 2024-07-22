<?php

namespace App\Livewire\Admin\Page;

use App\Models\Image;
use App\Models\Sectionx;
use Livewire\Component;
use Livewire\Attributes\On;

class ImagesSectionList extends Component
{
    public $images;
    public $sectionx;

    public function mount(Sectionx $sectionx){
        $this->$sectionx = $sectionx;
    }

    #[On('render-list-images')]
    public function render()
    {
        //$this->images = Image::all();
        return view('livewire.admin.page.images-section-list');
    }
}
