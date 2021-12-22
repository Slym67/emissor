<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emitente extends Model
{
    use HasFactory;
    protected $fillable = [
		'razao_social', 'nome_fantasia', 'rua', 'numero', 'bairro', 'cep', 'telefone', 
		'complemento', 'ie_rg', 'cpf_cnpj', 'numero_serie_nfe', 'cidade_id', 'complemento', 
		'ultimo_numero_nfe', 'certificado', 'senha', 'ambiente'
	];

	public function cidade(){
		return $this->belongsTo(Cidade::class, 'cidade_id');
	}

	public static function ambientes(){
		return [
			'1' => 'Produção',
			'2' => 'Homologação'
		];
	}
}
