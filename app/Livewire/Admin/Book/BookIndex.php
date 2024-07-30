<?php

namespace App\Livewire\Admin\Book;

use App\Models\Item;
use App\Models\Store;
use Livewire\Component;
use Livewire\WithPagination;

class BookIndex extends Component
{

    // Se agrego estas lineas para usar la paginacion en el formulario
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $search;
    public $sort = 'created_at';
    public $direction = 'desc';

    public $store;
    public $store_id = "";

    public $radio_select = '1';

    public $date1;
    public $date2;

    // LISTENERS
    // a) Estoy a la escucha de un evento llamado: ( RENDER Y TAMBIEN EJECUTO EL METODO RENDER )
    protected $listeners = ['render'];

    public function mount(){
        // MASTER CLASS
        // Por default, Seleciona la tienda donde trabaja esta - PERSONBA AUTENTIFICADA
        $this->store_id = auth()->user()->store_id;
    }

    public function render()
    {

        $stores = Store::all();

        // CA - cash
        // VI - Visa
        // CH - Check
        // CR - Credit Card
        // GI - Gift Card
        // SD - Special Discounts

        switch ($this->radio_select) {
            case '1':
                // MASRTER CLASS
                $sales = Item::where('payment', '<>', 0)
                    ->where('store_id', $this->store_id)
                    ->whereDate('created_at', '=', $this->date1)
                    ->orderBy($this->sort, $this->direction)
                    ->get();

                $sales_cash = Item::where('payment', '<>', 0)
                    ->where('store_id', $this->store_id)
                    ->where('status', '3')   //3 - significa elementos activos, 4-significa elemetos borrados
                    ->whereDate('created_at', '=', $this->date1)
                    ->where('sku', 'CA')
                    ->orderBy($this->sort, $this->direction)
                    ->get();
                $subtotal_cash = get_subtotal_payment($sales_cash);


                $sales_visa = Item::where('payment', '<>', 0)
                    ->where('store_id', $this->store_id)
                    ->where('status', '3')
                    ->whereDate('created_at', '=', $this->date1)
                    ->where('sku', 'VI')
                    ->orderBy($this->sort, $this->direction)
                    ->get();
                $subtotal_visa = get_subtotal_payment($sales_visa);


                $sales_check = Item::where('payment', '<>', 0)
                    ->where('store_id', $this->store_id)
                    ->where('status', '3')
                    ->whereDate('created_at', '=', $this->date1)
                    ->where('sku', 'CH')
                    ->orderBy($this->sort, $this->direction)
                    ->get();
                $subtotal_check = get_subtotal_payment($sales_check);


                $sales_credict_card = Item::where('payment', '<>', 0)
                    ->where('store_id', $this->store_id)
                    ->where('status', '3')
                    ->whereDate('created_at', '=', $this->date1)
                    ->where('sku', 'CR')
                    ->orderBy($this->sort, $this->direction)
                    ->get();
                $subtotal_credict_card = get_subtotal_payment($sales_credict_card);


                $sales_special_discount = Item::where('payment', '<>', 0)
                    ->where('store_id', $this->store_id)
                    ->where('status', '3')
                    ->whereDate('created_at', '=', $this->date1)
                    ->where('sku', 'SD')
                    ->orderBy($this->sort, $this->direction)
                    ->get();
                $subtotal_special_discount = get_subtotal_payment($sales_special_discount);

                break;

            case '2':
                // MASRTER CLASS
                $sales = Item::where('payment', '<>', 0)
                    ->where('store_id', $this->store_id)
                    ->whereBetween('created_at', [$this->date1, $this->date2])
                    ->orderBy($this->sort, $this->direction)
                    ->get();

                $sales_cash = Item::where('payment', '<>', 0)
                    ->where('store_id', $this->store_id)
                    ->where('status', '3')   //3 - significa elementos activos, 4-significa elemetos borrados
                    ->whereBetween('created_at', [$this->date1, $this->date2])
                    ->where('sku', 'CA')
                    ->orderBy($this->sort, $this->direction)
                    ->get();
                $subtotal_cash = get_subtotal_payment($sales_cash);


                $sales_visa = Item::where('payment', '<>', 0)
                    ->where('store_id', $this->store_id)
                    ->where('status', '3')
                    ->whereBetween('created_at', [$this->date1, $this->date2])
                    ->where('sku', 'VI')
                    ->orderBy($this->sort, $this->direction)
                    ->get();
                $subtotal_visa = get_subtotal_payment($sales_visa);


                $sales_check = Item::where('payment', '<>', 0)
                    ->where('store_id', $this->store_id)
                    ->where('status', '3')
                    ->whereBetween('created_at', [$this->date1, $this->date2])
                    ->where('sku', 'CH')
                    ->orderBy($this->sort, $this->direction)
                    ->get();
                $subtotal_check = get_subtotal_payment($sales_check);


                $sales_credict_card = Item::where('payment', '<>', 0)
                    ->where('store_id', $this->store_id)
                    ->where('status', '3')
                    ->whereBetween('created_at', [$this->date1, $this->date2])
                    ->where('sku', 'CR')
                    ->orderBy($this->sort, $this->direction)
                    ->get();
                $subtotal_credict_card = get_subtotal_payment($sales_credict_card);


                $sales_special_discount = Item::where('payment', '<>', 0)
                    ->where('store_id', $this->store_id)
                    ->where('status', '3')
                    ->whereBetween('created_at', [$this->date1, $this->date2])
                    ->where('sku', 'SD')
                    ->orderBy($this->sort, $this->direction)
                    ->get();
                $subtotal_special_discount = get_subtotal_payment($sales_special_discount);
                //dd($this->radio_select);

                break;

            default:
                # code...
                break;
        }


        $radio_select = $this->radio_select;

        return view('livewire.admin.book.book-index', compact(
            'stores',
            'sales',
            'subtotal_cash',
            'subtotal_visa',
            'subtotal_check',
            'subtotal_credict_card',
            'subtotal_special_discount',
            'radio_select'
        ));
    }

    public function limpiar_page()
    {
        $this->reset('page');
    }
}
