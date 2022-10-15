<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function index(Request $request)
    {
        $col = "items.name";
        $rel = "!=";
        $val = NULL;
        $col1=$col;
        $rel1=$rel;
        $val1=$val;
        if($request->search){
            $col = "items.name";
            $rel = "LIKE";
            $val = "%".$request->search."%";
        }
        if($request->category and $request->category!='all'){
            $col = "items.category_id";
            $rel = "=";
            $val = $request->category;
        }
    
        $items = Item::leftJoin('categories',function($join){
            $join->on("categories.id","=","items.category_id");   
        })->select('items.*','categories.name as category')->where($col,$rel,$val)->where($col1,$rel1,$val1)->orderBy('items.name','asc')->paginate(25);
        
        $categories = Category::all();
        return view('admin.items',[
            'items' => $items,
            'categories' => $categories,
            'search' => $request->search,
            'category_id' => $request->category,
        ]);  
    }

    
    public function create()
    {
        // $items = Item::orderBy('name','asc')->get();

        // return view('admin.items-create',[
        //     'items' => $items,
        // ]);
    }

    public function store(Request $request)
    {
        $item = Item::create($this->validateData());
        return redirect()->back()->with('success_msg', "Jihoz muvaffaqiyatli qo'shildi!");
    }

    public function add(Request $request,$id)
    {
        $item = Item::find($id);
        $item->amount += $request->amount; 
        $item->save();
        return redirect()->back()->with('success_msg', $item->name . "ga yana " . $request->amount . " ta qo'shildi!");
    }

    public function edit()
    {
        $items = Item::orderBy('name','asc')->get();
        $categories = Category::orderBy('name','asc')->get();

        return view('admin.items-add',[
            'items' => $items,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Item $item)
    {
        $item = $item->update($this->validateData());
        return redirect()->back()->with('success_msg', "Jihoz ma'lumotlari yangilandi!");

    }

    public function destroy($id)
    {
        Item::destroy($id);
        return redirect()->back()->with('success_msg', 'Jihoz muvaffaqiyatli o\'chirildi');
    }

    public function validateData(){
        return request()->validate([
            'name' => 'required',
            'category_id' => 'required',
            'amount' => 'required',
        ],
        ['required' => "Bo'sh maydonlar mavjud, ularni to'ldiring!!!"]);
    }
}
