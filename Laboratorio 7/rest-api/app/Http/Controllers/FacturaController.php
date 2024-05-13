<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;

class FacturaController extends Controller
{
    //  para obtener todas las facturas
    public function index()
    {
        $facturas = Factura::all();
        return response()->json(['facturas' => $facturas], 200);
    }

    // para crear una nueva factura
    public function store(Request $request)
    {
        $request->validate([
            'nro' => 'required|max:30',
            'fecha' => 'required|date',
            'cuf' => 'required|max:30',
            'cufd' => 'required|max:30',
            'monto_total' => 'required|numeric'
        ]);

        $factura = Factura::create($request->all());
        return response()->json(['factura' => $factura], 201);
    }

    //  para obtener una factura por su ID
    public function show($id)
    {
        $factura = Factura::find($id);
        if (!$factura) {
            return response()->json(['message' => 'Factura no encontrada'], 404);
        }
        return response()->json(['factura' => $factura], 200);
    }

    //  para actualizar una factura por su ID
    public function update(Request $request, $id)
    {
        $factura = Factura::find($id);
        if (!$factura) {
            return response()->json(['message' => 'Factura no encontrada'], 404);
        }
        
        $request->validate([
            'nro' => 'max:30',
            'fecha' => 'date',
            'cuf' => 'max:30',
            'cufd' => 'max:30',
            'monto_total' => 'numeric'
        ]);

        $factura->update($request->all());
        return response()->json(['factura' => $factura], 200);
    }

    //  para eliminar una factura por su ID
    public function destroy($id)
    {
        $factura = Factura::find($id);
        if (!$factura) {
            return response()->json(['message' => 'Factura no encontrada'], 404);
        }
        
        $factura->delete();
        return response()->json(['message' => 'Factura eliminada correctamente'], 200);
    }
}
