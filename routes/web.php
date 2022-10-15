<?php

use App\Http\Controllers\AccountantController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProrektorController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\KomendantController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', 'login');

Route::get('login',[AuthController::class, 'index'])->name('login.index');
Route::post('login',[AuthController::class, 'login'])->name('login');
Route::get('logout',[AuthController::class, 'logout'])->name('logout');


Route::prefix('admin/')->middleware('role:admin')->group(function(){
    Route::get('home/',[AdminController::class, 'home']);
    Route::get('/',[AdminController::class, 'home']);

    Route::resource('roles', RoleController::class,[
        'except' =>['create', 'edit'],
        'as'=>'admin'
    ]);

    Route::resource('users', UserController::class,[
        'as'=>'admin'
    ]);

    Route::resource('buildings', BuildingController::class,[
        'as' => 'admin'
    ]);

    Route::resource('categories', CategoryController::class,[
        'except' =>['create', 'edit'],
        'as' => 'admin'
    ]);

    Route::resource('items', ItemController::class,[
        'except' => ['show','edit'],
        'as' => 'admin'
    ]);

    Route::get('items/add/',[ItemController::class,'edit'])->name('admin.item.add');
    Route::post('items/add/{id}',[ItemController::class,'add'])->name('admin.items.add');

    Route::get('buildings/{building}/{room}', [RoomController::class,'show'])->name('admin.buildings.room');

    Route::get( 'createRoom', [RoomController::class,'create'])->name('admin.room.create');
    Route::post('createRoom', [RoomController::class,'store'])->name('admin.room.store');
    Route::resource('orders', OrderController::class,[
        'as' => 'admin',
        'only' => ['index','destroy']
    ]);
});

Route::prefix('komendant/')->middleware('role:komendant')->group(function(){
    Route::get('home/',[KomendantController::class, 'home']);
    Route::get('/',[KomendantController::class, 'home']);
    Route::get('buildings',[BuildingController::class, 'index'])->name('komendant.buildings.index');
    Route::get('buildings/{building}',[BuildingController::class, 'show'])->name('komendant.buildings.show');
    Route::get( 'createRoom', [RoomController::class,'create'])->name('komendant.room.create');
    Route::post('createRoom', [RoomController::class,'store'])->name('komendant.room.store');
    Route::get('buildings/{building}/{room}', [RoomController::class,'show'])->name('komendant.buildings.room');

    Route::resource('orders', OrderController::class,[
        'as' => 'komendant',
        'expect' => ['show','edit','update']
    ]);
});

Route::prefix('prorektor/')->middleware('role:prorektor')->group(function(){
    Route::get('home/',[ProrektorController::class, 'home']);
    Route::get('/',[ProrektorController::class, 'home']);
    Route::get('buildings',[BuildingController::class, 'index'])->name('prorektor.buildings.index');
    Route::get('buildings/{building}',[BuildingController::class, 'show'])->name('prorektor.buildings.show');
    Route::get('buildings/{building}/{room}', [RoomController::class,'show'])->name('prorektor.buildings.room');
    Route::get('users/',[UserController::class, 'index'])->name('prorektor.users.index');
    Route::get('users/{user}',[UserController::class, 'show'])->name('prorektor.users.show');
    Route::get('orders/',[OrderController::class, 'index'])->name('prorektor.orders.index');
    Route::put('orders/{order}/reject',[OrderController::class, 'reject'])->name('prorektor.orders.reject');
    Route::put('orders/{order}/accept',[OrderController::class, 'accept'])->name('prorektor.orders.accept');
    Route::get('items/',[ItemController::class, 'index'])->name('prorektor.items.index');
    Route::get('categories/',[CategoryController::class, 'index'])->name('prorektor.categories.index');
});

Route::prefix('accountant/')->middleware('role:accountant')->group(function(){
    Route::get('home/',[AccountantController::class, 'home']);
    Route::get('/',[AccountantController::class, 'home']);
    Route::get('orders/',[OrderController::class, 'index'])->name('accountant.orders.index');
    Route::put('orders/{order}/reject',[OrderController::class, 'reject'])->name('accountant.orders.reject');
    Route::put('orders/{order}/accept',[OrderController::class, 'accept'])->name('accountant.orders.accept');
    Route::get('buildings',[BuildingController::class, 'index'])->name('accountant.buildings.index');
    Route::get('buildings/{building}',[BuildingController::class, 'show'])->name('accountant.buildings.show');
    Route::get('buildings/{building}/{room}', [RoomController::class,'show'])->name('accountant.buildings.room');
    Route::get('users/',[UserController::class, 'index'])->name('accountant.users.index');
    Route::get('users/{user}',[UserController::class, 'show'])->name('accountant.users.show');
    Route::get('items/',[ItemController::class, 'index'])->name('accountant.items.index');
});



Route::prefix('warehouse/')->middleware('role:warehouse')->group(function(){
    Route::get('home/',[WarehouseController::class, 'home']);
    Route::get('/',[WarehouseController::class, 'home']);

    Route::get('buildings',[BuildingController::class, 'index'])->name('warehouse.buildings.index');
    Route::get('buildings/{building}',[BuildingController::class, 'show'])->name('warehouse.buildings.show');
    Route::get('buildings/{building}/{room}', [RoomController::class,'show'])->name('warehouse.buildings.room');

    Route::resource('categories', CategoryController::class,[
        'except' =>['create', 'edit'],
        'as' => 'warehouse'
    ]);

    Route::resource('items', ItemController::class,[
        'except' => ['show','edit'],
        'as' => 'warehouse'
    ]);
    Route::get('items/add/',[ItemController::class,'edit'])->name('warehouse.item.add');
    Route::post('items/add/{id}',[ItemController::class,'add'])->name('warehouse.items.add');

    Route::get('orders/',[OrderController::class, 'index'])->name('warehouse.orders.index');
    Route::put('orders/{order}/reject',[OrderController::class, 'reject'])->name('warehouse.orders.reject');
    Route::put('orders/{order}/accept',[OrderController::class, 'accept'])->name('warehouse.orders.accept');

});
