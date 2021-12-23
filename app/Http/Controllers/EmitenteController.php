<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emitente;
use App\Models\Cidade;

class EmitenteController extends Controller
{
	public function index(){
		try{
			$emitente = Emitente::first();
			$cidades = Cidade::all();
			if(sizeof($cidades) == 0){
				session()->flash('erro', 'Cadastre ao menos uma cidade');
				return redirect('cidades');
			}
			$titulo = 'Emitente';
			return view('emitente/index', compact('emitente', 'cidades', 'titulo'));
		}catch(\Exception $e){
			session()->flash('erro', $e->getMessage());
			return redirect()->back();
		}
	}

	public function save(Request $request){
		$emitente = Emitente::first();
		$this->_validate($request, $emitente != null);

		try{

			if($emitente == null){
				//salvar
				$request->merge(['complemento' => $request->complemento ?? '']);

				if($request->hasFile('certificado')){
					$file = $request->file('certificado');
					$ctx = file_get_contents($file);
					$request->merge(['certificado' => $ctx]);
				}

				Emitente::create($request->all());
				session()->flash('sucesso', 'Emitente salvo!');

			}else{
				//update

				if($request->hasFile('certificado')){
					$file = $request->file('certificado');
					$ctx = file_get_contents($file);
					$emitente->certificado = $ctx;
				}

				$emitente->razao_social = $request->razao_social;
				$emitente->nome_fantasia = $request->nome_fantasia;
				$emitente->rua = $request->rua;
				$emitente->numero = $request->numero;
				$emitente->bairro = $request->bairro;
				$emitente->cep = $request->cep;
				$emitente->telefone = $request->telefone;
				$emitente->complemento = $request->complemento ?? '';
				$emitente->ie_rg = $request->ie_rg;
				$emitente->cpf_cnpj = $request->cpf_cnpj;
				$emitente->numero_serie_nfe = $request->numero_serie_nfe;
				$emitente->cidade_id = $request->cidade_id;
				$emitente->ultimo_numero_nfe = $request->ultimo_numero_nfe;
				if($request->senha != ""){
					$emitente->senha = $request->senha;
				}
				$emitente->save();
				session()->flash('sucesso', 'Emitente atualizado!');
			}

		}catch(\Exception $e){
			session()->flash('erro', $e->getMessage());
		}
		return redirect()->back();
	}

	private function _validate(Request $request, $edit){
		$rules = [
			'razao_social' => 'required|max:50',
			'nome_fantasia' => 'required|max:50',
			'cpf_cnpj' => 'required',
			'ie_rg' => 'required',
			'cidade_id' => 'required',
			'rua' => 'required|max:80',
			'numero' => 'required|max:10',
			'bairro' => 'required|max:30',
			'cep' => 'required',
			'ambiente' => 'required',
			'ultimo_numero_nfe' => 'required',
			'numero_serie_nfe' => 'required',
			'senha' => $edit ? '' : 'required',
			'certificado' => $edit ? '' : 'required',
			'telefone' => 'required|min:12',
		];

		$messages = [
			'razao_social.required' => 'O campo nome é obrigatório.',
			'razao_social.max' => '50 caracteres maximos permitidos.',
			'nome_fantasia.required' => 'O campo nome é obrigatório.',
			'nome_fantasia.max' => '50 caracteres maximos permitidos.',
			'cpf_cnpj.required' => 'O campo CPF/CNPJ é obrigatório.',
			'ie_rg.required' => 'O campo IE/RG é obrigatório.',
			'cidade_id.required' => 'O campo cidade é obrigatório.',
			'rua.required' => 'O campo rua é obrigatório.',
			'rua.max' => 'Máximo de 80 caracteres.',
			'numero.required' => 'O campo número é obrigatório.',
			'numero.max' => 'Máximo de 10 caracteres.',
			'bairro.required' => 'O campo bairro é obrigatório.',
			'ambiente.required' => 'O campo ambiente é obrigatório.',
			'bairro.max' => 'Máximo de 10 caracteres.',
			'cep.required' => 'O campo cep é obrigatório.',
			'telefone.required' => 'O campo telefone/celular é obrigatório.',
			'telefone.max' => 'Minimo de 12 caracteres.',

			'ultimo_numero_nfe.required' => 'Campo obrigatório.',
			'numero_serie_nfe.required' => 'Campo obrigatório.',
			'senha.required' => 'Campo obrigatório.',
			'certificado.required' => 'Campo obrigatório.',

		];
		$this->validate($request, $rules, $messages);
	}
}
