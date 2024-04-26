<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // visualizar perfil
    public function index()
    {
       return view('admin/profile/index');
    }

    //atualiza o perfil
    public function update(Request $request)
    {
         //dd($request->all());
         $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,' . Auth::user()->id],
         ]);

         $user = Auth::user();
         $user->name = $request->name;
         $user->email = $request->email;
         $user->save();

         return redirect()->back()->with('success', 'Dados atualizados com sucesso!');
    }
}
