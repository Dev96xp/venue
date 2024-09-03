<?php

namespace App\Livewire\Pages\Store;

use App\Models\Product;
use App\Models\Size;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class ProductOverview extends Component
{
    public $product, $colors, $sku = "";

    // estas variables son las que estan sincronizadas con el formulario
    // VARIABLES SINCRONIZADAS CON EL FORMULARIO
    public $color_id = "";
    public $size_id = "";
    public $quantity = 1;
    public $bust = 0;
    public $waist = 0;
    public $hip = 0;
    public $date;
    public $coupon = null;
    public $pickup_date;

    public $product_id;

    // Esta variable ( $options ), es una arreglo de otras variables, para uso exclusivo
    // del carrito de compras
    public $options = [
        'color_id' => null,
        'size_id' => null,
        'quantity' => 0,
        'bust' => 0,
        'waist' => 0,
        'hip' => 0,
        'date' => null,
        'coupon' => null,
        'sku' => null
    ];

    // MASTER CLASS - AQUI SE VUELVEN A DECLARAR LAS VARIABLES, DENTRO DEL ARRAY DE RULES,
    //                CON EL USO EXCLUSIVO DE VALIDACION
    public $rules = [
        'color_id' => 'required',
        'size_id' => 'required',
        'quantity' => 'required|numeric|min:1|max:10',
        //'bust' => 'required|numeric|min:1|max:120',
        //'waist' => 'required|numeric|min:1|max:120',
        //'hip' => 'required|numeric|min:1|max:120',
        //'date' => 'required'
    ];


    public function mount(Product $product)
    {
        $this->product = $product;
        $this->product_id = $product->id;
    }

    public function render()
    {
        $this->product = Product::find($this->product_id);

        // return view('livewire.pages.store.product-overview');  Por default se redizara en la plantilla (layouts.app.blade.php)
        // pero en su lugar se usara otra plantilla llamada: (layouts.store.blade.php)
        return view('livewire.pages.store.product-overview');
    }


    // Agrega un producto al carrito de compras
    public function addItem($product_id)
    {

        $this->product_id = $product_id;
        //dd($product_id);
        // Regla de validacion
        $rules = $this->rules;
        $this->validate($rules);


        // OJO - Aqui le otorgo a las variables del arreglo ( $options )[carrito de compras], sus correspondientes
        // valores insertados por los usuarios, en el formulario

        // $this->options['quantity'] = $this->quantity;
        // $this->options['waist'] = $this->waist;
        // $this->options['bust'] = $this->bust;
        // $this->options['hip'] = $this->hip;
        //$this->options['date'] = $this->date;
        //$this->options['coupon'] = $this->coupon;
        //$this->options['pickup_date'] = $this->pickup_date;

        $this->product = Product::find($product_id);
        $this->options['image'] = Storage::url($this->product->images->first()->url);
        $this->options['sku'] = $this->product->sku;
        $this->options['pickup_date'] = now();  // Por default, no se esta usando
        //dd($this->product);

        Cart::add([
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => 1,
            'price' => $this->product->price,
            'options' => $this->options,
        ]);

        $this->reset('quantity', 'color_id', 'size_id');

        // Actualizar el dropdown-cart
        $this->dispatch('render-dropdown-cart');


    }

        // MASTER CLASS - Interesante
    // a) Siempre, que definamos un metodo que comience con la palabra: updated,
    // seguido del nombre de algunas de las propiedades, este metodo se va a ejecutar
    // cada vez que cambiemos el valor de la propiedad: ColorId
    public function updatedColorId($value)
    {
        $color = $this->product->colors->find($value);

        //$this->quantity = qty_available($this->product->id, $color->id);    // ---------OJO AQUI    (LO VOY A DEJAR DE USAR)

        $this->options['color'] = $color->name;
        $this->options['color_id'] = $color->id;
    }



    // updatedSizeId - Se mantiene a la escucha del CAMBIO DE VALOR DE : Size_id
    public function updatedSizeId($value)
    {

        $size = Size::find($value);
        $this->colors = $size->colors;

        $this->options['size'] = $size->name;
        $this->options['size_id'] = $size->id;
    }

}
