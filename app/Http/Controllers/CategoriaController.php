<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
	public function index(){
		$categorias = Categoria::
		orderBy('nome', 'desc')
		->get();
		$titulo = 'Categorias';
		return view('categorias/list', compact('titulo', 'categorias'));
	}

	public function new(){
		$titulo = 'Nova categoria';
		return view('categorias/form', compact('titulo'));
	}

	public function save(Request $request){
		$this->_validate($request);
		try{
			Categoria::create($request->all());
			session()->flash('sucesso', 'Categoria salva com sucesso!');

		}catch(\Exception $e){
			session()->flash('erro', $e->getMessage());

		}
		return redirect('/categorias');
	}

	public function update(Request $request){
		$this->_validate($request);
		try{
			$categoria = Categoria::find($request->id);
			$categoria->nome = $request->nome;
			$categoria->save();
			session()->flash('sucesso', 'Categoria editada com sucesso!');

		}catch(\Exception $e){
			session()->flash('erro', $e->getMessage());

		}
		return redirect('/categorias');
	}

	public function edit($id){
		try{
			$titulo = 'Editar categoria';
			$categoria = Categoria::find($id);
			return view('categorias/form', compact('titulo', 'categoria'));
		}catch(\Exception $e){
			session()->flash('erro', $e->getMessage());
			return redirect()->back();
		}
	}

	private function _validate(Request $request){
		$rules = [
			'nome' => 'required|max:50'
		];

		$messages = [
			'nome.required' => 'O campo nome é obrigatório.',
			'nome.max' => '50 caracteres maximos permitidos.'
		];
		$this->validate($request, $rules, $messages);
	}

	public function delete($id){
		try{
			Categoria::find($id)->delete();
			session()->flash('sucesso', 'Categoria removida com sucesso!');
			return redirect('/categorias');
		}catch(\Exception $e){
			session()->flash('erro', $e->getMessage());
			return redirect()->back();
		}
	}
}
