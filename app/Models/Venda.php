<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;
	protected $fillable = ['valor', 'cliente_id', 'chave', 'numero_nfe', 'estado'];

	public function cliente(){
		return $this->belongsTo(Cliente::class, 'cliente_id');
	}

	public static function formasPagamento(){
        return [
            '01' => 'Dinheiro',
            '02' => 'Cheque',
            '03' => 'Cartão de Crédito',
            '04' => 'Cartão de Débito',
            '05' => 'Crédito Loja',
            '10' => 'Vale Alimentação',
            '11' => 'Vale Refeição',
            '12' => 'Vale Presente',
            '13' => 'Vale Combustível',
            '14' => 'Duplicata Mercantil',
            '15' => 'Boleto Bancário',
            '16' => 'Depósito Bancário',
            '17' => 'Pagamento Instantâneo (PIX)',
            '90' => 'Sem pagamento',
            '99' => 'Outros',
        ];
    }

    public static function getFormaPagamento($forma){
    	return Venda::formasPagamento()[$forma];
    }

    public function itens(){
        return $this->hasMany(ItemVenda::class, 'venda_id', 'id');
    }

    public function fatura(){
        return $this->hasMany('App\Models\FaturaVenda', 'venda_id', 'id');
    }
}
