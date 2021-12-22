<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemVenda extends Model
{
    use HasFactory;
	protected $fillable = ['valor', 'quantidade', 'venda_id', 'produto_id'];

	public function produto(){
		return $this->belongsTo(Produto::class, 'produto_id');
	}
}
