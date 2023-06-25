<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServicePlatform;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ServicePlatformController extends Controller
{
    public function show($id){
        try {
            // Encontrar o ServicePlatform pelo ID
            $servicePlatform = ServicePlatform::findOrFail($id);

            // Retornar o ServicePlatform encontrado
            return response()->json($servicePlatform);
        } catch (ModelNotFoundException $e) {
            // Caso o registro não seja encontrado, retornar uma resposta informando que não foi encontrado
            return response()->json(['message' => 'Registro não encontrado'], 404);
        }
    }

    public function index()
    {
        $servicePlatforms = ServicePlatform::all();
        return response()->json($servicePlatforms);

    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'acronym' => ['required', 'string'],
            'status' => ['required', 'string'],
        ]);

        $servicePlatform = ServicePlatform::create($validated);
        return response()->json($servicePlatform, 201);
    }


    public function update(Request $request, $id)
    {
        // Obter o recurso existente
        $servicePlatform = ServicePlatform::findOrFail($id);

        // Verificar os campos enviados na requisição e atualizar apenas os campos desejados
        if ($request->has('name')) {
            $servicePlatform->name = $request->input('name');
        }

        if ($request->has('description')) {
            $servicePlatform->description = $request->input('description');
        }

        if ($request->has('acronym')) {
            $servicePlatform->acronym = $request->input('acronym');
        }

        if ($request->has('status')) {
            $servicePlatform->status = $request->input('status');
        }

        // Salvar as alterações
        $servicePlatform->save();

        // Retornar o recurso atualizado como resposta
        return response()->json($servicePlatform);
    }
    

    public function delete(Request $request, $id){
        // Encontrar o ServicePlatform pelo ID
        $servicePlatform = ServicePlatform::findOrFail($id);

        // Excluir o ServicePlatform
        $servicePlatform->delete();

        // Retornar uma resposta adequada
        return response()->json(['message' => 'Excluído com sucesso']);
    }
}
