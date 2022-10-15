<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Building;

class RoomController extends Controller
{
    // public function destroy($id)
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
        $roomCheck = Room::where('building_id',$request->building_id)->where('room_no',$request->room_no)->get();
        if(count($roomCheck)>0){
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
        $room = Room::where(
            ['building_id'=>$building_id,'room_no'=>$room_no])->get();
        return $room->all();
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
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
