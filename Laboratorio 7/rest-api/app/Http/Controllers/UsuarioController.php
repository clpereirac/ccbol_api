<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    // método para obtener todos los usuarios
    public function index()
    {
        $usuarios = Usuario::all();
        return response()->json(['usuarios' => $usuarios], 200);
    }

    // método para crear un nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|max:30',
            'apellidos' => 'required|max:30',
            'correo_electronico' => 'required|email|unique:usuarios',
            'password' => 'required',
            'rol' => 'required|max:30'
        ]);

        $usuario = Usuario::create($request->all());
        return response()->json(['usuario' => $usuario], 201);
    }

    // método para obtener un usuario por su ID
    public function show($id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        return response()->json(['usuario' => $usuario], 200);
    }

    // método para actualizar un usuario por su ID
    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        
        $request->validate([
            'nombres' => 'max:30',
            'apellidos' => 'max:30',
            'correo_electronico' => 'email|unique:usuarios',
            'password' => '',
            'rol' => 'max:30'
        ]);

        $usuario->update($request->all());
        return response()->json(['usuario' => $usuario], 200);
    }

    // método para eliminar un usuario por su ID
    public function destroy($id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        
        $usuario->delete();
        return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
    }
}
