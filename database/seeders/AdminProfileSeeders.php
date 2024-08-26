<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendedor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminProfileSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $usuario = User::where('email', 'cursos@maykonsilveira.com.br')->first();

       $vendedor = new Vendedor();
       $vendedor->banner = 'uploads/capa-loja-msflix.jpg';
       $vendedor->fone = '(41)7 7777-7777';
       $vendedor->email = 'cursos@maykonsilveira.com.br';
       $vendedor->endereco = 'Rua Jesus Te Ama 777';
       $vendedor->descricao = 'Aqui descrição';
       $vendedor->id_usuario = $usuario->id;
       $vendedor->save();
    }
}
