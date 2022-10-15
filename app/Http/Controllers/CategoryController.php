<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id','desc')->get();

        return view('admin.categories',[
            'categories' => $categories
        ]);      
    }

    public function store(Request $request)
    {
        $data = $this->validateData();    

        $category = Category::create($data);
        return redirect()->back()->with('success_msg', "Kategoriya muvaffaqiyatli qo'shildi!");
  
    }

    public function update(Request $request, Category $category)
    {
        $data = $this->validateData();    

        $category->update($data);
        return redirect()->back()->with('success_msg', "Kategoriya ma'lumotlari yangilandi!");
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return redirect()->back()->with('success_msg', "Yozuv muvaffaqiyatli o'chirildi!");
    }

    public function validateData(){
        return request()->validate([
            'name' => 'required',
        ],
        ['required' => "Bo'sh maydonlar mavjud, ularni to'ldiring!!!"]);
    }
}
