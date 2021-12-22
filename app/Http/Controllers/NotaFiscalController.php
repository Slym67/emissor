<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Emitente;
use App\Services\NFeService;

class NotaFiscalController extends Controller
{
	public function gerarXml($id){
		try{
			$venda = Venda::find($id);
			$emitente = Emitente::first();

			if($emitente == null){
				session()->flash('erro', 'Configure o emitente');
				return redirect('emitente');
			}

			$cnpj = str_replace(".", "", $emitente->cpf_cnpj);
			$cnpj = str_replace("/", "", $cnpj);
			$cnpj = str_replace("-", "", $cnpj);
			$cnpj = str_replace(" ", "", $cnpj);

			$nfe_service = new NFeService([
				"atualizacao" => date('Y-m-d h:i:s'),
				"tpAmb" => (int)$emitente->ambiente,
				"razaosocial" => $emitente->razao_social,
				"siglaUF" => $emitente->cidade->uf,
				"cnpj" => $cnpj,
				"schemes" => "PL_009_V4",
				"versao" => "4.00",
				"tokenIBPT" => "AAAAAAA",
				"CSC" => "AAAAAAA",
				"CSCid" => "000001"
			], $emitente);
			
			
		}catch(\Exception $e){
			session()->flash('erro', $e->getMessage());
			return redirect()->back();
		}
	}
}
