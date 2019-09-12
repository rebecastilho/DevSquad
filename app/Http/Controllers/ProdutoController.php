<?php

namespace App\Http\Controllers;

use App\{Produto,Categoria};
use Illuminate\Http\Request;
use App\Http\Resources\ProdutoCollection;

class ProdutoController extends Controller
{
    public function index()
    {
      return new ProdutoCollection(Produto::orderBy('nome','asc')->get());
    }

    public function store(Request $request)
    {
          $produto = new Produto([
            'nome' => $request->get('nome'),
            'categoria_id' => $request->get('categoria_id'),
            'preco' => $request->get('preco'),
            'descricao' => $request->get('descricao')
          ]);
          $produto->save();
          return response()->json('sucesso');
    }

    public function show($id)
    {
      $produto = Produto::findorFail($id);
      return response()->json($produto);
    }

    public function update(Request $request,$id){
        $produto = Produto::findOrFail($id);
        $produto->update($request->all());   
        return response()->json('sucesso');
    }

    public function delete($id)
    {
      $produto = Produto::findOrFail($id);
      $produto->delete();

      return response()->json('sucesso');
    }
}
