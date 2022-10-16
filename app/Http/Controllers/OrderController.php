<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Item;
use App\Models\Order;
use App\Models\Section;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $rel = '>';
        $val = 0;
        if($this->is('komendant') || $this->is('employee')) {
            $rel = '=';
            $val = \auth()->user()->id;
        }
        $orders = Order::leftJoin('users',function($join) {
            $join->on("users.id","=","orders.user_id");
        })->leftJoin('buildings',function ($join){
            $join->on('buildings.id','=','orders.building_id');
        })->leftJoin('sections',function ($join){
            $join->on('sections.id','=','orders.section_id');
        })->leftJoin('items',function ($join){
            $join->on('items.id','=','orders.item_id');
        })->select('orders.*',
            'users.name as username',
            'users.phone as userphone',
            'buildings.name as buildingname',
            'sections.name as sectionname',
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
        $sections = Section::all();

        if($this->is('komendant')){
            $buildings = Building::where('user_id',auth()->user()->id)->get();
        }

        if($this->is('employee')){
            $buildings = Section::where('user_id',auth()->user()->id)->get();
        }
        return view('admin.order-create',[
            'items' => $items,
            'buildings' => $buildings,
            'sections' => $sections,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData();

        $buildingCheck = Building::where('user_id',auth()->user()->id)
            ->where('id',$request->building_id)
            ->exists();

        $sectionCheck = Section::where('user_id',auth()->user()->id)
            ->where('id',$request->section_id)
            ->exists();

        if($this->is('komendant') && !$buildingCheck){
            return redirect()->back();
        }

        if($this->is('section') && !$sectionCheck){
            return redirect()->back();
        }
        $data['building_id'] = $request->building_id;
        $data['section_id'] = $request->section_id;
        $data['user_id'] = auth()->user()->id;
        Order::create($data);

        return redirect()->back()->with('success_msg', "Buyurtma yuborildi!");
    }

//    public function show(Order $order)
//    public function edit(Order $order)
//    public function update(Request $request, Order $order)

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->back()->with('success_msg',"Buyurtma bekor qilindi");
    }

    public function reject(Order $order)
    {
        if ($this->is('prorektor')) {
            $order->status_1 = 'rejected';
            $order->status_1_id = auth()->user()->id();
        }
        elseif ($this->is('accountant')) {
            $order->status_2 = 'rejected';
            $order->status_2_id = auth()->user()->id();
        }
        elseif ($this->is('warehouse')){
            $order->status_3='rejected';
            $order->status_3_id = auth()->user()->id();
        }
        else return redirect()->back();

        $order->save();
        return redirect()->back()->with('success_msg','Buyurtma rad etildi!');
    }

    public function accept(Order $order)

    {
        if ($this->is('prorektor')) {
            $order->status_1 = 'accepted';
            $order->status_1_id = auth()->user()->id;
        }
        elseif ($this->is('accountant')) {
            $order->status_2 = 'accepted';
            $order->status_2_id = auth()->user()->id;
        }
        elseif ($this->is('warehouse')){
            $order->status_3='accepted';
            $order->status_3_id = auth()->user()->id;
        }
        else return redirect()->back();

        $order->save();
        return redirect()->back()->with('success_msg','Buyurtma tasdiqlandi!');

    }
    public function validateData(){
        return request()->validate([
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









