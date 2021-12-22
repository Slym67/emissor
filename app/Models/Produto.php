<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
	use HasFactory;
	protected $fillable = [
		'nome', 'valor', 'cfop_interno', 'cfop_externo', 'ncm', 
		'categoria_id', 'codigo_barras', 'unidade_venda', 'perc_icms', 'perc_pis',
		'perc_cofins', 'perc_ipi', 'cst_csosn', 'cst_pis', 'cst_cofins', 'cst_ipi'
	];

	public function categoria(){
		return $this->belongsTo(Categoria::class, 'categoria_id');
	}

	public static function listaCSTCSOSN(){
		return [
			'00' => 'Tributa integralmente',
			'10' => 'Tributada e com cobrança do ICMS por substituição tributária',
			'20' => 'Com redução da Base de Calculo',
			'30' => 'Isenta / não tributada e com cobrança do ICMS por substituição tributária',
			'40' => 'Isenta',
			'41' => 'Não tributada',
			'50' => 'Com suspensão',
			'51' => 'Com diferimento',
			'60' => 'ICMS cobrado anteriormente por substituição tributária',
			'70' => 'Com redução da BC e cobrança do ICMS por substituição tributária',
			'90' => 'Outras',
			'101' => 'Tributada pelo Simples Nacional com permissão de crédito',
			'102' => 'Tributada pelo Simples Nacional sem permissão de crédito',
			'103' => 'Isenção do ICMS no Simples Nacional para faixa de receita bruta',
			'201' => 'Tributada pelo Simples Nacional com permissão de crédito e com cobrança do ICMS por substituição tributária',
			'202' => 'Tributada pelo Simples Nacional sem permissão de crédito e com cobrança do ICMS por substituição tributária',
			'203' => 'Isenção do ICMS no Simples Nacional para faixa de receita bruta e com cobrança do ICMS por substituição tributária',
			'300' => 'Imune',
			'400' => 'Não tributada pelo Simples Nacional',
			'500' => 'ICMS cobrado anteriormente por substituição tributária (substituído) ou por antecipação',
			'900' => 'Outros'
		];
	}

	public static function listaCST_PIS_COFINS(){
		return [
			'01' => 'Operação Tributável com Alíquota Básica',
			'02' => 'Operação Tributável com Alíquota por Unidade de Medida de Produto',
			'03' => 'Operação Tributável com Alíquota por Unidade de Medida de Produto',
			'04' => 'Operação Tributável Monofásica – Revenda a Alíquota Zero',
			'05' => 'Operação Tributável por Substituição Tributária',
			'06' => 'Operação Tributável a Alíquota Zero', 
			'07' => 'Operação Isenta da Contribuição', 
			'08' => 'Operação sem Incidência da Contribuição', 
			'09' => 'Operação com Suspensão da Contribuição', 
			'49' => 'Outras Operações de Saída'
		];
	}

	public static function listaCST_IPI(){
		return [
			'50' => 'Saída Tributada',
			'51' => 'Saída Tributável com Alíquota Zero',
			'52' => 'Saída Isenta',
			'53' => 'Saída Não Tributada',
			'54' => 'Saída Imune',
			'55' => 'Saída com Suspensão',
			'99' => 'Outras Saídas'
		];
	}

	public static function unidadesMedida(){
		return [
			"AMPOLA",
			"BALDE",
			"BANDEJ",
			"BARRA",
			"BISNAG",
			"BLOCO",
			"BOBINA",
			"BOMB",
			"CAPS",
			"CART",
			"CENTO",
			"CJ",
			"CM",
			"CM2",
			"CX",
			"CX2",
			"CX3",
			"CX5",
			"CX10",
			"CX15",
			"CX20",
			"CX25",
			"CX50",
			"CX100",
			"DISP",
			"DUZIA",
			"EMBAL",
			"FARDO",
			"FOLHA",
			"FRASCO",
			"GALAO",
			"GF",
			"GRAMAS",
			"JOGO",
			"KG",
			"KIT",
			"LATA",
			"LITRO",
			"M",
			"M2",
			"M3",
			"MILHEI",
			"ML",
			"MWH",
			"PACOTE",
			"PALETE",
			"PARES",
			"PC",
			"POTE",
			"K",
			"RESMA",
			"ROLO",
			"SACO",
			"SACOLA",
			"TAMBOR",
			"TANQUE",
			"TON",
			"TUBO",
			"UN",
			"VASIL",
			"VIDRO"
		];
	}

}
