<?php

use App\Categoria;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
            Categoria::create(['nome' => 'Notebook']);
            Categoria::create(['nome' => 'Celular']);
            Categoria::create(['nome' => 'Tablet']);
            Categoria::create(['nome' => 'Câmera']);
        
            
           
        
    }
}
