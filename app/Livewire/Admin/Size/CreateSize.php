<?php

namespace App\Livewire\Admin\Size;

use App\Models\Group;
use App\Models\Product;
use App\Models\Size;
use Livewire\Component;

class CreateSize extends Component
{

    // Ayuda para que la PAGINACION sea dinamica, osea se actualizan
    // los datos en pantalla, sin actualizar la pantalla completa.
    //use WithPagination;

    public $open = false;
    public $botton_type = 'edit';

    public $product;
    public $name, $list = '';

    public $group_id = '';  // ESTE VALOR ESTA SINCRONIZADO CON LOS VALORES DEL FORMULARIO
    public $group;


    public function mount(Product $product)
    {
        $this->product = $product;
        $this->group_id = $product->group_id;
    }

    // MASTER CLASS
    // SUPER IMPORTATNTE ESTAS REGLAS DE VALIDACION,
    // PARA QUE LOS VALORES APARESCAN EN EL FORMULARIO
    // ESTO ME PERMITIRA USAR LAS PROPIEDADES DEL OBJETO EN EL FORMULARIO
    protected $rules = [
        'name' => 'required|unique:sizes'
    ];



    public function render()
    {
        $groups = Group::all();

        $sizes = Size::where('name', '!=', '')
            ->orderBy('name', 'ASC')
            ->get();

        return view('livewire.admin.size.create-size', compact('sizes', 'groups'));
    }



    // updatedSizeId - Se mantiene a la escucha del CAMBIO DE VALOR DE : Size_id
    public function updatedGroupId($value)
    {
        $this->group_id = Group::find($value)->id;
    }




    public function save()
    {
        // Validar los datos
        $this->validate();

        // C) Se Crea el nuevo registro en la tabla: USERS
        $size = Size::create([
            'name' => $this->name,   // Nombre del color del formulario
        ]);

        // b) una vez usadas la porpiedades, limpia las propiedades (reset)
        //    y cierra el MODAL tambien
        $this->reset(['name']);

    }


    // Agrega un size al producto - NO SE ESTA USANDO
    public function add_size($size_id)
    {
        $size = Size::find($size_id)->name;

        $this->product->sizes()->attach([
            $size_id => [
                'quantity' => 0
            ]
        ]);
        if ($this->list == '') {
            $this->list = $this->list . $size;
        } else {
            $this->list = $this->list . ', ' . $size;
        }
    }


    // Agrega un size a un grupo especifico de tallas
    public function add_size_xp($size_id)
    {
        // Agregar regla de validacion
        $this->validate([
            'group_id' => 'required'
        ]);


        $group = Group::find($this->group_id);
        $size = Size::find($size_id)->name;

        $group->sizes()->attach([
            $size_id => [
                'quantity' => 3
            ]
        ]);

        if ($this->list == '') {
            $this->list = $this->list . $size;
        } else {
            $this->list = $this->list . ', ' . $size;
        }

        // MASTER CLASS - REFRESCA al componente por tanto la vista tambien.
        $this->product = $this->product->fresh();
    }


    // Elimina TODAS LAS TALLAS, del grupo
    public function delete_size()
    {
        $this->product->group->sizes()->detach();
        $this->list == '';
        $this->reset('list');
        // MASTER CLASS - REFRESCA al componente por tanto la vista tambien.
        $this->product = $this->product->fresh();
    }


    // Elimina UNA SOLA TALLA, de la lista
    public function delete_size_list($size_id)
    {
        $this->product->group->sizes()->detach($size_id);

        // MASTER CLASS - REFRESCA al cmponente por tanto la vista tambien.
        $this->product = $this->product->fresh();
    }

    public function update_product_size(){
        // Actualiza el grupo de tallas
        $this->product->group_id = $this->group_id;
        $this->product->save();
        $this->reset(['open']); //Reset la variable open, para cerra el formulario(Modal)
    }
}

