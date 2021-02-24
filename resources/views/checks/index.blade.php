<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pendente Checks
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($users->count())
                        <div class="overflow-x-auto mt-6">

                            <table class="table-auto border-collapse w-full">
                                <thead>
                                    <tr class="rounded-lg text-sm font-medium text-gray-700 text-left">
                                        <th class="px-4 py-2 bg-gray-50 "">Benutzer ID</th>
                                        <th class="px-4 py-2 bg-gray-50">Name</th>
                                        <th class="px-4 py-2 bg-gray-50">Check</th>
                                        <th class="px-4 py-2 bg-gray-50"></th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm font-normal text-gray-700">
                                    @foreach ($users as $user)
                                        <tr class="hover:bg-gray-100 border-b border-gray-200 py-10">
                                            <td class="px-4 py-4">{{ $user->id }}</td>
                                            <td class="px-4 py-4">{{ $user->name }}</td>
                                            <td class="px-4 py-4">{{ collect($user->checks->firstWhere('approved', false))->get('name') }}</td>
                                            <td class="px-4 py-4">
                                                <form action="{{ route('checks.update',  $user)}}" method="post" class="mr-1">
                                                    @csrf
                                                    @method('PUT')
                                                    <x-button type="submit" class="float-right">Erledigt</x-button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    @else
                    <p>Es stehen keine Bewerbungen mehr aus.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
