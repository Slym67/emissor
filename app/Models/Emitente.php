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

	public static function getCUF($uf){
		$ufs = [
			'RO' => '11',
			'AC' => '12',
			'AM' => '13',
			'RR' => '14',
			'PA' => '15',
			'AP' => '16',
			'TO' => '17',
			'MA' => '21',
			'PI' => '22',
			'CE' => '23',
			'RN' => '24',
			'PB' => '25',
			'PE' => '26',
			'AL' => '27',
			'SE' => '28',
			'BA' => '29',
			'MG' => '31',
			'ES' => '32',
			'RJ' => '33',
			'SP' => '35',
			'PR' => '41',
			'SC' => '42',
			'RS' => '43',
			'MS' => '50',
			'MT' => '51',
			'GO' => '52',
			'DF' => '53'
		];
		return $ufs[$uf];
	}
}
