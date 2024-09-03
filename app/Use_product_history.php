<?php

namespace App;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Use_product_history extends Model
{
    protected $table = "used_product_history";
    protected $fillable = [
        'id','tbl_dispatch_id', 'use_qty','user_id'
    ];
    
    public function tableDispatch(){
        return $this->belongsTo('App\TBLDispatch', 'tbl_dispatch_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}