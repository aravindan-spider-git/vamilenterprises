<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyCategory;

class CompanyCategoryController extends Controller
{
    public function index()
    {
        $categories = CompanyCategory::all();
        return view('companies.categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:company_categories,name',
        ]);

        CompanyCategory::create($request->only('name'));

        return redirect()->route('company-categories.index')->with('success', 'Category created.');
    }

    public function edit($id)
    {
        $editCategory = CompanyCategory::findOrFail($id);
        $categories = CompanyCategory::all();

        return view('company_categories.index', compact('categories', 'editCategory'));
    }

    public function update(Request $request, $id)
    {
        $category = CompanyCategory::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:company_categories,name,' . $id,
        ]);

        $category->update($request->only('name'));

        return redirect()->route('company-categories.index')->with('success', 'Category updated.');
    }

    public function destroy($id)
    {
        CompanyCategory::findOrFail($id)->delete();

        return redirect()->route('company-categories.index')->with('success', 'Category deleted.');
    }
}
