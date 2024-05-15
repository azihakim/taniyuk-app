<?php

namespace App\Http\Controllers;

use App\Models\Test;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Test();
        $data->berat_basah = $request->berat_basah;
        $data->drc = $request->drc;
        $data->save();
        
        return response()->json([
                'message' => 'Data berhasil disimpan',
                'data' => [
                    'id' => $data->id,
                    'berat_basah' => $data->berat_basah,
                    'drc' => $data->drc,
                ]
            ], 200);
            
    }

    /**
     * Display the specified resource.
     */
    public function show(Test $test)
    {
        $data=Test::all();
        return response()->json([
            'message' => 'Ok', 
            'data' => [
                'id' => $data->id,
                'berat_basah' => $data->berat_basah,
                'drc' => $data->drc,
                'berat_kering' => $data->berat_basah * $data->drc / 100,
            ]
        ]);
    }


    public function update(Request $request, $id)
    {
        $data = Test::find($id);

        $data-> berat_basah = $request->berat_basah;
        $data-> drc = $request->drc;

        $data->save();

        return response()->json(['message' => 'Update berhasil', 'data' => $data]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Test::find($id);

        if ($data) {
            $data->delete();
            return response()->json([
                'message' => 'Data berhasil dihapus',
                'data' => [
                    'id' => $data->id,
                    'berat_basah' => $data->berat_basah,
                    'drc' => $data->drc,
                ]
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }
}
