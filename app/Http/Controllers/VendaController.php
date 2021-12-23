<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Cliente;
use App\Models\Venda;
use App\Models\ItemVenda;
use App\Models\FaturaVenda;

class VendaController extends Controller
{
    public function index(){
    	$titulo = 'Vendas';
    	$vendas = Venda::
    	orderBy('id', 'desc')
    	->get();
    	return view('vendas/list', compact('titulo', 'vendas'));
    }

    public function new(){

        try{
            $clientes = Cliente::
            orderBy('nome', 'desc')
            ->get();

            $produtos = Produto::
            orderBy('nome', 'desc')
            ->get();

            if(sizeof($clientes) == 0){
                session()->flash('erro', 'Cadastre ao menos um cliente');
                return redirect('clientes');
            }

            if(sizeof($produtos) == 0){
                session()->flash('erro', 'Cadastre ao menos um produto');
                return redirect('produtos');
            }
            $titulo = 'Nova venda';
            return view('vendas/form', compact('titulo', 'clientes', 'produtos'));
        }catch(\Exception $e){
            session()->flash('erro', $e->getMessage());
            return redirect()->back();
        }

    }

    public function save(Request $request){
        try{
            $venda = $request->venda;
            $result = Venda::create([
                'valor' => $venda['total'],
                'cliente_id' => $venda['cliente_id'],
                'chave' => '',
                'numero_nfe' => 0,
                'estado' => 'Novo'
            ]);

            foreach($venda['itens'] as $i){
                ItemVenda::create([
                    'valor' => str_replace(",", ".", $i['valor']),
                    'quantidade' => $i['quantidade'],
                    'venda_id' => $result->id,
                    'produto_id' => $i['id']
                ]);
            }

            foreach($venda['fatura'] as $f){
                FaturaVenda::create([
                    'valor' => str_replace(",", ".", $f['valor']),
                    'venda_id' => $result->id,
                    'vencimento' => \Carbon\Carbon::parse(str_replace("/", "-", $f['data']))
                    ->format('Y-m-d'),
                    'forma_pagamento' => $f['forma_pagamento']
                ]);
            }
            return response()->json($venda, 200);

        }catch(\Exception $e){
            return response()->json($e->getMessage(), 404);
        }
    }

    public function show($id){
        try{
            $venda = Venda::find($id);

            $titulo = 'Visualizando venda';
            return view('vendas/show', compact('titulo', 'venda'));
        }catch(\Exception $e){
            session()->flash('erro', $e->getMessage());
            return redirect()->back();
        }
    }
}
