<x-superadmin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register New Gender') }}
        </h2>
    </x-slot>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 pt-4 w-1/3">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            {{-- <div class="p-6 border-b border-gray-200">
                <form method="POST" action="{{ route('superadmin.roles.update', $toPermite->id) }}">
                    @csrf
                    @method('PUT')
                    <!-- Gender -->
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                            <x-label for="name" :value="__('Role')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3">
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $toPermite->name }}" required autofocus />
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
            </div> --}}
            <div class="mt-6 p-2">
                <h2 class="text-2xl font-semibold">Role Permissions</h2>
                <div>
                    @if ($role->permissions)
                        @foreach ($role->permissions as $permission)
                            <div class="grid grid-col-4">
                                <div class="bg-red-600 text-white">
                                    {{ $permission->name }}
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div>
                <form method="POST" action="{{ route('superadmin.roles.update', $toPermite->id) }}">
                    @csrf
                    @method('PUT')
                    <!-- Gender -->
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                            <x-label for="name" :value="__('Role')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3">
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $toPermite->name }}" required autofocus />
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