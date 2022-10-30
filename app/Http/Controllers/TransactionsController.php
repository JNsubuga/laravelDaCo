<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Member;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::orderBy('txnDate', 'asc')->filter(request(['search']))->paginate('50');
        return view('transactions.index', ['transactions' => $transactions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $selectEvents = Event::get(['id', 'Event']);
        $selectMembers = Member::get(['id', 'Names']);
        $selectAccounts = Account::get(['id', 'year', 'Code']);

        return view('transactions.create', [
            'selectEvents' => $selectEvents,
            'selectMembers' => $selectMembers,
            'selectAccounts' => $selectAccounts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        switch ($request->event_id) {
            case 1:
                $formFields = $request->validate([
                    'txnDate' => 'required',
                    'event_id' => 'required',
                    'member_id' => 'required',
                    'account_id' => 'required',
                    'amount' => 'required'
                ]);

                $selectedMember = Member::where('id', $formFields['member_id'])->first();

                $Dr = $formFields['amount'];
                $Cr = 0;
                $balanceBefore = $selectedMember['currentBalance'];
                $balanceAfter = $selectedMember['currentBalance'] + $formFields['amount'];

                $memberAccountIds = [$selectedMember['id'], $formFields['account_id']];
                // dd($memberAccountIds[0] . '-' . $memberAccountIds[1]);
                DB::table('member_account')->insert([
                    'member_id' => $memberAccountIds[0],
                    'account_id' => $memberAccountIds[1]
                ]);

                Transaction::create([
                    'txnDate' => $formFields['txnDate'],
                    'account_id' => $formFields['account_id'],
                    'event_id' => $formFields['event_id'],
                    'member_id' => $formFields['member_id'],
                    'Dr' => $Dr,
                    'Cr' => $Cr,
                    'balanceBefore' => $balanceBefore
                ]);

                Member::where('id', $selectedMember['id'])->update([
                    'Names' => $selectedMember['Names'],
                    'Code' => $selectedMember['Code'],
                    'Contacts' => $selectedMember['Contacts'],
                    'currentBalance' => $balanceAfter
                ]);


                // dd($memberAccountIds);

                // $selectedMember->accounts()->sync($memberAccountIds);
                // $selectedMember->accounts()->attach($memberAccountIds);



                return redirect(route('transaction.index'))->with('success', 'Transaction Recorded Successfully!!');
                break;
            case 2:
                $Dr = 0;
                $Cr = $request->amount;
                break;

            default:
                return back()->with('error', 'Event Not Selected!!!');
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
