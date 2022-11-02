<?php

namespace App\Http\Controllers;

use App\Models\Bitem;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Building;

class RoomController extends Controller
{
    public function create(){
        $rel = '>';
        $val = 0;
        if($this->is('komendant')) {
            $rel = '=';
            $val = \auth()->user()->id;
        }

        $buildings = Building::where('user_id',$rel,$val)->get();

        if(session()->has('select_msg')){
            session()->flash('select_msg',session('select_msg'));
        }

        return view('admin.room-create',[
            'buildings' => $buildings
        ]);
    }

    public function store(Request $request){
        if(Building::find($request->building_id)->user_id != auth()->user()->id && $this->is('komendant'))
            return redirect()->route(auth()->user()->role . '.buildings.index');

        $data = $this->validateData($request);
        $roomCheck = $this->getRoom($request->building_id,$request->room_no);

        if(count($roomCheck)>0 and $roomCheck!=null){
            $data['room_no'] = $data['floor'].''.$data['room_no'];
        }
        Room::create($data);

        if(session()->has('select_msg')){
            session()->flash('select_msg',session('select_msg'));
        }

        return redirect()->back()->with('success_msg','Xona qo\'shildi!');
    }

    public function show($building_id,$room_no)
    {
        $room = $this->getRoom($building_id,$room_no);
        $items = Item::all();
        $bitems = Bitem::leftJoin('items',function ($join){
            $join->on('items.id','=','bitems.item_id');
        })->select('bitems.*','items.name')->where('bitems.building_id','=',$room->building_id)->where('bitems.room_id','=',$room->id)->orderBy('items.name','ASC')->get();
        return view('admin.room',[
            'room'=>$room,
            'items'=>$items,
            'bitems'=>$bitems,
        ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function getRoom($building_id,$room_no) {
        return Room::where(['building_id'=>$building_id,'room_no'=>$room_no])->first();
    }

    public function validateData(){
        return request()->validate([
            'building_id' => 'required',
            'floor' => 'required',
            'room_no' => 'required',
        ],
        [
            'required' => "Bo'sh maydonlar mavjud, ularni to'ldiring!!!",
        ]);
    }
}
