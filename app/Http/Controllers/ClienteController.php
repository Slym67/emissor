<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Cidade;

class ClienteController extends Controller
{
	public function index(){
		$clientes = Cliente::
		orderBy('nome', 'desc')
		->get();
		$titulo = 'Clientes';
		return view('clientes/list', compact('titulo', 'clientes'));
	}

	public function new(){
		$titulo = 'Novo cliente';

		$cidades = Cidade::
		orderBy('nome', 'desc')
		->get();
		if(sizeof($cidades) == 0){
			session()->flash('erro', 'Cadastre ao menos uma cidade');
			return redirect('cidades');
		}
		return view('clientes/form', compact('titulo', 'cidades'));
	}

	public function save(Request $request){
		$this->_validate($request);
		try{
			$request->merge(['complemento' => $request->complemento ?? '']);
			$request->merge(['contribuinte' => $request->contribuinte ? 1 : 0]);
			Cliente::create($request->all());
			session()->flash('sucesso', 'Cliente salvo com sucesso!');

		}catch(\Exception $e){
			session()->flash('erro', $e->getMessage());

		}
		return redirect('/clientes');
	}

	public function update(Request $request){
		$this->_validate($request);
		try{
			$cidade = Cliente::find($request->id);
			$cidade->nome = $request->nome;
			$cidade->rua = $request->rua;
			$cidade->numero = $request->numero;
			$cidade->bairro = $request->bairro;
			$cidade->cep = $request->cep;
			$cidade->cidade_id = $request->cidade_id;
			$cidade->cpf_cnpj = $request->cpf_cnpj;
			$cidade->ie_rg = $request->ie_rg;
			$cidade->complemento = $request->complemento ?? '';
			$cidade->contribuinte = $request->contribuinte ? 1 : 0;
			$cidade->save();
			session()->flash('sucesso', 'Cliente editado com sucesso!');

		}catch(\Exception $e){
			session()->flash('erro', $e->getMessage());

		}
		return redirect('/clientes');
	}

	public function edit($id){
		try{
			$titulo = 'Editar cliente';
			$cliente = Cliente::find($id);
			$cidades = Cidade::
			orderBy('nome', 'desc')
			->get();
			return view('clientes/form', compact('titulo', 'cliente', 'cidades'));
		}catch(\Exception $e){
			session()->flash('erro', $e->getMessage());
			return redirect()->back();
		}
	}

	private function _validate(Request $request){
		$rules = [
			'nome' => 'required|max:50',
			'cpf_cnpj' => 'required',
			'ie_rg' => 'required',
			'cidade_id' => 'required',
			'rua' => 'required|max:80',
			'numero' => 'required|max:10',
			'bairro' => 'required|max:30',
			'cep' => 'required',
			'telefone' => 'required|min:12',
		];

		$messages = [
			'nome.required' => 'O campo nome é obrigatório.',
			'nome.max' => '50 caracteres maximos permitidos.',
			'cpf_cnpj.required' => 'O campo CPF/CNPJ é obrigatório.',
			'ie_rg.required' => 'O campo IE/RG é obrigatório.',
			'cidade_id.required' => 'O campo cidade é obrigatório.',
			'rua.required' => 'O campo rua é obrigatório.',
			'rua.max' => 'Máximo de 80 caracteres.',
			'numero.required' => 'O campo número é obrigatório.',
			'numero.max' => 'Máximo de 10 caracteres.',
			'bairro.required' => 'O campo bairro é obrigatório.',
			'bairro.max' => 'Máximo de 10 caracteres.',
			'cep.required' => 'O campo cep é obrigatório.',
			'telefone.required' => 'O campo telefone/celular é obrigatório.',
			'telefone.max' => 'Minimo de 12 caracteres.',

		];
		$this->validate($request, $rules, $messages);
	}

	public function delete($id){
		try{
			Cliente::find($id)->delete();
			session()->flash('sucesso', 'Cliente removida com sucesso!');
			return redirect('/clientes');
		}catch(\Exception $e){
			session()->flash('erro', $e->getMessage());
			return redirect()->back();
		}
	}
}
