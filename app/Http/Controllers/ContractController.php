<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Contract;

class ContractController extends Controller
{
    public function index()
    {
        $companies = Company::orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');
        $contracts = Contract::orderBy('first_name', 'asc')->where(function ($query) {
            if ($companyId = request('company_id')) {
                $query->where('company_id', $companyId);
            }
        })->paginate(5);
        return view('contracts.index', compact('contracts', 'companies'));
    }

    public function create()
    {
        return view('contracts.create');
    }

    public function show($id)
    {
        $contract = Contract::find($id);
        return view('contracts.show', compact('contract'));
    }
}
