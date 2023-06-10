<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Account') }}
            <div class="w-3/4 absolute top-5 right-0">
                <a href="{{ route('account.index') }}" class="bg-blue-500 text-white rounded-md py-1 px-2 hover:bg-blue-400 hover:text-blue-700 hover:border-blue-200 hover:border-4">
                    &lArr; Accounts List
                </a>
            </div>
        </h2>
    </x-slot>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 pt-4 w-1/3">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form method="POST" action="{{ route('account.update',$toUpdate->id) }}">
                    @csrf
                    @method('PUT')
                    <!-- Name -->
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="Name" :value="__('Name')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-input id="Name" class="block mt-1 w-full" type="text" name="Name" value="{{ $toUpdate->Name }}" autofocus />
                            @error('Name')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- year -->
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="year" :value="__('Year')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-input id="year" class="block mt-1 w-full" type="number" name="year" value="{{ $toUpdate->year }}" />
                            @error('year')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Code -->
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="Code" :value="__('Code')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-input id="Code" class="block mt-1 w-full" type="text" name="Code" value="{{ $toUpdate->Code }}" />
                            @error('Code')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Anual Principle -->
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3 my-0 py-0">
                            <x-label for="AnualPrinciple" :value="__('Principle Amount')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3 my-0 py-0">
                            <x-input id="AnualPrinciple" class="block mt-1 w-full" type="number" name="AnualPrinciple" value="{{ $toUpdate->AnualPrinciple }}" />
                            @error('AnualPrinciple')
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