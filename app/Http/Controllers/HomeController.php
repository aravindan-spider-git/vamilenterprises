<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\Customer;
use App\Models\Company;
use App\Models\Vehicle;
use App\Models\Document;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
{
    $user = Auth::user();
    $totalCompanies = Company::count();
    $totalVechile = Vehicle::count();
    $totalDocument = Document::count();

    return view('dashboard', compact('user', 'totalCompanies', 'totalVechile', 'totalDocument'));
}

}
