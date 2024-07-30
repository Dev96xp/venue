<?php

namespace App\Http\Controllers\Admin\Book;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Store;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.books.index');
    }


    // Para PRINT REPORT
    public function prnreport(Request $request)
    {

        $date1 = $request->date1;
        $date2 = $request->date2;

        $store_id = $request->store_id;
        $radio_select = $request->radio_select;

        //dd($radio_select);
        $store = Store::find($store_id);

        $sort = 'created_at';
        $direction = 'desc';


        $stores = Store::all();

        // CA - cash
        // VI - Visa
        // CH - Check
        // CR - Credit Card
        // GI - Gift Card
        // SD - Special Discounts

        switch ($radio_select) {
            case '1':
                // MASRTER CLASS
                $sales = Item::where('payment', '<>', 0)
                    ->where('store_id', $store_id)
                    ->whereDate('created_at', '=', $date1)
                    ->orderBy($sort, $direction)
                    ->get();

                $sales_cash = Item::where('payment', '<>', 0)
                    ->where('store_id', $store_id)
                    ->where('status', '3')   //3 - significa elementos activos, 4-significa elemetos borrados
                    ->whereDate('created_at', '=', $date1)
                    ->where('sku', 'CA')
                    ->orderBy($sort, $direction)
                    ->get();
                $subtotal_cash = get_subtotal_payment($sales_cash);


                $sales_visa = Item::where('payment', '<>', 0)
                    ->where('store_id', $store_id)
                    ->where('status', '3')
                    ->whereDate('created_at', '=', $date1)
                    ->where('sku', 'VI')
                    ->orderBy($sort, $direction)
                    ->get();
                $subtotal_visa = get_subtotal_payment($sales_visa);


                $sales_check = Item::where('payment', '<>', 0)
                    ->where('store_id', $store_id)
                    ->where('status', '3')
                    ->whereDate('created_at', '=', $date1)
                    ->where('sku', 'CH')
                    ->orderBy($sort, $direction)
                    ->get();
                $subtotal_check = get_subtotal_payment($sales_check);


                $sales_credict_card = Item::where('payment', '<>', 0)
                    ->where('store_id', $store_id)
                    ->where('status', '3')
                    ->whereDate('created_at', '=', $date1)
                    ->where('sku', 'CR')
                    ->orderBy($sort, $direction)
                    ->get();
                $subtotal_credict_card = get_subtotal_payment($sales_credict_card);


                $sales_special_discount = Item::where('payment', '<>', 0)
                    ->where('store_id', $store_id)
                    ->where('status', '3')
                    ->whereDate('created_at', '=', $date1)
                    ->where('sku', 'SD')
                    ->orderBy($sort, $direction)
                    ->get();
                $subtotal_special_discount = get_subtotal_payment($sales_special_discount);

                return view('admin.books.report', compact(
                    'date1',
                    'store',
                    'sales',
                    'subtotal_cash',
                    'subtotal_visa',
                    'subtotal_check',
                    'subtotal_credict_card',
                    'subtotal_special_discount',
                    'radio_select'
                ));

                break;

            case '2':
                // MASRTER CLASS
                $sales = Item::where('payment', '<>', 0)
                    ->where('store_id', $store_id)
                    ->whereBetween('created_at', [$date1, $date2])
                    ->orderBy($sort, $direction)
                    ->get();

                $sales_cash = Item::where('payment', '<>', 0)
                    ->where('store_id', $store_id)
                    ->where('status', '3')   //3 - significa elementos activos, 4-significa elemetos borrados
                    ->whereBetween('created_at', [$date1, $date2])
                    ->where('sku', 'CA')
                    ->orderBy($sort, $direction)
                    ->get();
                $subtotal_cash = get_subtotal_payment($sales_cash);


                $sales_visa = Item::where('payment', '<>', 0)
                    ->where('store_id', $store_id)
                    ->where('status', '3')
                    ->whereBetween('created_at', [$date1, $date2])
                    ->where('sku', 'VI')
                    ->orderBy($sort, $direction)
                    ->get();
                $subtotal_visa = get_subtotal_payment($sales_visa);


                $sales_check = Item::where('payment', '<>', 0)
                    ->where('store_id', $store_id)
                    ->where('status', '3')
                    ->whereBetween('created_at', [$date1, $date2])
                    ->where('sku', 'CH')
                    ->orderBy($sort, $direction)
                    ->get();
                $subtotal_check = get_subtotal_payment($sales_check);


                $sales_credict_card = Item::where('payment', '<>', 0)
                    ->where('store_id', $store_id)
                    ->where('status', '3')
                    ->whereBetween('created_at', [$date1, $date2])
                    ->where('sku', 'CR')
                    ->orderBy($sort, $direction)
                    ->get();
                $subtotal_credict_card = get_subtotal_payment($sales_credict_card);


                $sales_special_discount = Item::where('payment', '<>', 0)
                    ->where('store_id', $store_id)
                    ->where('status', '3')
                    ->whereBetween('created_at', [$date1, $date2])
                    ->where('sku', 'SD')
                    ->orderBy($sort, $direction)
                    ->get();
                $subtotal_special_discount = get_subtotal_payment($sales_special_discount);
                //dd($this->radio_select);

                return view('admin.books.report', compact(
                    'date1',
                    'date2',
                    'store',
                    'sales',
                    'subtotal_cash',
                    'subtotal_visa',
                    'subtotal_check',
                    'subtotal_credict_card',
                    'subtotal_special_discount',
                    'radio_select'
                ));

                break;

            default:
                # code...
                break;
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
