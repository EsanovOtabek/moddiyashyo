<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::leftJoin('roles',function ($join){
            $join->on('roles.name','=','users.role');
        })->select('users.*','roles.description as role_description')->get();

        return view('admin.users',[
            'users' => $users
        ]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users-create',[
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData();

        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        return redirect('admin/users/create')->with('success_msg', "Foydalanuvchi muvaffaqiyatli qo'shildi!");
    }

    public function show(User $user)
    {
        dd($user);
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.user-edit',[
            'user' => $user,
            'roles' => $roles,
        ]);
    }


    public function update(Request $request, User $user)
    {
        $data = $this->validateData('');

        $data['password'] = bcrypt($data['password']);
        $user->update($data);

        return redirect()->back()->with('success_msg', "Foydalanuvchi ma'lumotlari yangilandi!");
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back()->with('success_msg', "Yozuv muvaffaqiyatli o'chirildi!");
    }

    public function validateData($addValidate='unique:users'){
        return request()->validate([
            'name' => 'required|min:4',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7|max:20',
            'login' => 'required|min:4|string|max:255|alpha_dash|'.$addValidate,
            'password' => 'required|min:6',
            'role' => 'required',
        ],[
            'required' => "Bo'sh maydonlar mavjud, ularni to'ldiring!!!",
            'unique' => "Bunday loginli foydalanuvchi allaqachon mavjud!",
            'name.min' => "To'liq ismingizni yozing!",
            'login.min' => "Login minimal uzunligi 4 belgiga teng",
            'phone.regex'=>"To'g'ri telefon raqam yozing!",
            'phone.min'=>"To'g'ri telefon raqam yozing!",
            'phone.max'=>"To'g'ri telefon raqam yozing!",
            'password.min'=>"Parol minimal 6 belgidan iborat bo'lsin"

        ]);
    }
}
