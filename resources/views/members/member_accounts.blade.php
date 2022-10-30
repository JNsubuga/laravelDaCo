<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account Details') }}
            <a href="{{ route('member.index') }}" class="bg-blue-500 text-white rounded-md py-1 px-2 my-4 hover:bg-blue-400 hover:text-blue-700 hover:border-blue-200 hover:border-4">
                &lArr; Accounts List
            </a>
        </h2>
    </x-slot>
    <div class="p-2 bg-slate-100 sm:rounded-lg m-1 w-full mx-1 shadow-sm">
        <div>
            <h1 class="font-bold uppercase text-green-700">{{ 'Member: '.$toDetailMembersAccounts[0]->member }}</h1>
            <table class="table-auto w-full mt-2">
                    <tr class="border-b-4 border-gray-400 font-bold capitalize">
                    <th class="py-1 px-6 text-left">Account</th>
                    <th class="py-1 px-6 text-left">Folio</th>
                    <th class="py-1 px-6 text-right">Anual Principle</th>
                    <th class="py-1 px-6 text-right">Amount Paid</th>
                    <th class="py-1 px-6 text-right">Balance</th>
                </tr>
                @php
                    $totalPrinciple = 0; 
                    $totalAmountPaid = 0; 
                    $totalBalance = 0;
                @endphp
                    @forelse ($toDetailMembersAccounts as $account)
                    @php
                        $totalPrinciple = $totalPrinciple + $account->AnualPrinciple;
                        $totalAmountPaid = $totalAmountPaid + $account->totalAmountPaid;
                        $totalBalance = $totalPrinciple - $totalAmountPaid;
                    @endphp
                        <tr class="border-b-2 border-gray-300">
                            <td class="py-0 px-6 text-left">{{ $account->Name }}</td>
                            <td class="py-0 px-6 text-left">{{ 'F'.$account->year.'-'.$account->Code.'-'.$account->member_Code }}</td>
                            <td class="py-0 px-6 text-right">{{ number_format($account->AnualPrinciple, 2, '.', ',') }}</td>
                            <td class="py-0 px-6 text-right">{{ number_format($account->totalAmountPaid, 2, '.', ',') }}</td>
                            <td class="py-0 px-6 text-right">{{ number_format($account->AnualPrinciple - $account->totalAmountPaid, 2, '.', ',') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-red-500">No transaction record found in the database!!!</td></tr>
                    @endforelse
                    <tr>
                        <td class="py-0 px-6" colspan="2">Total</td>
                        <td class="py-0 px-6 text-right">{{ number_format($totalPrinciple, 2, '.', ',') }}</td>
                        <td class="py-0 px-6 text-right">{{ number_format($totalAmountPaid, 2, '.', ',') }}</td>
                        <td class="py-0 px-6 text-right">{{ number_format($totalBalance, 2, '.', ',') }}</td>
                    </tr>
            </table>
        </div>
    </div>
</x-app-layout>