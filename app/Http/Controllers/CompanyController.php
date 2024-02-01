<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::latest()->paginate(6);
        return view('admin.companies.index', ["companies" => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.companies.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        Company::create($request->validated());
        return redirect()->route("companies.index", [], 201)->with('success', "Company created successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view("admin.companies.show", compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company->update($request->validated());
        return redirect()->route("companies.index")->with('success', "Company updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->back()->with("success", "Company has deleted successfully");
    }
}
