<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\CompanyCategory; // Add CompanyCategory model

class CompanyController extends Controller
{
    public function index()
    {
        $categories = CompanyCategory::all(); // Get all categories

        $companies = Company::with('category')->get(); // eager load category
        return view('companies.index', compact('companies','categories'));
    }

    public function create()
    {
        $categories = CompanyCategory::all(); // Get all categories
        return view('companies.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:company_categories,id', // Validate category
        ]);

        Company::create($request->only('name', 'category_id')); // Store category_id
        return redirect()->route('companies.index')->with('success', 'Company created.');
    }

    public function edit(Company $company)
    {
        $categories = CompanyCategory::all(); // Get all categories
        return view('companies.edit', compact('company', 'categories'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:company_categories,id', // Validate category
        ]);

        $company->update($request->only('name', 'category_id')); // Update category_id
        return redirect()->route('companies.index')->with('success', 'Company updated.');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted.');
    }
}
