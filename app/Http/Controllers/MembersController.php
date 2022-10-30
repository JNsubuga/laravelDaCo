<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::orderBy('Code', 'asc')->filter(request(['search']))->paginate();
        return view('members.index', ['members' => $members]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('members.create');
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
            'Names' => 'required',
            'Code' => ['required', 'unique:members,Code'],
            'Contacts' => 'required'
        ]);

        Member::create($formFields);

        return redirect(route('member.index'))->with('success', 'Member Registered Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $toDetail = Member::where('id', $id)->first();
        return view('members.show', ['toDetail' => $toDetail]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function memberAccounts($id)
    {
        $toDetailMembersAccounts = Member::where('members.id', $id)
            ->leftJoin('transactions', 'members.id', '=', 'transactions.member_id')
            ->join('accounts', 'accounts.id', '=', 'transactions.account_id')
            ->selectRaw('accounts.id, accounts.Name, accounts.year, accounts.Code, accounts.AnualPrinciple, members.id as member_id, members.Names as member, members.Code as member_Code, SUM(transactions.Dr) as totalAmountPaid')
            ->groupBy(['accounts.id', 'accounts.Name', 'members.id'])
            ->orderBy('member_id', 'ASC')
            ->get();
        return view('members.member_accounts', ['toDetailMembersAccounts' => $toDetailMembersAccounts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $toUpdate = Member::where('id', $id)->first();
        return view('members.edit', ['toUpdate' => $toUpdate]);
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
            'Names' => 'required',
            'Code' => ['required'],
            'Contacts' => 'required'
        ]);

        Member::where('id', $id)->update($formFields);

        return redirect(route('member.index'))->with('success', 'Member Registered Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
