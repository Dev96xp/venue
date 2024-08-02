<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;

class ImagesProductList extends Component
{
    public $images;
    public $product;

    public function mount(Product $product){
        $this->$product = $product;
    }

    #[On('render-list-images')]
    public function render()
    {
        //$this->images = Image::all();
        return view('livewire.admin.product.images-product-list');
    }
}

