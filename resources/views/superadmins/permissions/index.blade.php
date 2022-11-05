<x-superadmin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('SuperAdmin Dashboard') }}
        </h2>
    </x-slot>

    <div class="p-2 bg-slate-100 sm:rounded-lg m-1 w-full mx-1 shadow-sm">
        <div class="relative w-full">
            <div class="absolute right-0">
                <a href="{{ route('superadmin.permissions.create') }}" class="bg-blue-500 text-white rounded-md py-1 px-2 my-4 hover:bg-blue-400 hover:text-blue-700 hover:border-blue-200 hover:border-4">
                    Add Permission
                </a>
            </div>
        </div>
        <table class="table-auto w-full mt-6">
            <tr class="border-b-4 border-gray-400 font-bold capitalize">
                <th class="py-1 px-6 text-left">Name</th>
                <th class="py-1 px-6 text-right">Action</th>
            </tr>
            @forelse ($permissions as $permission)
            <tr class="border-b-2 border-gray-300">
                <td class="py-0 px-6">
                    <a href="{{ route('superadmin.permissions.show', $permission->id) }}">
                        {{ ($permission->name) }}
                    </a>
                </td>
                {{-- <td class="py-0 grid grid-cols-2"> --}}
                    <td class="py-0 flex justify-end space-x-1">
                    <a href="{{ route('superadmin.permissions.edit', $permission->id) }}" class="text-blue-500 bg-slate-300 px-2 m-px rounded text-center font-bold">
                        Edit
                    </a>
                    <form class="bg-red-600 px-2 m-px text-center rounded" action="{{route('superadmin.permissions.destroy', $permission->id)}}" method="post" onsubmit="return confirm('Are you sure! You need to Delete this Record?!')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-white italic font-bold">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
                <tr><td colspan="5" class="text-red-500">No record in the database!!!</td></tr>
            @endforelse
        </table>
    </div>
</x-superadmin-layout>