<?php

namespace App\Livewire\Admin\Payment;

use App\Models\Payment;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class PaymentsIndex extends Component
{

    // Se agrego estas lineas para usar la paginacion en el formulario
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $numbers = 6;


    #[On('render-payments')] //ESCUCHADOR DE EVENTO
    public function render()
    {
        $payments = Payment::where('name', '<>', null)
            ->paginate($this->numbers);

        return view('livewire.admin.payment.payments-index', compact('payments'));
    }

}
