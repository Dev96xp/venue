<?php

namespace App\Livewire\Admin\Order;

use App\Models\Department;
use App\Models\ShippingCompany;
use Livewire\Component;

class StatusOrder extends Component
{
    public $order, $status;
    public $tracking1, $tracking2;
    public $shipping_companies, $shipping_company_id;

    public function mount(){
        // 1. La variable $status, recibe su valor inicial de la orden actual
        $this->status = $this->order->status;
        $this->tracking1 = $this->order->tracking_no1;
        $this->tracking2 = $this->order->tracking_no2;
        $this->shipping_company_id = $this->order->shipping_company_id;

        $this->shipping_companies = ShippingCompany::all();
    }


    public function updatedShippingCompanyId($value){
        $shipping_company = ShippingCompany ::find($value);
        $this->shipping_company_id = $shipping_company->id; // OJO - PARA MODIFICAR SI ES NECESARIO PARA shippin_cost
        // dd($shipping_company->name);
    }

    public function update(){
        // orden actual recibe su nuevo status, segun el usuario cambio el formulario
        $this->order->status = $this->status;
        // una vez obenido el valor guardarlo(actualizarlo)
        $this->order->save();
    }

    public function update_tracking(){
        $this->order->tracking_no1 = $this->tracking1;
        $this->order->tracking_no2 = $this->tracking2;
        $this->order->shipping_company_id = $this->shipping_company_id;
        $this->order->save();
    }

    // TODAVIA NO TRABAJA
    public function print_label(){

        $departments = Department::all();
        dd($departments);
        return view('admin.departments.print',compact('departments'));
    }


    public function render()
    {
        $items = json_decode($this->order->content);

        return view('livewire.admin.order.status-order', compact('items'));
    }
}

