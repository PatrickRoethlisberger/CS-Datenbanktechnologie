<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Abonomente
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($orders->count())
                        <div class="overflow-x-auto mt-6">

                            <table class="table-auto border-collapse w-full">
                                <thead>
                                    <tr class="rounded-lg text-sm font-medium text-gray-700 text-left">
                                        <th class="px-4 py-2 bg-gray-50 "">Bestellnummer</th>
                                        <th class="px-4 py-2 bg-gray-50">Abonoment</th>
                                        <th class="px-4 py-2 bg-gray-50">Von</th>
                                        <th class="px-4 py-2 bg-gray-50">Bis</th>
                                        <th class="px-4 py-2 bg-gray-50">Bezahlt am</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm font-normal text-gray-700">
                                    @foreach ($orders as $order)
                                        <tr class="hover:bg-gray-100 border-b border-gray-200 py-10">
                                            <td class="px-4 py-4">{{ $order->id }}</td>
                                            <td class="px-4 py-4">{{ $order->plan->name }}</td>
                                            <td class="px-4 py-4">{{ $order->from }}</td>
                                            <td class="px-4 py-4">{{ $order->until }}</td>
                                            <td class="px-4 py-4">{{ $order->paid_at }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    {{ $orders->links() }}
                    @else
                    <p>Bis jetzt wurden noch keine Abonomente getätigt.</p>
                    <x-button-link class="mt-4" :href="route('plans')">
                        Jetzt Abonoment abschliessen
                    </x-button-link>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
