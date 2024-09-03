<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReceiveController;
use App\Http\Controllers\DispatchController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\ClinicLocationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VendorController;

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

Route::get('/', function () {
    return view('auth/login');
});
Route::get('/hello', function () {
    return "Hello World";
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
 Route::get('/home', [HomeController::class,'index'])->name('home');
Route::any('/clinic_details',[HomeController::class,'clinic_details'])->name('clinic_details');
Route::any('/create', [HomeController::class,'create'])->name('create');
Route::any('/add_store',[HomeController::class,'add_store'])->name('add_store');
Route::any('/edit_details/{id?}', [HomeController::class,'edit_details'])->name('edit_details');
Route::any('/edit_register/{id?}', [HomeController::class,'edit_register'])->name('edit_register');
Route::get('/report', [HomeController::class,'report'])->name('report');
Route::get('/all_report', [HomeController::class,'all_report'])->name('all_report');

Route::any('/store-eq', [StoreController::class,'index'])->name('store_view');
Route::any('/view-barcode/{id?}', [StoreController::class,'viewBarcode'])->name('view-barcode');
Route::any('/add_stock', [StoreController::class,'add_stock'])->name('add_stock');
Route::any('/stock_register', [StoreController::class,'stock_register'])->name('stock_register');
Route::any('/edit_stock/{id?}', [StoreController::class,'edit_stock'])->name('edit_stock');
Route::any('/update_stock', [StoreController::class,'update_stock'])->name('update_stock');

Route::any('/dispatch', [DispatchController::class,'index'])->name('dispatch');
Route::any('/add_dispatch', [DispatchController::class,'add_dispatch'])->name('add_dispatch');
Route::any('/all_dispatch', [DispatchController::class,'all_dispatch'])->name('all_dispatch');
Route::post('/insert_dispatch', [DispatchController::class,'insert_dispatch'])->name('insert_dispatch');
Route::any('/get_bar_code_data', [DispatchController::class,'get_bar_code_data'])->name('get_bar_code_data');

Route::any('/qrgenerator', [StoreController::class,'qr_generator'])->name('qrgenerator');

Route::any('/clinic', [ClinicLocationController::class,'index'])->name('clinic');
Route::any('/add_clinic', [ClinicLocationController::class,'add_clinic'])->name('add_clinic');
Route::any('/add_location', [ClinicLocationController::class,'add_location'])->name('add_location');
Route::any('/edit_location/{id?}', [ClinicLocationController::class,'edit_location'])->name('edit_location');
Route::any('/update_location', [ClinicLocationController::class,'update_location'])->name('update_location');

Route::any('/category', [CategoryController::class,'index'])->name('category');
Route::any('/add_category', [CategoryController::class,'add_category'])->name('add_category');
Route::any('/insert_category', [CategoryController::class,'insert_category'])->name('insert_category');
Route::any('/update_category', [CategoryController::class,'update_category'])->name('update_category');
Route::any('/edit_category/{id?}', [CategoryController::class,'edit_category'])->name('edit_category');

Route::any('/manufacturer', [ManufacturerController::class,'index'])->name('manufacturer');
// Route::any('/add_manufacturer', 'ManufacturerController@add_manufacturer')->name('add_manufacturer');
Route::any('/insert_manufacturer', [ManufacturerController::class,'set_manufacturer'])->name('insert_manufacturer');
Route::any('/update_manufacturer', [ManufacturerController::class,'update_manufacturer'])->name('update_manufacturer');
Route::any('/edit_manufacturer/{id?}', [ManufacturerController::class,'edit_manufacturer'])->name('edit_manufacturer');
Route::any('/get_manuf_data', [ManufacturerController::class,'get_manuf_data'])->name('get_manuf_data');

Route::any('/product', [ProductController::class,'index'])->name('product');
Route::any('/add_product', [ProductController::class,'addProduct'])->name('add_product');
Route::any('/set_product', [ProductController::class,'set_product'])->name('set_product');
Route::any('/update_product', [ProductController::class,'update_product'])->name('update_product');
Route::any('/edit_product/{id?}', [ProductController::class,'edit_product'])->name('edit_product');

Route::any('/unit', [UnitController::class,'index'])->name('unit');
//Route::any('/add_unit', 'UnitController@add_unit')->name('add_unit');
Route::any('/insert_unit', [UnitController::class,'set_unit'])->name('insert_unit');
Route::any('/update_unit', [UnitController::class,'update_unit'])->name('update_unit');
Route::any('/edit_unit/{id?}', [UnitController::class,'edit_unit'])->name('edit_unit');

Route::any('/product_receive', [ReceiveController::class,'index'])->name('product_receive');
Route::any('/scan_product', [ReceiveController::class,'scan_product'])->name('scan_product');
Route::any('/received_orders', [OrderController::class,'receivedOrders'])->name('received_orders');
Route::any('/purchase_order', [OrderController::class,'purchaseOrder'])->name('purchase_order');
Route::any('/product_used', [ReceiveController::class,'product_used'])->name('product_used');

Route::any('/prod_by_category', [AjaxController::class,'prodByCategory'])->name('prod_by_category');
Route::any('/prod_details_by_unit_cat_man_prod', [AjaxController::class,'prodDetailsByUnitCatManProd'])->name('prod_details_by_unit_cat_man_prod');
Route::any('/unit_by_category_man', [AjaxController::class,'unitByCategoryMan'])->name('unit_by_category_man');
Route::any('/price_by_unit_cat_man', [AjaxController::class,'priceByUnitCatMan'])->name('price_by_unit_cat_man');
Route::any('/unit_by_product', [AjaxController::class,'unitByProduct'])->name('unit_by_product');
Route::any('/manufracture_by_category',[AjaxController::class,'manufractureByCategory'])->name('manufracture_by_category');
Route::any('/order_final_submit', [AjaxController::class,'orderFinalSubmit'])->name('order_final_submit');

Route::any('/view_my_orders', [OrderController::class,'viewMyOrders'])->name('view_my_orders');
Route::any('/delete_order/{id?}', [OrderController::class,'deleteOrder'])->name('delete_order');
Route::any('/get_order_by_id', [OrderController::class,'getOrderById'])->name('get_order_by_id');
Route::any('/view_invoice/{id?}', [OrderController::class,'viewInvoice'])->name('view_invoice');
Route::any('/all_order', [OrderController::class,'completedOrder'])->name('completed_order');


Route::any('/all_clinc_users', [HomeController::class,'all_clinc_users'])->name('all_clinc_users');
Route::any('/stock_details', [StoreController::class,'stockDetails'])->name('stock_details');
Route::any('/unit_by_category_man_clinic', [AjaxController::class,'unitByCategoryManClinic'])->name('unit_by_category_man_clinic');

Route::any('/get_recive_id', [ReceiveController::class,'get_recive_id'])->name('get_recive_id');
Route::any('/get_use_id',[ReceiveController::class,'get_use_id'])->name('get_use_id');

Route::any('/stock-inword',[ReportController::class,'stockInword']);
Route::any('/stock-outword', [ReportController::class,'stockOutword']);
Route::get('/stock_report', [ReportController::class,'stocks_report']);

Route::get('/used-product-history', [ReportController::class,'usedProductHistory']);
Route::get('/vendors', [VendorController::class,'index']);
Route::any('/insert_vendor', [VendorController::class,'set_vendor']);
Route::any('/edit_vendor/{id?}', [VendorController::class,'edit_vendor']);
Route::any('/update_vendor', [VendorController::class,'update_vendor']);


// Route::post('/accept-order/{id}', [ReceiveController::class,'acceptOrder'])->name('accept.order');



// Route::any('/dummy-data', [ReceiveController::class,'dummyData']);