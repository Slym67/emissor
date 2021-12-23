<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Emitente;
use App\Services\NFeService;
use NFePHP\DA\NFe\DanfeSimples;
use NFePHP\DA\NFe\Danfe;
use NFePHP\DA\NFe\Daevento;

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
			
			$result = $nfe_service->gerarXml($venda, $emitente);

			if(!isset($result['erros_xml'])){
				$xml = $result['xml'];
				return response($xml)
				->header('Content-Type', 'application/xml');
			}else{
				print_r($result['erros_xml']);
			}
			
		}catch(\Exception $e){
			session()->flash('erro', $e->getMessage());
			return redirect()->back();
		}
	}

	public function transmitir(Request $request){
		try{

			$venda = Venda::find($request->venda_id);
			$emitente = Emitente::first();

			if($emitente == null){
				return response()->json('Configure o emitente', 404);
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

			if($venda->estado == 'Rejeitado' || $venda->estado == 'Novo'){
				$result = $nfe_service->gerarXml($venda, $emitente);

				if(!isset($result['erros_xml'])){
					$signed = $nfe_service->sign($result['xml']);
					$resultado = $nfe_service->transmitir($signed, $result['chave']);
					if(isset($resultado['sucesso'])){
						$venda->chave = $result['chave'];
						$venda->estado = 'Aprovado';
						$venda->numero_nfe = $result['nNf'];

						$venda->save();
						return response()->json($resultado['sucesso'], 200);
					}else{
						$venda->estado = 'Rejeitado';
						$venda->save();
						return response()->json($resultado['erro'], 401);
					}

				}else{
					return response()->json($result['erros_xml'], 404);
				}
			}else{
				return response()->json("", 404);
			}

			return response()->json($venda, 200);
		}catch(\Exception $e){
			return response()->json($e->getMessage(), 404);
		}
	}

	public function imprimir($id){
		try{
			$venda = Venda::find($id);

			$xml = file_get_contents(public_path('xml_nfe/').$venda->chave.'.xml');
			$danfe = new Danfe($xml);
			$pdf = $danfe->render();
			return response($pdf)
			->header('Content-Type', 'application/pdf');
		}catch(\Exception $e){
			session()->flash("erro", $e->getMessage());
			return redirect()->back();
		}
	}

	public function imprimirSimples($id){
		try{
			$venda = Venda::find($id);

			$xml = file_get_contents(public_path('xml_nfe/').$venda->chave.'.xml');
			$danfe = new DanfeSimples($xml);
			$pdf = $danfe->render();
			return response($pdf)
			->header('Content-Type', 'application/pdf');
		}catch(\Exception $e){
			session()->flash("erro", $e->getMessage());
			return redirect()->back();
		}
	}

	public function download($id){
		try{
			$venda = Venda::find($id);

			$xml = public_path('xml_nfe/').$venda->chave.'.xml';
			return response()->download($xml);
		}catch(\Exception $e){
			session()->flash("erro", $e->getMessage());
			return redirect()->back();
		}
	}

	public function cartaCorrecao(Request $request){
		try{
			$venda = Venda::find($request->venda_id);
			$emitente = Emitente::first();

			if($emitente == null){
				return response()->json('Configure o emitente', 404);
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

			$result = $nfe_service->cartaCorrecao($venda, $request->justificativa);
			if(!isset($result['erro'])){
				return response()->json($result, 200);
			}else{
				return response()->json($result['data'], 404);
			}

		}catch(\Exception $e){
			return response()->json($e->getMessage(), 404);
		}
	}

	public function cancenlarNFe(Request $request){
		try{
			$venda = Venda::find($request->venda_id);
			$emitente = Emitente::first();

			if($emitente == null){
				return response()->json('Configure o emitente', 404);
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

			$nfe = $nfe_service->cancelar($venda, $request->justificativa);

			if(!isset($nfe['erro'])){

				$venda->estado = 'Cancelado';
				$venda->valor = 0;
				$venda->save();

				return response()->json($nfe, 200);
			}else{
				return response()->json($nfe['data'], 404);
			}

		}catch(\Exception $e){
			return response()->json($e->getMessage(), 404);
		}
	}

	public function imprimirCorrecao($id){
		try{
			$venda = Venda::find($id);

			$xml = file_get_contents(public_path('xml_nfe_correcao/').$venda->chave.'.xml');
			$dadosEmitente = $this->getEmitente();

			$daevento = new Daevento($xml, $dadosEmitente);
			$daevento->debugMode(true);
			$pdf = $daevento->render();

			return response($pdf)
			->header('Content-Type', 'application/pdf');
		}catch(\Exception $e){
			session()->flash("erro", $e->getMessage());
			return redirect()->back();
		}
	}

	public function imprimirCancelamento($id){
		try{
			$venda = Venda::find($id);

			$xml = file_get_contents(public_path('xml_nfe_cancelada/').$venda->chave.'.xml');
			$dadosEmitente = $this->getEmitente();

			$daevento = new Daevento($xml, $dadosEmitente);
			$daevento->debugMode(true);
			$pdf = $daevento->render();

			return response($pdf)
			->header('Content-Type', 'application/pdf');
		}catch(\Exception $e){
			session()->flash("erro", $e->getMessage());
			return redirect()->back();
		}
	}

	private function getEmitente(){
		$emitente = Emitente::first();
		return [
			'razao' => $emitente->razao_social,
			'logradouro' => $emitente->rua,
			'numero' => $emitente->numero,
			'complemento' => '',
			'bairro' => $emitente->bairro,
			'CEP' => str_replace("-", "", $emitente->cep),
			'municipio' => $emitente->municipio,
			'UF' => $emitente->cidade->uf,
			'telefone' => $emitente->telefone,
			'email' => ''
		];
	}
}
