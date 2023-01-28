<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Contract;

class ContractController extends Controller
{
    public function index()
    {
        $companies = Company::orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');
        //DB::enableQueryLog();
        $contracts = Contract::latestFirst()->paginate(10);
        //dd(DB::getQueryLog());
        return view('contracts.index', compact('contracts', 'companies'));
    }

    public function create()
    {
        $contract = new Contract();
        $companies = Company::orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');
        return view('contracts.create', compact('companies', 'contract'));
    }

    public function edit($id)
    {
        $contract = Contract::findOrFail($id);
        $companies = Company::orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');
        return view('contracts.edit', compact('companies', 'contract'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'company_id' => 'required|exists:companies,id',
        ]);

        Contract::create($request->all());

        return redirect()->route('contracts.index')->with('message', 'Contract has been added successfully');
    }

    public function update($id, Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'company_id' => 'required|exists:companies,id',
        ]);

        $contract = Contract::findOrFail($id);
        $contract->update($request->all());

        return redirect()->route('contracts.index')->with('message', 'Contract has been updated successfully');
    }

    public function show($id)
    {
        $contract = Contract::find($id);
        return view('contracts.show', compact('contract'));
    }

    public function destroy($id)
    {
        $contract = Contract::findOrFail($id);
        $contract->delete();
        return back()->with('message', 'Contract has been deleted successfully');
    }
}
