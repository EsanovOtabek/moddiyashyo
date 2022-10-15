<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Building;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BuildingController extends Controller
{

    public function index()
    {
        $rel = '>';
        $val = 0;
        if($this->is('komendant')) {
            $rel = '=';
            $val = \auth()->user()->id;
        }
        $buildings = Building::leftJoin('users',function($join)
        {
            $join->on("users.id","=","buildings.user_id");
        })->select('buildings.*','users.name as fio','users.phone')->where('user_id',$rel,$val)->orderBy('buildings.id','desc')->get();

        return view('admin.buildings',[
            'buildings' => $buildings
        ]);
    }

    public function create()
    {
        $komendant = User::select('id','name','phone')->where('role','komendant')->get();
        return view('admin.buildings-create',[
            'komendant' => $komendant,
        ]);
    }

    public function store(Request $request)
    {
        $user = Building::create($this->validateData());
        return redirect()->back()->with('success_msg', "Bino muvaffaqiyatli qo'shildi!");
    }

    public function show(Building $building)
    {
        $rooms = Room::where('building_id',$building->id)->get();
        $user = User::find($building->user_id);

        if($this->is('komendant') && auth()->user()->id != $user->id )
            return redirect()->route(auth()->user()->role . '.buildings.index');

        session()->flash('select_msg', $building->id);

        return view('admin.building',[
            'building' => $building,
            'rooms' => $rooms,
            'user' => $user,
            'rooms_count' => count($rooms),
        ]);
    }

    public function edit(Building $building)
    {
        $komendant = User::select('id','name','phone')->where('role','komendant')->get();

        return view('admin.building-edit',[
            'building' => $building,
            'komendant' => $komendant,
        ]);
    }

    public function update(Request $request, Building $building)
    {
        $data = $this->validateData();

        $building->update($data);
        return redirect()->back()->with('success_msg', "Bino ma'lumotlari yangilandi!");
    }

    public function destroy($id)
    {
        Building::destroy($id);
        return redirect()->back()->with('success_msg', "Yozuv muvaffaqiyatli o'chirildi!");
    }

    public function validateData(){
        return request()->validate([
            'name' => 'required',
            'location' => 'required',
            'floor' => 'required',
            'user_id' => 'required',
        ],
        ['required' => "Bo'sh maydonlar mavjud, ularni to'ldiring!!!"]);
    }
}
