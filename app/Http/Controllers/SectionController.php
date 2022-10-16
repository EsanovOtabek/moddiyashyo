<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {

        $rel = '>';
        $val = 0;
        if($this->is('employee')) {
            $rel = '=';
            $val = \auth()->user()->id;
        }
        $sections = Section::leftJoin('users',function($join)
        {
            $join->on("users.id","=","sections.user_id");
        })->select('sections.*','users.name as fio','users.phone','users.login')->where('user_id',$rel,$val)->orderBy('sections.id','desc')->get();

        $users = User::where('role','employee')->get();

        return view('admin.sections',[
            'sections' => $sections,
            'employees' => $users,
        ]);
    }

    public function store(Request $request)
    {
        $data = Section::create($this->validateData());
        return redirect()->back()->with('success_msg', "Bo'lim(Fakultet) muvaffaqiyatli qo'shildi!");
    }

    public function update(Request $request, Section $section)
    {
        $data = $section->update($this->validateData());
        return redirect()->back()->with('success_msg', "Bo'lim(Fakultet) muvaffaqiyatli qo'shildi!");
    }

    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->back()->with('success_msg', "Bo'lim(Fakultet) muvaffaqiyatli o'chirildi!");
    }

    public function validateData(){
        return request()->validate([
            'name' => 'required',
            'director' => 'required',
            'user_id' => 'required',
        ],[
            'required' => "Bo'sh maydonlar mavjud, ularni to'ldiring!!!"
        ]);
    }
}
