<?php

namespace App\Livewire\Admin\Product;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination; // Se manda llamar la paginacion
use Livewire\Attributes\On;

class ProductsIndex extends Component
{

    protected $paginationTheme = "bootstrap";
    // Ayuda para que la PAGINACION sea dinamica, osea se actualizan
    // los datos en pantalla, sin actualizar la pantalla completa.
    use WithPagination;

    public $search;

    // Para etiqueta de product

    public $lbCase = 1;  //En el caso 1, Imprimir etiqueta para productos
    public $lbSku = "";
    public $lbName = "";
    public $lbPrice = 0;
    public $sort = 'created_at';
    public $sort1 = 'name';
    public $direction = 'desc';

    public $screen = 1;  //Lista de Productos

    public $brand_id = "";
    public $category_id = "";

    public $contactId = 1;
    public $customer_name = "";



    // LISTENERS
    // a) Estoy a la escucha de un evento llamado: ( validateQrcode )
    protected $listeners = ['validateQrcode'];


    // Se recibe el parametro, para la marca(brand)
    public function mount(Brand $brand, Category $category)
    {

        //dd($brand->id);
        // MASTER
        // CASO 1: Si la variable es recibida en el metodo mount, significa que existe
        // y solo otorgo el valor de la variable a su correspondeinte variable

        // CASO 2: Si la variable no es recivida en el metodo mount, significa que no existe
        // y en este caso solo se asigna por defaul el valor de cero, para que se selecione
        // por el usuario.

        if ($brand->id) {
            $this->brand_id = $brand->id;
        } else {
            $this->brand_id = "";
        }

        // if (isset($brand)) {  ORIGINAL
        //     $this->brand_id = $brand->id;
        // } else {
        //     $this->brand_id = "";
        // }


        if ($category->id) {
            $this->category_id = $category->id;
        } else {
            $this->category_id = "";
        }

    }


    #[On('render-list')] //ESCUCHADOR DE EVENTO
    public function render()
    {
        $brands = Brand::where('code','<>','xx')
        ->orderBy($this->sort1, 'asc')
        ->get();

        $categories = Category::all();

        $products = Product::where('brand_id', $this->brand_id)
            ->where('category_id', $this->category_id)
            ->where('sku', 'LIKE', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);

        return view('livewire.admin.product.products-index', compact('products', 'brands', 'categories'));
    }


    // Limpiar la pagina
    // Para que la busqueda sea atravez de todas la paginas
    public function limpiar_page()
    {
        $this->resetPage();
    }

    public function select_product($prod_id)
    {

        $product = Product::find($prod_id);

        $this->lbCase = 1;  //En el caso 1, Imprimir etiqueta para productos;
        $this->lbSku = $product->sku;
        $this->lbName = $product->name;
        $this->lbPrice = $product->price;
    }

    public function validateQrcode($inputResult)
    {

        $customers = User::where('cus_id', $inputResult)->get();

        //dd($customers->first());

        if ($customers->first()) {
            $this->customer_name = $customers->first()->name;

        } else {
            $this->customer_name = "No encontrado...";
            //dd($customers->first()->name);
        }
    }

    // haciendo pruebas
    public function alerta(){

        //$this->emit('livewire.admin.products-index','alerta');  //  is not working...........OJO
                // Este emitTo me permite renderizar el otro componente de livewire de manera muy especifica, llamado: PaymentMethodList
        // OJO - Con la RUTA CORRECTA y EN MINUSCULA Y SEPARADO POR GIONES
        //$this->emitTo('admin.billing.payment-method-list', 'render');
        $this->emitTo('admin.admin.products-index', 'alerta');
    }

}
