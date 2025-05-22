<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DocumentController extends Controller
{
    public function index()
    {
        return Document::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'case_id' => 'required|exists:cases,id',
            'type' => ['required', Rule::in(Document::TYPES)],
            'file_path' => 'required|string|max:2048',
            'status' => ['required', Rule::in(Document::STATUSES)],
        ]);

        $document = Document::create($request->all());
        return response()->json($document, 201);
    }

    public function show(Document $document)
    {
        return $document;
    }

    public function update(Request $request, Document $document)
    {
        $request->validate([
            'type' => Rule::in(Document::TYPES),
            'status' => Rule::in(Document::STATUSES),
        ]);

        $document->update($request->all());
        return response()->json($document, 200);
    }

    public function destroy(Document $document)
    {
        $document->delete();
        return response()->json(null, 204);
    }
}
