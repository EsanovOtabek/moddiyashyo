<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        return view('admin.roles',[
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        Role::create($this->validateData());
        return redirect()->back()->with('success_msg',"Foydalnuvchi roli muvaffaqiyatli qo'shildi!");
    }

    public function update(Request $request, Role $role)
    {
        $role->update($this->validateData());
        return redirect()->back()->with('success_msg', "Rol ma'lumotlari yangilandi!");
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back()->with('success_msg', "Foydalnuvchi roli o'chirildi!");
    }

    public function getAuthMessage($role){
        return $this->getRoleDescription($role) . ' bo\'lib tizimga kirdingiz!';
    }
    public function getRoleDescription($role){
        $r = Role::where('name',$role)->first();
        return $r->description;
    }

    public function redirectRole($role){
        $r = Role::where('name',$role)->first();
        return $r->name . '/home';
    }

    public function validateData()
    {
        return request()->validate([
            'name' => 'required',
            'description' => 'required',
            ],[
            'required' => "Bo'sh maydonlar mavjud, ularni to'ldiring!!!"
        ]);
    }

    public function hasRole($role)
    {
        return Role::where('name',$role)->exists();
    }
}
