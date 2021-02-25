<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Standorte
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white blocation-b blocation-gray-200">
                    @if ($locations->count())
                        <div class="flex items-center justify-end mt-4">
                            <x-button-link class="mt-4" :href="route('locations.create')">
                                Weitere Standorte erstellen
                            </x-button-link>
                        </div>
                        <div class="overflow-x-auto mt-6">

                            <table class="table-auto blocation-collapse w-full">
                                <thead>
                                    <tr class="rounded-lg text-sm font-medium text-gray-700 text-left">
                                        <th class="px-4 py-2 bg-gray-50 "">Standortnummer</th>
                                        <th class="px-4 py-2 bg-gray-50">Beschreibung</th>
                                        <th class="px-4 py-2 bg-gray-50">Strasse</th>
                                        <th class="px-4 py-2 bg-gray-50">Hausnummer</th>
                                        <th class="px-4 py-2 bg-gray-50">Postleitzahl</th>
                                        <th class="px-4 py-2 bg-gray-50">Stadt</th>
                                        <th class="px-4 py-2 bg-gray-50"></th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm font-normal text-gray-700">
                                    @foreach ($locations as $location)
                                        <tr class="hover:bg-gray-100 blocation-b blocation-gray-200 py-10">
                                            <td class="px-4 py-4">{{ $location->id }}</td>
                                            <td class="px-4 py-4">{{ $location->description }}</td>
                                            <td class="px-4 py-4">{{ $location->streetname }}</td>
                                            <td class="px-4 py-4">{{ $location->streetnumber }}</td>
                                            <td class="px-4 py-4">{{ $location->plz }}</td>
                                            <td class="px-4 py-4">{{ $location->city }}</td>
                                            <td class="px-4 py-4">
                                                <x-button-link class="mt-4" :href="route('locations.show', $location)">
                                                    zur Verfügung stellen
                                                </x-button-link>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    {{ $locations->links() }}
                    @else
                    <p>Bis jetzt wurden noch Standorte hinzugefügt</p>
                    <x-button-link class="mt-4" :href="route('locations.create')">
                        Jetzt Standort erstellen
                    </x-button-link>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
