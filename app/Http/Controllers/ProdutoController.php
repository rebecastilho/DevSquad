<?php

namespace App\Http\Controllers;

use App\{Produto,Categoria};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Resources\ProdutoCollection;

class ProdutoController extends Controller
{
    public function index()
    {
      return new ProdutoCollection(Produto::orderBy('nome','asc')->paginate(2));
    }

    public function store(Request $request)
    {
    
        $dados = [
            'nome' => $request->get('nome'),
            'categoria_id' => $request->get('categoria_id'),
            'descricao' => $request->get('descricao'),
            'preco' => $request->get('preco')
         ];

         if($request->hasFile('imagem')){
            $dados['imagem'] = $request->file('imagem')->store('public/img');
         }
         else{
           $dados['imagem'] = "default.jpg";
         }
          $produto = Produto::create($dados);
          $produto->save();
        return response()->json('success');
    }

    public function show($id)
    {
      $data = [
        'categorias' => Categoria::all(),
        'produto' => Produto::findorFail($id),
        'url' => asset('/'),
        'categoria_atual' => Produto::findOrFail($id)->categoria->nome
      ];
      return response()->json($data);
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

    public function buscar($pesquisa){
      if($pesquisa == ""){
        return new ProdutoCollection((Produto::orderBy('nome','asc')->paginate(1)));  
      }
      $pesquisa = "%" . $pesquisa . "%";
      return new ProdutoCollection((Produto::where('nome','like', $pesquisa)->paginate(1)));
    }

    public function categorias(){
      return response()->json(Categoria::all());
    }

}
