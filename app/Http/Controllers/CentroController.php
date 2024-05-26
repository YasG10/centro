<?php

namespace App\Http\Controllers;

use App\Models\Centro;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class CentroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $centro['centros'] = Centro::paginate(3);
        return view('centros.index', $centro);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('centros.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $campos = [
            'Nombre' => 'required|string|max:100',
            'Director' => 'required|string|max:100',
            'Descripcion' => 'required|string|max:100000000',
            'Foto' => 'required|max:10000|mimes:jpeg,png,jpg'
        ];
        $mensaje = [
            'required' => 'El :attribute es requerido',
            'Foto.required' => 'La foto es requerida'
        ];

        $this->validate($request, $campos, $mensaje);

        $datosCentros = request()->except('_token');

        if ($request->hasFile("Foto")) {
            $datosCentros['Foto'] = $request->file('Foto')->store('uploads', 'public');
        }

        Centro::insert($datosCentros);
        return redirect('centros')->with('mensaje', 'Centro agregado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Centro $centro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $centro = Centro::findOrFail($id);
        return view('centros.edit', compact('centro'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $campos = [
            'Nombre' => 'required|string|max:100',
            'Director' => 'required|string|max:100',
            'Descripcion' => 'required|string|max:100000000'

        ];
        $mensaje = [
            'required' => 'El :attribute es requerido'
        ];

        if ($request->hasFile('Foto')) {
            $campos = ['Foto' => 'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje = ['Foto.required' => 'La foto es requerida'];
        }

        $this->validate($request, $campos, $mensaje);

        $datosCentros = request()->except(['_token', '_method']);

        if ($request->hasFile('Foto')) {

            $centro = Centro::findOrFail($id);
            Storage::delete('/public' . $centro->Foto);
            $datosCentros['Foto'] = $request->file('Foto')->store('uploads', 'public');
        }



        Centro::where('id', '=', $id)->update($datosCentros);

        $centro = Centro::findOrFail($id);
        //return view('centros.edit', compact('centro'));
        return redirect('centros')->with('mensaje', 'Centro Actualizado');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $centro = Centro::findOrFail($id);

        if (Storage::delete('public/' . $centro->Foto)) {
            Centro::destroy($id);

        }


        return redirect('centros')->with('mensaje', 'Centro borrado');
    }
}
