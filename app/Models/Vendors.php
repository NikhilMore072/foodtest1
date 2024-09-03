<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendors extends Model
{


    protected $fillable = [
        'id', 'vendor_name', 'address', 'contact_number', 'status'
    ];

    protected $primaryKey = 'id';


}
