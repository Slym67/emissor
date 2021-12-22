<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
	use HasFactory;
	protected $fillable = [
		'nome', 'rua', 'numero', 'bairro', 'cep', 'telefone', 
		'complemento', 'ie_rg', 'cpf_cnpj', 'contribuinte', 'cidade_id', 'complemento'
	];

	public function cidade(){
		return $this->belongsTo(Cidade::class, 'cidade_id');
	}
}
