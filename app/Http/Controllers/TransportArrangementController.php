<?php

namespace App\Http\Controllers;

use App\Models\TransportArrangement;
use Illuminate\Http\Request;

class TransportArrangementController extends Controller
{
    public function index()
    {
        return TransportArrangement::all();
    }

    public function store(Request $request)
    {
        $transportArrangement = TransportArrangement::create($request->all());
        return response()->json($transportArrangement, 201);
    }

    public function show(TransportArrangement $transportArrangement)
    {
        return $transportArrangement;
    }

    public function update(Request $request, TransportArrangement $transportArrangement)
    {
        $transportArrangement->update($request->all());
        return response()->json($transportArrangement, 200);
    }

    public function destroy(TransportArrangement $transportArrangement)
    {
        $transportArrangement->delete();
        return response()->json(null, 204);
    }
}
