<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ListModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModelController extends Controller
{
    //get data

    public function index()
    {
        $data = ListModel::all();

        try {
            return response()->json([
                'message' => 'success get data',
                'data' => $data,
                'code' => 200
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'failed get data',
                'code' => 402
            ]);
        }

       
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'tanggal' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'check your validated',
                'code' => 402
            ]);
        }

        $validated = $validator->validated();


        try {
            $data = new ListModel;
            $data->tanggal = $validated['tanggal'];
            $data->judul = $validated['judul'];
            $data->deskripsi = $validated['deskripsi'];
            $data->save();
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'check your input',
                'errors' => $th->getMessage(),
                'code' => 402,
            ]);
        }

        return response()->json([
            'message' => 'success create data',
            'data' => [
                'id' => $data->id,
                'data' => $data,
                'code' => 200
            ]
            ]);
    }
}
