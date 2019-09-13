<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Produto extends Model
{
    Use SoftDeletes;
    public $timestamps = false;
    
    protected $table = 'produto';
    protected $fillable = ['nome', 'descricao', 'categoria_id', 'preco','imagem'];
    
    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }
}