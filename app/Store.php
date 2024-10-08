<?php

namespace App;
use App\Category;
use App\Manufacturer;
use App\Product_name;
use App\Unit;
use Illuminate\Database\Eloquent\Model;
use Milon\Barcode\DNS1D;
use App\Vendors;



class Store extends Model
{
    protected $table = "store";
    protected $fillable = [
        'id','category', 'manufacture_name', 'product_name','usage','unit','photo','description','tags','created_at','updated_at','user_id','qty','is_active','barcode_id','is_scanned','is_print','cost','vendor_id'
    ];

    public function Vendor_model()
    {
        return $this->belongsTo('App\Models\Vendors', 'vendor_id');
    }
    public function Unit_model()
    {
       return $this->belongsTo('App\Unit', 'unit');
    }

    public function Category_model()
    {
       return $this->belongsTo('App\Category', 'category');
    }

    public function Manufacturer_model()
    {
       return $this->belongsTo('App\Manufacturer', 'manufacture_name');
    }

    public function Product_model()
    {
       return $this->belongsTo('App\Product_name', 'product_name');
    }


}
    