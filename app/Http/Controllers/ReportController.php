<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Store;
use App\Dispatch;
use App\TBLDispatch;
use App\StockUpdateHistory;
use App\Use_product_history;
use DB;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    public function stockInword(){
        $result = StockUpdateHistory::select('stock_update_history.usage','stock_update_history.qty','stock_update_history.cost','ut.name','mn.name AS mn_name','pn.name AS pn_name','ca.category_name','stock_update_history.created_at','stock_update_history.updated_at')
        ->leftJoin('manufacturer AS mn','mn.id','stock_update_history.manufacture_name')
        ->leftJoin('product_name AS pn','pn.id','stock_update_history.product_name')
        ->leftJoin('category AS ca','ca.id','stock_update_history.category')
        ->leftJoin('unit AS ut','ut.id','stock_update_history.unit')
        ->get();
        return view('stockinword',compact('result'));
    }


    public function stockOutword(){
        $result = TBLDispatch::select('order_id','unit_name','manufacturer_name AS mn_name','product_name AS pn_name','category_name','tbl_dispatch.created_at','tbl_dispatch.updated_at','prod_price AS cost','provided_qty AS disp_qty','required_qty','cl.branch_name','cl.location')
            ->leftJoin('clinic_location AS cl','cl.id','tbl_dispatch.clinic_id')
            ->get();
        
        return view('stockoutword', compact('result'));
    }

    // public function stocks_report(){
    //     $data = Store::select(DB::raw('GROUP_CONCAT(store.id) AS ids'),DB::raw('GROUP_CONCAT(store.barcode_id) AS group_barcode_id'),DB::raw('GROUP_CONCAT(store.qty) AS group_qty'),DB::raw('SUM(store.qty) AS total_qty'),'c.category_name','pn.name AS pr_name','mn.name AS mn_name','u.name as unit_name')
    //     ->leftJoin('category AS c','c.id','=','store.category')
    //     ->leftJoin('product_name AS pn','pn.id','=','store.product_name')
    //     ->leftJoin('manufacturer AS mn','mn.id','=','store.manufacture_name')
    //     ->leftJoin('unit AS u','u.id','=','store.unit')
    //     //->where('store.qty','>',0)
    //     ->groupBy('store.category','store.manufacture_name','store.product_name')->get();
    //     // print_r($data);die();
        
    //     return view('stocks_report', compact('data'));
    // }

    public function stocks_report()
    {
        $data = Store::select(
            DB::raw('GROUP_CONCAT(store.id) AS ids'),
            DB::raw('GROUP_CONCAT(store.barcode_id) AS group_barcode_id'),
            DB::raw('GROUP_CONCAT(store.qty) AS group_qty'),
            DB::raw('SUM(store.qty) AS total_qty'),
            'c.category_name',
            'pn.name AS pr_name',
            'mn.name AS mn_name',
            'u.name as unit_name'
        )
            ->leftJoin('category AS c', 'c.id', '=', 'store.category')
            ->leftJoin('product_name AS pn', 'pn.id', '=', 'store.product_name')
            ->leftJoin('manufacturer AS mn', 'mn.id', '=', 'store.manufacture_name')
            ->leftJoin('unit AS u', 'u.id', '=', 'store.unit')
            ->groupBy(
                'store.category',
                'store.manufacture_name',
                'store.product_name',
                'u.name'
            )
            ->get();
    
        return view('stocks_report', compact('data'));
    }
    
    public function usedProductHistory(){
        $data = Use_product_history::latest()
        ->whereHas('tableDispatch', function($history) {
            $history->where('clinic_id', auth()->user()->location_id);
        })
        ->with('tableDispatch', 'user') 
        ->get();
        return view('use_product_history', compact('data'));
    }



}