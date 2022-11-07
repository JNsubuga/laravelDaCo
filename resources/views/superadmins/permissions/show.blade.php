<x-superadmin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Grant/Revoke Permissions') }}
        </h2>
    </x-slot>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 pt-4 w-1/3">
        <div class="overflow-hidden shadow-sm sm:rounded-lg p-2">
            <div class="mt-6 p-2">
                <h2 class="text-2xl font-semibold">Roles</h2>
                <div>
                    @if ($toDetail->roles)
                        @foreach ($toDetail->roles as $role)
                            <div class="grid grid-cols-4">
                                <form class="bg-red-600 px-2 m-px text-center rounded" action="{{route('superadmin.permissions.removeRole', [$toDetail->id, $role->id])}}" method="post" onsubmit="return confirm('Are you sure! You need to Delete this Record?!')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white italic font-bold">{{ $role->name }}</button>
                                </form>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div>
                <form method="POST" action="{{ route('superadmin.permissions.assignRole', $toDetail->id) }}">
                    @csrf
                    <!-- role -->
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                            <x-label for="role" :value="__('Role')" class="mr-4 mt-4 text-lg"/>
                        </div>
                        <div class="md:w-2/3">
                            <x-selectinput name="role" id="role">
                                <option value="" disabled selected hidden>--Select Role--</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </x-selectinput>
                            @error('role')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-3 bg-gray-600 hover:bg-gray-500" type="reset">
                            {{ __('Cancel') }}
                        </x-button>

                        <x-button class="ml-3 bg-green-600 hover:bg-green-500" type="submit">
                            {{ __('Assign Role') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-superadmin-layout>