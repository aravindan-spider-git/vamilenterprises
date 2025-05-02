<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\CompanyCategory;

class CompanyCategoryController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        $categories = CompanyCategory::with('company')->get();
        $companyId = auth()->user()->company_id ?? 1; // adjust as needed
        return view('companies.categories', compact('categories', 'companyId','companies'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:company_categories,name',
            'company_id' => 'required|exists:companies,id',
        ]);
    
        CompanyCategory::create($request->only('name', 'company_id'));
    
        return redirect()->route('company-categories.index')->with('success', 'Category created.');
    }
    
    public function edit($id)
    {
        $editCategory = CompanyCategory::findOrFail($id);
        $categories = CompanyCategory::with('company')->get();
        $companyId = auth()->user()->company_id ?? 1;
    
        return view('company_categories.index', compact('categories', 'editCategory', 'companyId'));
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
