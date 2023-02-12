<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Contract;

class ContractController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware(['auth', 'verified']);
        //$this->middleware('auth')->only('create', 'update', 'destroy');
        //$this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
        $companies = Company::userCompanies();
        //DB::enableQueryLog();
        $contracts = auth()->user()->contract()->latestFirst()->paginate(10);
        //dd(DB::getQueryLog());
        return view('contracts.index', compact('contracts', 'companies'));
    }

    public function create()
    {
        $contract = new Contract();
        $companies = Company::userCompanies();
        return view('contracts.create', compact('companies', 'contract'));
    }



    public function edit(Contract $contract)
    {
        $companies = Company::userCompanies();
        return view('contracts.edit', compact('companies', 'contract'));
    }

    public function store(ContactRequest $request)
    {

        $request->user()->contracts->create($request->all());

        return redirect()->route('contracts.index')->with('message', 'Contract has been added successfully');
    }


    public function update(Contract $contract, ContactRequest $request)
    {
        $contract->update($request->all());
        return redirect()->route('contracts.index')->with('message', 'Contract has been updated successfully');
    }

    public function show(Contract $contract)
    {
        return view('contracts.show', compact('contract'));
    }

    public function destroy(Contract $contract)
    {
        $contract->delete();
        return redirect()->route('contracts.index')->with('message', 'Contract has been deleted successfully');
    }
}
