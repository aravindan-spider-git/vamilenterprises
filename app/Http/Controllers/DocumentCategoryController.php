<?php

namespace App\Http\Controllers;

use App\Models\DocumentCategory;
use Illuminate\Http\Request;

class DocumentCategoryController extends Controller
{
    public function index()
    {
        $categories = DocumentCategory::all();
        return view('documents.categories', compact('categories'));
    }

    public function create()
    {
        $categories = DocumentCategory::all();
        return view('documents.categories');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:document_categories,name',
        ]);

        DocumentCategory::create([
            'name' => $request->name,
        ]);

        return redirect()->route('document-categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(DocumentCategory $documentCategory)
    {
        return view('documents.categories', compact('documentCategory'));
    }

    public function update(Request $request, DocumentCategory $documentCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:document_categories,name,' . $documentCategory->id,
        ]);

        $documentCategory->update([
            'name' => $request->name,
        ]);

        return redirect()->route('document-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(DocumentCategory $documentCategory)
    {
        $documentCategory->delete();
        return redirect()->route('document-categories.index')->with('success', 'Category deleted successfully.');
    }
}
