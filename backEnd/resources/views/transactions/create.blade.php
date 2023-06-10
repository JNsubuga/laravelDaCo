<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register New Account') }}
            <div class="w-3/4 absolute top-5 right-0">
                <a href="{{ route('transaction.index') }}" class="bg-blue-500 text-white rounded-md py-1 px-2 hover:bg-blue-400 hover:text-blue-700 hover:border-blue-200 hover:border-4">
                    &lArr; Transactions List
                </a>
            </div>
        </h2>
    </x-slot>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}
        
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 pt-4 w-1/3">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form method="POST" action="{{ route('transaction.store') }}">
                    @csrf
                    <!-- txnDate -->
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="txnDate" :value="__('Date')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-input id="txnDate" class="block mt-1 w-full" type="date" name="txnDate" :value="old('Name')" autofocus />
                            @error('txnDate')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- event_id -->
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="event_id" :value="__('Event')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-selectinput name="event_id" id="event_id">
                                <option value="" disabled selected hidden>--Select Event--</option>
                                @foreach ($selectEvents as $selectItem)
                                    <option value="{{$selectItem->id}}">{{$selectItem->Event}}</option>
                                @endforeach
                            </x-selectinput>
                            @error('event_id')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                     <!-- member_id -->
                     <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="member_id" :value="__('Member')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-selectinput name="member_id" id="member_id">
                                <option value="" disabled selected hidden>--Select Member--</option>
                                @foreach ($selectMembers as $selectItem)
                                    <option value="{{$selectItem->id}}">{{$selectItem->Names}}</option>
                                @endforeach
                            </x-selectinput>
                            @error('member_id')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- account_id -->
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="account_id" :value="__('Account')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-selectinput name="account_id" id="account_id">
                                <option value="" disabled selected hidden>--Select Account--</option>
                                @foreach ($selectAccounts as $selectItem)
                                    <option value="{{$selectItem->id}}">{{$selectItem->year.'-'.$selectItem->Code}}</option>
                                @endforeach
                            </x-selectinput>
                            @error('account_id')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- amount -->
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="amount" :value="__('Amount')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-input id="amount" class="block mt-1 w-full" type="number" name="amount" :value="old('amount')" />
                            @error('amount')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-3 bg-gray-600 hover:bg-gray-500" type="reset">
                            {{ __('Cancel') }}
                        </x-button>

                        <x-button class="ml-3 bg-green-600 hover:bg-green-500" type="submit">
                            {{ __('Commit') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>