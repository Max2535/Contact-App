<?php

namespace App\Http\Controllers;

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
        $user = auth()->user();
        $companies = $user->companies()->orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');
        //DB::enableQueryLog();
        $contracts = $user->contract()->latestFirst()->paginate(10);
        //dd(DB::getQueryLog());
        return view('contracts.index', compact('contracts', 'companies'));
    }

    public function create()
    {
        $user = auth()->user();
        $contract = new Contract();
        $companies =  $user->companies()->orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');
        return view('contracts.create', compact('companies', 'contract'));
    }

    public function edit($id)
    {
        $user = auth()->user();
        $contract = Contract::findOrFail($id);
        $companies = $user->companies()->orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');
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

        $request->user()->contracts->create($request->all());

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
