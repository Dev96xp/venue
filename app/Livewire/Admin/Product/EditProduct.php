<?php

namespace App\Livewire\Admin\Product;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\StatusProduct;
use App\Models\Subcategory;
use Livewire\Component;
use Illuminate\Support\Str;


class EditProduct extends Component
{
    public $open = false;
    public $brands, $categories, $subcategories, $statuses;
    public $product;

    public $productEditId = '';

    // 1.  Crear una propiedad que tenga los mismos campos del formulario
    public $productEdit = [
        'model' => '',
        'brand_id' => '',
        'sku' => '',
        'category_id' => '',
        'subcategory_id' => '',
        'name' => '',
        'style' => '',
        'slug' => '',
        'status_product_id' => '',
        'price' => 0,
        'webprice' => 0,
        'suggestedprice' => 0,
        'wholesaleprice' => 0,
        'discount' => 0,
        'description' => '',
    ];


    public function mount(Product $product)
    {

        $this->product = $product;

        $product = Product::find($this->product->id);
        $this->productEditId = $this->product->id;

        // Muesta estos valores en el formulario
        $this->productEdit['model'] = $product->model;
        $this->productEdit['brand_id'] = $product->brand_id;
        $this->productEdit['sku'] = $product->sku;
        $this->productEdit['category_id'] = $product->category_id;
        $this->productEdit['subcategory_id'] = $product->subcategory_id;
        $this->productEdit['name'] = $product->name;
        $this->productEdit['style'] = $product->style;
        $this->productEdit['slug'] = $product->slug;
        $this->productEdit['status_product_id'] = $product->status_product_id;
        $this->productEdit['price'] = $product->price;
        $this->productEdit['webprice'] = $product->webprice;
        $this->productEdit['suggestedprice'] = $product->suggestedprice;
        $this->productEdit['wholesaleprice'] = $product->wholesaleprice;
        $this->productEdit['discount'] = $product->discount;
        $this->productEdit['description'] = $product->description;

        $this->brands = Brand::all();
        $this->categories = Category::all();
        $this->subcategories = Subcategory::all();
        $this->statuses = StatusProduct::all();
    }


    public function render()
    {
        return view('livewire.admin.product.edit-product');
    }

    // Genera el slug y este es aplicado agregando este metodo en el formulario, en el campo nombre
    // Usa: use Illuminate\Support\Str;
    public function generateSlug()
    {
        $texto = $this->productEdit['name'] . '-' . $this->productEdit['sku'];
        $this->productEdit['slug'] = Str::slug($texto);
    }

    public function update()
    {
        $product = Product::find($this->productEditId);

        $product->update([
            'model' => $this->productEdit['model'],
            'brand_id' => $this->productEdit['brand_id'],
            'sku' => $this->productEdit['sku'],
            'category_id' => $this->productEdit['category_id'],
            'subcategory_id' => $this->productEdit['subcategory_id'],
            'name' => $this->productEdit['name'],
            'style' => $this->productEdit['style'],
            'slug' => $this->productEdit['slug'],
            'status_product_id' => $this->productEdit['status_product_id'],
            'price' => $this->productEdit['price'],
            'webprice' => $this->productEdit['webprice'],
            'suggestedprice' => $this->productEdit['suggestedprice'],
            'wholesaleprice' => $this->productEdit['wholesaleprice'],
            'discount' => $this->productEdit['discount'],
            'description' => $this->productEdit['description'],
        ]);

        $this->reset(['open','productEdit','productEditId']);

        // DISPATCH - Emite un evento, para ser escuchado por otro componente de livewire
        // EJEMPLO - $this->dispatch('post-created', title: $post->title);
        // En este caso para actusalizar la lista de partes
        $this->dispatch('render-list');
    }
}
