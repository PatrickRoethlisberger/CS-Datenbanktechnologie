<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Reservationen
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($occupations->count())
                        <div class="flex items-center justify-end mt-4">
                            <x-button-link class="mt-4" :href="route('occupations.create')">
                                Standort jetzt reservieren
                            </x-button-link>
                        </div>
                        <div class="overflow-x-auto mt-6">

                            <table class="table-auto border-collapse w-full">
                                <thead>
                                    <tr class="rounded-lg text-sm font-medium text-gray-700 text-left">
                                        <th class="px-4 py-2 bg-gray-50">Datum</th>
                                        <th class="px-4 py-2 bg-gray-50">Strasse</th>
                                        <th class="px-4 py-2 bg-gray-50">Hausnummer</th>
                                        <th class="px-4 py-2 bg-gray-50">Postleitzahl</th>
                                        <th class="px-4 py-2 bg-gray-50">Stadt</th>
                                        <th class="px-4 py-2 bg-gray-50"></th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm font-normal text-gray-700">
                                    @foreach ($occupations as $occupation)
                                        <tr class="hover:bg-gray-100 border-b border-gray-200 py-10">
                                            <td class="px-4 py-4">{{ $occupation->date }}</td>
                                            <td class="px-4 py-4">{{ $occupation->location()->first()->streetname }}</td>
                                            <td class="px-4 py-4">{{ $occupation->location()->first()->streetnumber }}</td>
                                            <td class="px-4 py-4">{{ $occupation->location()->first()->plz }}</td>
                                            <td class="px-4 py-4">{{ $occupation->location()->first()->city }}</td>
                                            <td class="px-4 py-4">
                                                <x-button-link class="mt-4" :href="route('occupations.edit', $occupation)">
                                                    Löschen
                                                </x-button-link>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    {{ $occupations->links() }}
                    @else
                    <p>Bis jetzt wurden noch keine Standorte reserviert</p>
                    <x-button-link class="mt-4" :href="route('occupations.create')">
                        Jetzt Reservation erstellen
                    </x-button-link>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
