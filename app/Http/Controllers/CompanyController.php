<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Company::create($request->only('name'));
        return redirect()->route('companies.index')->with('success', 'Company created.');
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate(['name' => 'required']);
        $company->update($request->only('name'));
        return redirect()->route('companies.index')->with('success', 'Company updated.');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted.');
    }

}
