<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\DocumentCategory;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with('category')->get();
        $categories = DocumentCategory::all();

        return view('documents.index', compact('documents', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:document_categories,id',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('file')->store('documents', 'public');

        Document::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $path,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('documents.index')->with('success', 'Document created successfully.');
    }

    public function update(Request $request, Document $document)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:document_categories,id',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('title', 'description', 'category_id');

        if ($request->hasFile('file')) {
            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }

            $data['file_path'] = $request->file('file')->store('documents', 'public');
        }

        $document->update($data);

        return redirect()->route('documents.index')->with('success', 'Document updated successfully.');
    }

    public function destroy(Document $document)
    {
        if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return redirect()->route('documents.index')->with('success', 'Document deleted successfully.');
    }
}

