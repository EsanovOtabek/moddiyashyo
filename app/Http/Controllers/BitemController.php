<?php

namespace App\Http\Controllers;

use App\Models\Bitem;
use Illuminate\Http\Request;

class BitemController extends Controller
{

    public function store(Request $request,$building_id,$room_no)
    {
        $data = $this->validateData();
        $data['building_id'] = $building_id;
        $data['room_id'] = RoomController::getRoom($building_id, $room_no)['id'];
        $bitem = Bitem::create($data);
        return redirect()->back()->with('success_msg', "Jihoz xonaga muvaffaqiyatli biriktirildi!");
    }

    public function update(Request $request, Bitem $bitem)
    {
        $bitem -> update($this->validateData());
        return redirect()->back()->with('success_msg', "Jihoz ma'lumotlari yangilandi!");
    }

    public function destroy(Bitem $bitem)
    {
        $bitem->delete();
        return redirect()->back()->with('success_msg', "Jihoz muvaffaqiyatli o'chirildi!");
    }

    public function validateData(){
        return request()->validate([
            'code' => 'required',
            'item_id' => 'required',
        ],[
                'required' => "Bo'sh maydonlar mavjud, ularni to'ldiring!!!",
            ]);
    }

}
