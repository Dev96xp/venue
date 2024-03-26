<?php

namespace App\Livewire\Admin\Pos;

use App\Models\Account;
use App\Models\Event;
use App\Models\Ids;
use App\Models\Item;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Store;
use App\Models\Transaction;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Livewire\WithPagination;
use Illuminate\Http\Request;

class PosIndex extends Component
{
    // Se agrego estas lineas para usar la paginacion en el formulario y ademas asi sirve el (search)
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    // OPTION 1
    public $open = false;
    public $user;

    public $search;
    public $account_id = 0;
    public $store_id = 0;
    public $transaction_id = 0;

    public $pago = 0;
    public $payment_id = "";
    public $signo;
    public $counter = 0;

    public $current_item;

    protected $rules = [
        'payment_id' => 'required|max:100',
        'pago' => 'required|numeric|min:1',
    ];

    protected $listeners = ['add_item', 'render'];

    // El componente recibe el parametro de la URL, USANDO METODO MOUNT()

    public function mount(User $user)
    {
        $this->user = $user;

        if ($user->account) {
            $this->account_id = $user->account->id;
        } else {
            $this->account_id = 0;
        }

        $this->store_id = $user->store_id;

        // Se obtiene y se muestra la ultima transaction(factura) hecha por el cliente, de todas la existentes
        $last_transaction = Transaction::where('account_id', $this->account_id)->latest()->first();

        // Comprueba si es nulo o existe
        if ($last_transaction) {
            $this->transaction_id = $last_transaction->id;
        } else {
            $this->transaction_id = 0;
        }


        //$this->transaction_id = $last_transaction->id;
    }


