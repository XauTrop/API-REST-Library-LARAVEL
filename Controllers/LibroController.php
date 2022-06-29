<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LibroController extends Controller
{
    public function index(Request $request) {
        try {
        $libro = Libro::all();
        return response()->json($libro, 200);
        } catch (QueryException $e) {
            throw new Exception ($e->errorInfo[2], $e->errorInfo[1]);
        } catch (Exception $e) {
           return response()->json(['msg'=> $e->getMessage(), 'code' => $e->getCode()]);
        }



    }

    public function show($id) {
        try {
            $libro = Libro::find($id);
            if(!$libro) {
                return response()->json($libro, 404);
            }
            return response()->json($libro, 201);
            } catch (QueryException $e) {
                throw new Exception ($e->errorInfo[2], $e->errorInfo[1]);
            } catch (Exception $e) {
                return response()->json(['msg'=> $e->getMessage(), 'code' => $e->getCode()]);
            }
    

    }

    public function store(Request $request) {
        $rules =[
            'titulo' => 'required',
            'precio' => 'required',
        ];
            $validator =  Validator::make($request->all(), $rules); 
    
            if ($validator->fails()) {
                return response()->json(['petición incompleta'], 400);
            }
    
            try {
                $libro = Libro::create($request->all());
    
                return response()->json($libro, 201);
            } catch (Exception $e) {
                return response()->json(['error interno'], 500);
            }
    
    }

//modificación de un recurso
    public function update(Request $request, Libro $libro)
    {

    $validator =  Validator::make($request->all(), [
        'titulo' => 'required',
        'precio' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['petición incompleta'], 400);
    }

    try {

        if ($libro->update($request->all())) return response()->json($libro, 200);

        return response()->json(['recurso no existe'], 404);
    } catch (\Exception $e) {

        return response()->json(['error interno'], 500);
    }
    }

    public function delete($id) {
        try {
            $libro = Libro::destroy($id);
            return response()->json($libro, 200);
            } catch (Exception $e) {
                return response()->json(['msg'=> $e->getMessage(), 'code' => $e->getCode()]);
            }
    }
}
