<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaturaVenda extends Model
{
    use HasFactory;
	protected $fillable = ['valor', 'vencimento', 'venda_id', 'forma_pagamento'];

}
