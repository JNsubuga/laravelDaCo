<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Member\'s Accounts') }}
            {{-- @include('layouts._search') --}}
        </h2>
    </x-slot>
    
    <div class="p-2 bg-slate-100 sm:rounded-lg m-1 w-full mx-1 shadow-sm">
        {{-- <div class="relative w-full">
            <div class="absolute right-0">
                <a href="{{ route('memberaccount.create') }}" class="bg-blue-500 text-white rounded-md py-1 px-2 my-4 hover:bg-blue-400 hover:text-blue-700 hover:border-blue-200 hover:border-4">
                    Register New Member
                </a>
            </div>
        </div> --}}
        <div class="rounded-lg p-4 bg-transparent w-full grid grid-cols-5 space-x-2 space-y-2">
            @forelse ($memberaccounts as $memberaccount)
                <div class="rounded-xl border border-green-600 p-2 shadow-lg">
                    <h1 class="w-full border-b-2 border-gray-500 font-bold capitalize">
                        <a href="{{ route('memberaccount.show', $member->id) }}">{{ $memberaccout->member->Names }}</a>
                    </h1>
                    <div class="mt-4">
                        <div class="flex relative">
                            <p class="absolute left-0 capitalize">Member's code:</p> <p class="absolute right-0 text-green-700 font-extrabold">{{ $memberaccount->member->Code }}</p>
                        </div>
                        <div class="flex relative mt-5">
                            <p class="absolute left-0 capitalize">Member's worthness:</p> <p class="absolute right-0">{{ $memberaccount->currentBalance }}</p>
                        </div>
                    </div>
                    
                    <div class="flex relative mt-6">
                        <a href="{{ route('memberaccount.edit', $memberaccount->id) }}" class="text-blue-500 bg-slate-300 m-px rounded text-center font-bold px-2">
                            Edit
                        </a>
                        <form class="bg-red-600 px-0 m-px text-center rounded absolute right-0" action="{{route('memberaccount.destroy', $memberaccount->id)}}" method="post" onsubmit="return confirm('Are you sure! You need to Delete this Record?!')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-white italic font-bold px-2">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-red-600">No records in the database!!!</p>
            @endforelse
        </div>
    </div>
</x-app-layout>