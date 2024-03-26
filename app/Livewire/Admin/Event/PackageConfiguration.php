<?php

namespace App\Livewire\Admin\Event;

use App\Models\Element;
use App\Models\Package;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class PackageConfiguration extends Component
{


    // Se agrego estas lineas para usar la paginacion en el formulario
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $numbers = 6;
    public $package_id = 0;
    public $package;
    public $element;

    public $package_name;


    public function mount()
    {
        // TODOS LOS PAQUETES ACTIVOS
        $packages = Package::where('status', 'ACTIVE')
            ->paginate($this->numbers);

        // EL PAQUETE ACTUALMENTE SELECIONADO
        if ($this->package_id == 0) {
            // PRIMERO-Inicio
            // Obtiene el primer paquete por default
            $package = $packages->first();
            // Los asigna ala variable
            $this->package = $package;
        } else {
            $package = Package::find($this->package_id);
            $this->package = $package;
        }

        $this->package_name = $package->name;
    }

    #[On('render-configuration')] //ESCUCHADOR DE EVENTO
    public function render()
    {
        // SEGUNDO-Inicio - Todos los paqiuetes activos
        $packages = Package::where('status', 'ACTIVE')
            ->paginate($this->numbers);

        // EL PAQUETE ACTUALMENTE SELECIONADO
        if ($this->package_id == 0) {
            // TERCERO-Inicio - Otra vez busca el primer paquete
            $package = $packages->first();
            $elements = $package->elements;
            $this->package_name = $package->name;

        } else {

            $package = Package::find($this->package_id);
            $elements = $package->elements;
            $this->package_name = $package->name;
        }


        $all_elements = Element::all();
        //$package_locations = PackageLocation::all();
        $package_locations = [];


        return view('livewire.admin.event.package-configuration', compact('packages', 'elements', 'all_elements', 'package_locations'));
    }

    public function select_package(Package $package)
    {

        $this->package_id = $package->id;  // (1,2,3,4,)

        $this->dispatch('send-data', package: $package);  // ENVIO EL PAQUETE SELECIONADO POR EL USUARIO
        //$this->dispatch('post-created', title: $post->title);  ESTE ES SOLO UN EJEMPLO

    }

    // Elimina UN SOLO COLOR, de la lista
    public function delete_element(Element $element)
    {
        $package = Package::find($this->package_id);

        $package->elements()->detach($element->id);

        // MASTER CLASS - REFRESCA al cmponente por tanto la vista tambien.
        $this->package = $this->package->fresh();
    }
}
