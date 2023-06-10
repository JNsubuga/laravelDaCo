<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('member Details') }}
            <a href="{{ route('account.index') }}" class="bg-blue-500 text-white rounded-md py-1 px-2 my-4 hover:bg-blue-400 hover:text-blue-700 hover:border-blue-200 hover:border-4">
                &lArr; Accounts List
            </a>
        </h2>
    </x-slot>
    <div class="p-2 bg-slate-100 sm:rounded-lg m-1 w-full mx-1 shadow-sm">
        <div>
            @if (empty($toDetail[0]->member))
            <h1 class="text-red-500 capitalize">No account name Record found in the database!!!</h1>
            @else
                <h1 class="font-bold uppercase text-green-700">
                    {{ 'Year '.$toDetail[0]->year.': '.$toDetail[0]->Name }}
                </h1>
            @endif
            <table class="table-auto w-full mt-2">
                    <tr class="border-b-4 border-gray-400 font-bold capitalize">
                    <th class="py-1 px-6 text-left">Member</th>
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
                    @forelse ($toDetail as $member)
                    @php
                        $totalPrinciple = $totalPrinciple + $member->AnualPrinciple;
                        $totalAmountPaid = $totalAmountPaid + $member->totalAmountPaid;
                        $totalBalance = $totalPrinciple - $totalAmountPaid;
                    @endphp
                        <tr class="border-b-2 border-gray-300">
                            <td class="py-0 px-6 text-left">
                                <a href="{{ route('account.memberAccountDetails', ['account_id' => $member->account_id, 'member_id' => $member->member_id]) }}">
                                    {{ ($member->member) }}
                                </a>
                            </td>
                            <td class="py-0 px-6 text-left">{{ 'F'.$member->year.'-'.$member->member_Code.'-'.$member->Code }}</td>
                            <td class="py-0 px-6 text-right">{{ number_format($member->AnualPrinciple, 2, '.', ',') }}</td>
                            <td class="py-0 px-6 text-right">{{ number_format($member->totalAmountPaid, 2, '.', ',') }}</td>
                            <td class="py-0 px-6 text-right">{{ number_format($member->AnualPrinciple - $member->totalAmountPaid, 2, '.', ',') }}</td>
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