    public function render()
    {
        // Obtiene todas las transactions(facturas) existentes
        $transactions = Transaction::where('account_id', $this->account_id)->get();  //listo

        $items = Item::where('transaction_id', $this->transaction_id)
            ->where('status', '3')->get();                               // Status = 3, indica normal, 4 - indica ocultado pero no borrado

        $payments = Payment::all();
        // Helpers
        $subtotal = get_subtotal($items);

        $products = Product::where('name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('sku', 'LIKE', '%' . $this->search . '%')
            ->orWhere('price', 'LIKE', '%' . $this->search . '%')
            ->latest('id')
            ->paginate(10);

        $subtotal = get_subtotal($items);
        $totalpayments = get_totalpayments($items);
        $total = $subtotal * 1.07;
        $balance = $total - $totalpayments;

        return view('livewire.admin.pos.pos-index', compact('transactions', 'items', 'products', 'payments', 'subtotal', 'totalpayments', 'total', 'balance'));
    }

    public function limpiar_page()
    {
        $this->resetPage();
    }

    // Agrega un item a la factura
    public function add_item($product_id)
    {
        $product = Product::find($product_id);
        $transactions = Transaction::where('account_id', $this->account_id)->get();  //listo


        if ($this->transaction_id <> 0) {

            $item = Item::create([
                'sku' => $product->sku,
                'name' => $product->name,
                'slug' => $product->slug,
                'description' => 1,
                'qty' => 1,
                'price' => $product->price,
                'payment' => 0,
                'status' => 3,   // ...???
                'color' => 'none',
                'bust' => 0,
                'waist' => 0,
                'size' => 0,
                'hip' => 0,
                'transaction_id' => $this->transaction_id,
                'executive_id' => auth()->user()->id,
                'store_id' => auth()->user()->store_id
            ]);

            $this->current_item = $item;


            // TRANFERENCIA DE LAS URLs, de las imagenes del producto
            // a) Primero se comprueba q exista alguna imagen del producto q se va a tranferir
            if ($product->images->count()) {

                // b) Solo si exite,
                // c) se recorre cada imagen que existe en la collecion [ $product->images() ], para obtener su: url
                foreach ($product->images as $image) {
                    // d) Obteniendo la url
                    $url = $image->url;
                    $model = $image->model;
                    // e) Ahora se crea un registro para cada imagen de un item, en la misma tabla: images
                    // f) Y se le transfiera  la url
                    $item->images()->create([
                        'url' => $url,
                        'model' => $model
                    ]);
                }
            }
        } else {  // SI NO HAY UNA FACTURA
            // NADA
        }




        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */
        //@@@@@@@@@@@    IMPORTANTE: EN CASO DE PAQUETES DE EVENTOS    @@@@@@@@@@@
        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */

        // SOLO SI HAY UNA FACTURA(transaction), AGREGAR UN PAQUETE
        if ($this->transaction_id <> 0) {


            // EN EL CASO DE QUE SEA UN PAQUETE, SE AGREGA UN EVENTO A LA
            // AREA DE EVENTOS, QUE ES LA TABLA EVENTO, SI FUERA UN PRODUCTO NO HACER NADA

            // Aqui se Determina si un producto es de tipo paquete, revisando la categoria del producto y
            // si en el type de la categoria es: 2, osea (type_category_id = 2) significa que
            // se trata de un producto de tipo paquete,
            // Si es un paquete hay que agregar un nuevo paquete de evento al area
            // de eventos(paquetes de eventos).

            //dd($product->category->type_category_id );

            if ($product->category->type_category_id == 2) {

                // Obtiene la cuenta del cliente
                $account = Account::find($this->account_id);

                // Obtiene el usuario
                $user = $account->user;

                // Se ASEGURA de que exista tal producto registrado, en la tabla de paquetes.
                $packages = Package::all();
                $package_id = 0;
                foreach ($packages as $package) {
                    if ($package->code == $product->sku) {
                        // Por tanro se asegura que sku, del paquete existe tambien como codigo de la lista de paquetes
                        // Si existe, el paquete registrado, entonces
                        $package_id = $package->id;
                    } else {
                        // NO EXISTE TAL PAQUETE REGISTRADO, ENTONCES NO HACER NADA
                    }
                }

                // CASO ESPECIAL PARA QUINCEAÑERA, EL PAQUETE ID ES: ("THPDRESS")
                // CASO ESPECIAL - En el caso de que, NO se halla encontrado un paquete prederminado y por tanto $package_id == 0,
                //                 entonces ahora se revisara, si algun producto se quiere enviar al area de paquetes
                if ($package_id == 0) {

                    switch ($product->category_id) {
                        case '1':   //Significa que es un vestido de quince, por tanto se enviara al area de paquetes
                            $package_id = 5;   // Con el paquete de id = 5, que significa paquete de SOLO VESTIDO
                            break;

                        default:
                            # code...
                            break;
                    }
                } else {
                    # code...
                }


                if ($package_id == 0) {
                    // SIGNIFICA, QUE NO EXISTE TAL PAQUETE REGISTRADO, EN LA TABLA DE PAQUETES
                    // POR TANTO, NO HACER NADA

                } else {
                    // SIGNIFICA QUE SI HAY UN PAQUETE Y POR TANTO
                    // AGREGA UN NUEVO EVENTO
                    // Obtiene el nuevo ID de la tabla: ids, para el NUEVO Event
                    // en la tabla: EVENTS (para paquetes de eventos)

                    $new_event_id = Ids::find(9); // Next id para: [eventos]

                    // Crea un nuevo evento
                    $event = Event::create([
                        'code' => $new_event_id->nextid,
                        'cus_id' => $user->cus_id, //Cliente
                        'name' => $user->name,
                        'date' => now(),
                        'phone' => $user->phone,
                        'status' => 'ACTIVE',
                        'store_id' => $this->store_id,
                        'user_id' => $user->id, // Cliente
                        'executive_id' => auth()->user()->id, // Ejecutivo de ventas
                        'package_id' => $package_id,
                        'aux1' => 'open',
                        'aux2' => 'open',
                        'aux3' => 'open',
                        'aux4' => $product->sku,
                        'description' => ''
                    ]);


                    // UNA VEZ AGREGADO EL PAQUETE DE EVENTO
                    // HACER ACTIVACION DEL SET(PAQUETE)
                    $package = package::find($event->package_id);

/*
                    foreach ($package->elements as $element) {
                        switch ($element->code) {

                            case 'C800':    //Dress
                                $dress = Dress::create([
                                    'set_id' => $set->id,
                                    'name' => "",
                                    'model' => "",
                                    'color' => "",
                                    'brand' => "",
                                    'size' => 0.0,
                                    'bust' => 0.0,
                                    'waist' => 0.0,
                                    'hip' => 0.0,
                                    'status' => "NEW",
                                    'aux' => "ACTIVE",
                                    'aux1' => "NADA",
                                    'date' => now(),
                                    'date2' => now(),
                                    'date3' => now(),
                                    'note' => "...",
                                    'description' => "...",
                                    'box_id' => 1
                                ]);
                                break;
                            case 'C810':    //Crown
                                $crown = Crown::create([
                                    'set_id' => $set->id,
                                    'name' => "",
                                    'model' => "",
                                    'color' => "",
                                    'brand' => "",
                                    'size' => 0.0,

                                    'bust' => 0.0,
                                    'waist' => 0.0,
                                    'hip' => 0.0,
                                    'status' => "NEW",
                                    'aux' => "ACTIVE",
                                    'aux1' => "NADA",

                                    'date' => now(),
                                    'date2' => now(),
                                    'date3' => now(),
                                    'note' => "...",
                                    'description' => "...",
                                    'box_id' => 1
                                ]);
                                break;
                            case 'C820':    //Necklace
                                $necklace = necklace::create([
                                    'set_id' => $set->id,
                                    'date' => now(),
                                    'date2' => now(),
                                    'date3' => now(),
                                    'note' => '...',
                                    'description' => '...'
                                ]);
                                break;
                            case 'C830':    //Bouquet
                                $bouquet = bouquet::create([
                                    'set_id' => $set->id,
                                    'date' => now(),
                                    'date2' => now(),
                                    'date3' => now(),
                                    'note' => "...",
                                    'description' => "..."
                                ]);
                                break;
                                // case 'C840':    //Shoe
                                //     $shoe = Shoe::create([
                                //         'set_id' => $set->id,
                                //         'date' => now(),
                                //         'date2' => now(),
                                //         'date3' => now(),
                                //         'note' => "",
                                //         'description'=> ""
                                //     ]);
                                //     break;
                            case 'C840':
                                $heel = Heel::create([
                                    'set_id' => $set->id,
                                    'date' => now(),
                                    'date2' => now(),
                                    'date3' => now(),
                                    'note' => '...',
                                    'description' => '...'
                                ]);
                                break;

                            case 'C850':
                                $gift = Gift::create([
                                    'set_id' => $set->id,
                                    'date' => now(),
                                    'date2' => now(),
                                    'date3' => now(),
                                    'note' => '...',
                                    'description' => '...'
                                ]);
                                break;
                            case 'C860':
                                $kit = Kit::create([
                                    'set_id' => $set->id,
                                    'date' => now(),
                                    'date2' => now(),
                                    'date3' => now(),
                                    'note' => '...',
                                    'description' => '...'
                                ]);
                                break;
                            case 'C870':
                                $baul = Baul::create([
                                    'set_id' => $set->id,
                                    'date' => now(),
                                    'date2' => now(),
                                    'date3' => now(),
                                    'note' => '...',
                                    'description' => '...'
                                ]);
                                break;
                            case 'C880':
                                $giftware = Giftware::create([
                                    'set_id' => $set->id,
                                    'date' => now(),
                                    'date2' => now(),
                                    'date3' => now(),
                                    'note' => '...',
                                    'description' => '...'
                                ]);
                                break;
                            case 'C890':
                                $holder = Holder::create([
                                    'set_id' => $set->id,
                                    'date' => now(),
                                    'date2' => now(),
                                    'date3' => now(),
                                    'note' => '...',
                                    'description' => '...'
                                ]);
                                break;
                            case 'C900':
                                $wine = Wine::create([
                                    'set_id' => $set->id,
                                    'date' => now(),
                                    'date2' => now(),
                                    'date3' => now(),
                                    'note' => '...',
                                    'description' => '...'
                                ]);
                                break;
                            case 'C910':
                                $silverware = Silverware::create([
                                    'set_id' => $set->id,
                                    'date' => now(),
                                    'date2' => now(),
                                    'date3' => now(),
                                    'note' => '...',
                                    'description' => '...'
                                ]);
                                break;
                            case 'C920':
                                $crinoline = Crinoline::create([
                                    'set_id' => $set->id,
                                    'date' => now(),
                                    'date2' => now(),
                                    'date3' => now(),
                                    'note' => '...',
                                    'description' => '...'
                                ]);
                                break;
                            case 'C930':
                                $other = Other::create([
                                    'set_id' => $set->id,
                                    'date' => now(),
                                    'date2' => now(),
                                    'date3' => now(),
                                    'note' => '...',
                                    'description' => '...'
                                ]);
                                break;
                            case 'C940':
                                # code...
                                break;
                            default:
                                # code...
                                break;
                        }
                    }
*/
                    // Por ultimo indicamos que este event(paquete), ya fue activado
                    $event->update(['aux1' => "active"]);

                }
            } else {
                // NO ES UN PAQUETE, NO HACER NADA
            }
        } else {
            #// NO HACER NADA
        }

/* xxx
        if ($this->transaction_id <> 0) {
            // OJO - AGREGAR UNA ORDEN ESPECIAL
            $user_id = $this->user->id;
            $transaction_id = $this->transaction_id;
            $item_id = $this->current_item->id;
        } else {
            # NO HACER NADA
        }
*/



        //$this->emit('add_itemx', [$product_id, $user_id, $transaction_id, $item_id]);
    }

    public function hide_item(Item $item)
    {
        // Actualizar es status a 4
        $item->status = '4';  //Indica que este item se cancelo, pero no se borro
        $item->save();  //Guardar los cambios
    }

    public function show_items(Transaction $transaction)
    {
        // Muestra la transaction(factura seleccionada)
        $this->transaction_id = $transaction->id;
    }

    public function add_invoice()
    {

        $store = Store::find($this->store_id);

        // CREA FACTURA (Transaction) y se deja VACIA
        // con Informacion de las tiendas
        $transaction = Transaction::create([
            'name' => 'sale',
            'status' => 1,
            'envio_type' => 1,
            'content' => 'holax',
            'shipping_cost' => 0.00,
            'total' => 0.00,
            'city' => $store->city,
            'state' => $store->state,
            'store_id' => $this->store_id,
            'account_id' => $this->account_id,
            'executive_id' => auth()->user()->id, // Ejecutivo de ventas
        ]);
    }

    public function add_payment(Request $request, User $user)
    {

        $this->validate();

        // Tipos de payment
        $typeofpayment = Payment::find($this->payment_id);

        switch ($typeofpayment->signo) {
            case '0':  //Normal Payment
                $price = 0.00;
                $pago = $this->pago;
                $tipoPago = "Payment";
                break;

            case '2':  // (Coupon and special descount)
                $price = - ($this->pago);
                $pago = 0.00;
                $tipoPago = "Discount";
                break;


            case '3':  //Cargo variante(Alteration y diferencia de vestido)
                $price = $this->pago;
                $pago = 0.00;
                $tipoPago = "Others";
                break;

            default:
                # code...
                break;
        }

        $Items = Item::create([
            'sku' => $typeofpayment->code,
            'name' => $typeofpayment->name . "  (" . Carbon::now()->toFormattedDateString() . ")",
            'slug' => $tipoPago,
            'description' => $tipoPago,
            'qty' => 1,
            'price' => $price,
            'payment' => $pago,
            'status' => 3,  // ???
            'color' => 'none',
            'bust' => 0,
            'bust' => 0,
            'waist' => 0,
            'size' => 0,
            'hip' => 0,
            'transaction_id' => $this->transaction_id,
            'executive_id' => auth()->user()->id,
            'store_id' => auth()->user()->store_id,
            'create_at' => now()
        ]);

        // f) Ahora se resetea la infomacion del name
        $this->reset('pago', 'payment_id');
    }

}
