<x-superadmin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register New Gender') }}
        </h2>
    </x-slot>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" />     --}}
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 pt-4 w-1/3">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <form method="POST" action="{{ route('superadmin.permissions.update', $toEdit->id) }}">
                    @csrf
                    @method('PUT')
                    <!-- Name -->
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                            <x-label for="name" :value="__('Permission')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3">
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $toEdit->name }}" required autofocus />
                            @error('name')
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
</x-superadmin-layout>