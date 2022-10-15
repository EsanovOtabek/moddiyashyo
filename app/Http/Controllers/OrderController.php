<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $rel = '>';
        $val = 0;
        if($this->is('komendant')) {
            $rel = '=';
            $val = \auth()->user()->id;
        }
        $orders = Order::leftJoin('users',function($join) {
            $join->on("users.id","=","orders.user_id");
        })->leftJoin('buildings',function ($join){
            $join->on('buildings.id','=','orders.building_id');
        })->leftJoin('items',function ($join){
            $join->on('items.id','=','orders.item_id');
        })->select('orders.*',
            'users.name as username',
            'users.phone as userphone',
            'buildings.name as buildingname',
            'items.name as itemname')
            ->where('orders.user_id',$rel,$val)
            ->orderBy('orders.id','desc')->get();

        return view('admin.orders',[
            'orders' => $orders,
        ]);
    }

    public function create()
    {
        $items = Item::all();
        $buildings = Building::all();

        if($this->is('komendant')){
            $buildings = Building::where('user_id',auth()->user()->id)->get();
        }
        return view('admin.order-create',[
            'items' => $items,
            'buildings' => $buildings,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData();

        $buildingCheck = Building::where('user_id',auth()->user()->id)
            ->where('id',$request->building_id)
            ->exists();

        if($this->is('komendant') && !$buildingCheck){
            return redirect()->back();
        }

        $data['user_id'] = auth()->user()->id;
        Order::create($data);

        return redirect()->back()->with('success_msg', "Buyurtma yuborildi!");
    }

    public function show(Order $order)
    {
        //
    }


    public function edit(Order $order)
    {
        //
    }

    public function update(Request $request, Order $order)
    {
        //
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->back()->with('success_msg',"Buyurtma bekor qilindi");
    }

    public function reject(Order $order)
    {
        if ($this->is('prorektor'))
            $order->status_1='rejected';
        elseif ($this->is('accountant'))
            $order->status_2='rejected';
        elseif ($this->is('ombor'))
            $order->status_3='rejected';
        else return redirect()->back();

        $order->save();
        return redirect()->back()->with('success_msg','Buyurtma rad etildi!');
    }

    public function accept(Order $order)
    {
        if ($this->is('prorektor'))
            $order->status_1='accepted';
        elseif ($this->is('accountant'))
            $order->status_2='accepted';
        elseif ($this->is('ombor'))
            $order->status_3='accepted';
        else return redirect()->back();

        $order->save();
        return redirect()->back()->with('success_msg','Buyurtma tasdiqlandi!');

    }

    public function validateData(){
        return request()->validate([
            'building_id' => 'required|numeric',
            'quantity' => 'required|numeric',
            'item_id' => 'required|numeric',
        ],[
            'required' => "Bo'sh maydonlar mavjud, ularni to'ldiring!!!",
            'numeric' => "Noto'g'ri harakat qilyapsiz"
        ]);
    }

    public function status_class($str){
        switch ($str){
            case "waiting": return [
                'class' => 'warning',
                'icon' => 'spinner',
            ];
            case "rejected": return [
                'class' => 'danger',
                'icon' => 'times',
            ];
            case "accepted": return [
                'class' => 'success',
                'icon' => 'check',
            ];
        }
    }
}









