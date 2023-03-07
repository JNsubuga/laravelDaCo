<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::latest()->filter(request(['search']))->paginate();
        return view('accounts.index', ['accounts' => $accounts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'Name' => 'required',
            'year' => 'required',
            'Code' => 'required',
            'AnualPrinciple' => 'required'
        ]);

        Account::create($formFields);

        return redirect(route('account.index'))->with('success', 'account created successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $toDetail = Account::where('accounts.id', $id)
            ->leftJoin('transactions', 'accounts.id', '=', 'transactions.account_id')
            ->join('members', 'members.id', '=', 'transactions.member_id')
            ->selectRaw('accounts.id, accounts.Name, accounts.year, accounts.Code, accounts.AnualPrinciple, members.id as member_id, members.Names as member, members.Code as member_Code, SUM(transactions.Dr) as totalAmountPaid')
            ->groupBy(['accounts.id', 'accounts.Name', 'members.id'])
            ->orderBy('member_id', 'ASC')
            ->get();

        return view('accounts.show', ['toDetail' => $toDetail]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $toUpdate = Account::where('id', $id)->first();
        return view('accounts.edit', ['toUpdate' => $toUpdate]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $formFields = $request->validate([
            'Name' => 'required',
            'year' => 'required',
            'Code' => 'required',
            'AnualPrinciple' => 'required'
        ]);

        Account::where('id', $id)->update($formFields);

        return redirect(route('account.index'))->with('success', 'Account Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Account::destroy($id);
        return redirect(route('account.index'))->with('success', 'Account Deleted Successfully!!');
    }
}
