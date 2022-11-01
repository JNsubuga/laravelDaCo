<x-superadmin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('SuperAdmin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4 w-full">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mx-2">
            <div class="p-4 bg-white border-b border-gray-200">
                You're logged in as a SuperAdmin! 
            </div>
        </div>
    </div>
</x-superadmin-layout>
