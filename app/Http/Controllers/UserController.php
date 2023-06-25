<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Auth;

class UserController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $this->validate($request, [
                'first_name' => ['required', 'string'],
                'last_name' => ['required', 'string'],
                'cpf' => ['required', 'string'],
                'email'  => ['required', 'string'],
                'password'  => ['required', 'string']
            ]);

            $validated['password'] = bcrypt($validated['password']);
            User::create($validated);
            return response()->noContent();
            
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                // Código de erro 1062 indica uma violação de chave única

                // Extrair o email duplicado da mensagem de erro
                $errorMessage = $e->getMessage();
                preg_match("/Duplicate entry '(.+)' for key/", $errorMessage, $matches);
                $emailDuplicado = $matches[1];

                // Retornar o email duplicado
                return response()->json(['message' => 'Email já cadastrado', 'email' => $emailDuplicado], 400);
            }

            // Se não for um erro de chave única, você pode tratar de outra forma ou lançar a exceção novamente
            throw $e;
        }
    }
}
