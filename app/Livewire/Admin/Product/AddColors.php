<?php

namespace App\Livewire\Admin\Product;

use App\Models\Color;
use App\Models\Ids;
use App\Models\Product;
use Livewire\Component;

class AddColors extends Component
{
    // Ayuda para que la PAGINACION sea dinamica, osea se actualizan
    // los datos en pantalla, sin actualizar la pantalla completa.
    //use WithPagination;

    public $open = false;
    public $botton_type = 'create';

    public $product;
    public $name, $list = '';

    public $product_list = '';

    public $search;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    // MASTER CLASS
    // SUPER IMPORTATNTE ESTAS REGLAS DE VALIDACION,
    // PARA QUE LOS VALORES APARESCAN EN EL FORMULARIO
    // ESTO ME PERMITIRA USAR LAS PROPIEDADES DEL OBJETO EN EL FORMULARIO
    protected $rules = [
        'name' => 'required|unique:colors'
    ];

    public function render()
    {

        $colors = Color::where('name', '!=', '')
            ->where('NAME', 'LIKE', '%' . $this->search . '%')
            ->orderBy('name', 'ASC')
            ->get();

        //$product_list = $this->product->colors();


        return view('livewire.admin.product.add-colors', compact('colors'));
    }

    public function save()
    {

        // Validar los datos
        $this->validate();



        // 1. Obtiene en siguiente code, de la tabla: Ids,
        // 2. Lo obtiene de la posicion 6, que corresponde a colors
        $new_code = Ids::find(6);           // Next id para: [6 - Colors]

        $color = Color::create([
            // 3. Otorga el valor del nextid, al avariable: code
            'code' => $new_code->nextid,
            'name' => $this->name   // Nombre del color del formulario
        ]);

        // 4. Por ultimo se crea un nuevo resgistro y con el
        //   se guarda el valor del nextid.

        // 5. Una vez creado el registro, se ejecuta el triger de la tabla en la base de datos y con ello
        //   se generera un nuevo:nexid, con un incremento de 1 , en la tabla :ids




        // b) una vez usadas la porpiedades, limpia las propiedades (reset)
        //    y cierra el MODAL tambien
        $this->reset(['name']);

        // c) Emitir - un evento para avisa lo que se hizo, su objetivo de este evento
        //   es avisar q se agrego un nuevo post y por tanto RENDERIZAR LA VISTA DE OTRO COMPONENTE, PARA VER LOS CAMBIOS
        //   por tal motivo este evento lo llamare: render
        // $this->emit('render');
        // $this->emitTo('tuxedos-index','render');


        // $this->emit('alert');
    }




    // Agrega un color al producto
    public function add_color($color_id)
    {
        $color = Color::find($color_id);

        $this->product->colors()->attach([
            $color_id => [
                'quantity' => 0,  // NO SE ESTA USANDO
                'color_code' => $color->code,
                'model' => $this->product->model
            ]
        ]);

        if ($this->list == '') {
            $this->list = $this->list . $color->name;
        } else {
            $this->list = $this->list . ', ' . $color->name;
        }
        // MASTER CLASS - REFRESCA al cmponente por tanto la vista tambien.
        $this->product = $this->product->fresh();

        $this->dispatch('render-list');
    }


    // Elimina TODOS COLORES, de la lista
    public function delete_color()
    {
        $this->product->colors()->detach();
        $this->list == '';
        $this->reset('list');
        // MASTER CLASS - REFRESCA al componente por tanto la vista tambien.
        $this->product = $this->product->fresh();


    }


    // Elimina UN SOLO COLOR, de la lista
    public function delete_color_list($color_id)
    {
        $this->product->colors()->detach($color_id);

        // MASTER CLASS - REFRESCA al cmponente por tanto la vista tambien.
        $this->product = $this->product->fresh();
        $this->dispatch('render-list');
    }


    // Limpiar la pagina
    // Para que la busqueda sea atravez de todas la paginas
    public function limpiar_page()
    {
        $this->reset('page');
    }
}
