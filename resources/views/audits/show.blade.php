<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Standorte
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-end mt-4">
                        <x-button-link class="mt-4" :href="route('audits.index')">
                            Zurück
                        </x-button-link>
                    </div>
                    @if ($audits->count())
                        <h2 class="text-xl font-bold leading-none text-left lg:text-3xl">Übersicht aller Audits durch {{$audits->first()->auditor()->first()->name}}</h2>
                        <div class="overflow-x-auto mt-3">

                            <table class="table-auto border-collapse w-full">
                                <thead>
                                    <tr class="rounded-lg text-sm font-medium text-gray-700 text-left">
                                        <th class="px-4 py-2 bg-gray-50 "">Kunde</th>
                                        <th class="px-4 py-2 bg-gray-50">Auditor</th>
                                        <th class="px-4 py-2 bg-gray-50">Datum</th>
                                        <th class="px-4 py-2 bg-gray-50">Bestanden</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm font-normal text-gray-700">
                                    @foreach ($audits as $audit)
                                        <tr class="hover:bg-gray-100 border-b border-gray-200 py-10">
                                            <td class="px-4 py-4">{{ $audit->client()->first()->name }}</td>
                                            <td class="px-4 py-4">{{ $audit->auditor()->first()->name }}</td>
                                            <td class="px-4 py-4">{{ $audit->date }}</td>
                                            <td class="px-4 py-4">{{ $audit->approved ? 'Bestanden' : 'Nicht bestanden' }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    {{ $audits->links() }}
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
