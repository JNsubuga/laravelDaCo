<x-superadmin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="p-2 bg-slate-100 sm:rounded-lg m-1 w-full mx-1 shadow-sm">
        <table class="table-auto w-full mt-6">
            <tr class="border-b-4 border-gray-400 font-bold capitalize">
                <th class="py-1 px-6 text-left">Name</th>
                <th class="py-1 px-6 text-left">email</th>
                <th class="py-1 px-6 text-right">Action</th>
            </tr>
            @forelse ($users as $user)
            <tr class="border-b-2 border-gray-300">
                <td class="py-0 px-6">
                    <a href="{{ route('superadmin.users.show', $user->id) }}">
                        {{ $user->name }}
                    </a>
                </td>
                <td class="py-0 px-6">{{ $user->email }}</td>
                    <td class="py-0 flex justify-end space-x-1">
                    <form class="bg-red-600 px-2 m-px text-center rounded" action="{{route('superadmin.users.destroy', $user->id)}}" method="post" onsubmit="return confirm('Are you sure! You need to Delete this Record?!')">
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