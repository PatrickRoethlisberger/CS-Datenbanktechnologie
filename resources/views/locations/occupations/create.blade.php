<x-modal-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo-small class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-validation-errors class="mb-4" :errors="$errors" />

        @if (!$date > \Carbon\Carbon::today())
            <h2 class="text-xl font-bold leading-none text-left lg:text-3xl">Datum in der Vergangenheit</h2>
            <p class="mt-4">Es ist nur möglich die Verfügarbeit in einem Datum in der Zukunft anzupassen - Zeitmaschinen wurden leider noch nicht erfunden 😉</p>
            <div class="flex items-center justify-end mt-4">
                <x-button-link class="ml-4" :href="route('locations.show', $location)">
                    {{ __('Zurück zur Übersicht') }}
                </x-button-link >
            </div>
        @elseif (empty($match))
            <h2 class="text-xl font-bold leading-none text-left lg:text-3xl">Jetzt zur Verfügung stellen</h2>
            <p class="mt-4">{{ $location->streetname }} {{ $location->streetnumber }} am {{ \Carbon\Carbon::parse($date)->toFormattedDateString()}} zur Verfügung stellen.</p>
            <div class="flex items-center justify-end mt-4">
                <form action="{{ route('locations.occupations.store', [$location, $date]) }}" method="post" class="mr-1">
                    @csrf
                    <x-button class="ml-4">Jetzt erstellen</x-button>
                </form>
            </div>
        @elseif ($match->user_id)
            <h2 class="text-xl font-bold leading-none text-left lg:text-3xl">Bereits vergeben</h2>
            <p class="mt-4">Leider ist es nicht möglich Angebote zu löschen, wenn der Platz an diesem Datum bereits vergeben wurde.</p>
            <div class="flex items-center justify-end mt-4">
                <x-button-link class="ml-4" :href="route('locations.show', $location)">
                    {{ __('Zurück zur Übersicht') }}
                </x-button-link >
            </div>
        @else
            <h2 class="text-xl font-bold leading-none text-left lg:text-3xl">Verfügbarkeit löschen</h2>
            <p class="mt-4">{{ $location->streetname }} {{ $location->streetnumber }} am {{ \Carbon\Carbon::parse($date)->toFormattedDateString()}} nicht mehr zur Verfügung stellen.</p>
            <div class="flex items-center justify-end mt-4">
                <form action="{{ route('locations.occupations.destroy', [$location, $date]) }}" method="post" class="mr-1">
                    @csrf
                    @method('DELETE')
                    <x-button class="ml-4">Jetzt löschen</x-button>
                </form>
            </div>
        @endif

    </x-auth-card>
</x-modal-layout>
