<?php

namespace App\Livewire\Admin\Product;

use App\Models\Account;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Ids;
use App\Models\Product;
use App\Models\StatusProduct;
use App\Models\Store;
use App\Models\Subcategory;
use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Str; //for slug


class CreateProduct extends Component
{
    public $open = false;
    public $brands, $categories, $subcategories, $statuses;

    public $model, $brand_id, $sku, $category_id = "", $subcategory_id = "", $style = "NA", $name, $slug;
    public $status_product_id = "", $price, $webprice = 0.0, $suggestedprice = 0.0, $wholesaleprice = 0.0, $discount = 2, $description;

    // MASTER CLASS
    // SUPER IMPORTATNTE ESTAS REGLAS DE VALIDACION,
    // PARA QUE LOS VALORES APARESCAN EN EL FORMULARIO
    // ESTO ME PERMITIRA USAR LAS PROPIEDADES DEL OBJETO EN EL FORMULARIO
    protected $rules = [
        'model' => 'required|max:12',
        'brand_id' => 'required',
        'category_id' => 'required',
        'subcategory_id' => 'required',
        'name' => 'required',
        'status_product_id' => 'required',
        'price' => 'required',
        'webprice' => 'required',
        'suggestedprice' => 'required',
        'wholesaleprice' => 'required',
        'discount' => 'required',
        'description' => 'required',
    ];

    public function mount()
    {
        $this->brands = Brand::all();
        $this->categories = Category::all();
        $this->subcategories = Subcategory::all();
        $this->statuses = StatusProduct::all();

        // $this->brands = Brand::where('code','<>','xx',)
        // ->orderBy('name', 'asc')
        // ->get()
        // ->pluck('name','id');
    }

    public function render()
    {
        return view('livewire.admin.product.create-product');
    }


    // Esta ala escucha del cambio del valor de la variable($brand_id), si este cambia de valor
    // se ejecuta esta funcion
    public function updatedBrandId($value){
        $this->brand_id = $value;
        $this->sku = Brand::find($this->brand_id)->code . $this->model;
        // dd($value);
    }

    public function updatedCategoryId($value){
        $this->subcategories = Subcategory::where('category_id', $value)->get();
        $this->category_id = $value;

        $this->reset('subcategory_id');
    }

    public function updatedPrice($value){
        $this->webprice = $value;
        $this->suggestedprice = $value;
        $this->wholesaleprice = $value;
    }

    // Genera el slug y este es aplicado agregando este metodo en el formulario, en el campo nombre
    public function generateSlug(){
        $this->slug = Str::slug($this->name.'-'.$this->sku);
    }

    public function save()
    {
        // Validar los datos
        $this->validate();

        //dd($this->slug);

        // Crea un nuevo producto
        $product = Product::create([
            'model' => $this->model,
            'brand_id' => $this->brand_id,
            'sku' => $this->sku,
            'category_id' => $this->category_id,
            'subcategory_id' => $this->subcategory_id,
            'name' => $this->name,
            'style' => $this->style,
            'slug' => $this->slug,
            'status_product_id' => $this->status_product_id,
            'price' => $this->price,
            'webprice' => $this->webprice,
            'suggestedprice' => $this->suggestedprice,
            'wholesaleprice' => $this->wholesaleprice,
            'discount' => $this->discount,
            'description' => $this->description,
            'group_id' => 1,  // Grupo de tallas por defult
        ]);

        // 5. Una vez usadas la porpiedades, limpia las propiedades (reset)
        //    y cierra el MODAL tambien
        $this->reset(['open', 'model', 'brand_id', 'sku', 'category_id', 'subcategory_id', 'name', 'slug',
         'status_product_id', 'price', 'webprice','suggestedprice', 'wholesaleprice', 'discount', 'description']);

        // 6. En este caso para actualizar la lista de productos
        $this->dispatch('render-list');
    }
}

