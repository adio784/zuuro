<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPricing extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_quant',
        'network_code',
        'data_price',
        'duration',
        'interest',
        'loan_price'
    ];
    
}
