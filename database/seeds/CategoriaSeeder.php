<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategoriaSedeer extends Seeder
{
        public function run(){
            DB::table('categoria')->insert([
                ['nome' => 'Notebook'],
                ['nome' => 'Celular'],
                ['nome' => 'Tablet'],
                ['nome' => 'Câmera'],
            ]);
           
        }
}