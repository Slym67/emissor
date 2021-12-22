<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cidade;

class CidadeController extends Controller
{
    public function index(){
		$cidades = Cidade::
		orderBy('nome', 'desc')
		->get();
		$titulo = 'Cidades';
		return view('cidades/list', compact('titulo', 'cidades'));
	}

	public function new(){
		$titulo = 'Nova cidade';
		return view('cidades/form', compact('titulo'));
	}

	public function save(Request $request){
		$this->_validate($request);
		try{
			Cidade::create($request->all());
			session()->flash('sucesso', 'Cidade salva com sucesso!');

		}catch(\Exception $e){
			session()->flash('erro', $e->getMessage());

		}
		return redirect('/cidades');
	}

	public function update(Request $request){
		$this->_validate($request);
		try{
			$cidade = Cidade::find($request->id);
			$cidade->nome = $request->nome;
			$cidade->uf = $request->uf;
			$cidade->codigo = $request->codigo;
			$cidade->save();
			session()->flash('sucesso', 'Cidade editada com sucesso!');

		}catch(\Exception $e){
			session()->flash('erro', $e->getMessage());

		}
		return redirect('/cidades');
	}

	public function edit($id){
		try{
			$titulo = 'Editar cidade';
			$cidade = Cidade::find($id);
			return view('cidades/form', compact('titulo', 'cidade'));
		}catch(\Exception $e){
			session()->flash('erro', $e->getMessage());
			return redirect()->back();
		}
	}

	private function _validate(Request $request){
		$rules = [
			'nome' => 'required|max:50',
			'uf' => 'required',
			'codigo' => 'required|min:6',
		];

		$messages = [
			'nome.required' => 'O campo nome é obrigatório.',
			'nome.max' => '50 caracteres maximos permitidos.',
			'uf.required' => 'O campo UF é obrigatório.',
			'codigo.required' => 'O campo código é obrigatório.',
			'min.required' => 'Informe no minímo 6 caracteres.',

		];
		$this->validate($request, $rules, $messages);
	}

	public function delete($id){
		try{
			Cidade::find($id)->delete();
			session()->flash('sucesso', 'Cidade removida com sucesso!');
			return redirect('/cidades');
		}catch(\Exception $e){
			session()->flash('erro', $e->getMessage());
			return redirect()->back();
		}
	}
}
