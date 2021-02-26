<x-modal-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo-small class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-validation-errors class="mb-4" :errors="$errors" />
        @if ($occupation->user_id == Auth::user()->id)
            <h2 class="text-xl font-bold leading-none text-left lg:text-3xl">Reservation löschen</h2>
            <p class="mt-4">{{ $location->streetname }} {{ $location->streetnumber }} am {{ \Carbon\Carbon::parse($occupation->date)->toFormattedDateString()}} nicht mehr reservieren.</p>
            <div class="flex items-center justify-end mt-4">
                <form action="{{ route('occupations.destroy', [$occupation]) }}" method="post" class="mr-1">
                    @csrf
                    @method('DELETE')
                    <x-button class="ml-4">Jetzt löschen</x-button>
                </form>
            </div>
        @else
            @can('create-occupation', $occupation->date)
                @if (\Carbon\Carbon::parse($occupation->date) < \Carbon\Carbon::today())
                    <h2 class="text-xl font-bold leading-none text-left lg:text-3xl">Datum in der Vergangenheit</h2>
                    <p class="mt-4">Es ist nur möglich die Verfügarbeit einen Standort in der Zukunft zu reservieren - Zeitmaschinen wurden leider noch nicht erfunden 😉</p>
                    <div class="flex items-center justify-end mt-4">
                        <x-button-link class="ml-4" :href="route('occupations.create', $location)">
                            {{ __('Zurück zur Übersicht') }}
                        </x-button-link >
                    </div>
                @elseif ($occupation->user_id)
                    <h2 class="text-xl font-bold leading-none text-left lg:text-3xl">Bereits vergeben</h2>
                    <p class="mt-4">Dieser Standort wurde leider zu dem Datum bereits vergeben.</p>
                    <div class="flex items-center justify-end mt-4">
                        <x-button-link class="ml-4" :href="route('occupations.create', $location)">
                            {{ __('Zurück zur Übersicht') }}
                        </x-button-link >
                    </div>
                @else
                    <h2 class="text-xl font-bold leading-none text-left lg:text-3xl">Reservieren</h2>
                    <p class="mt-4">{{ $location->streetname }} {{ $location->streetnumber }} am {{ \Carbon\Carbon::parse($occupation->date)->toFormattedDateString()}} jetzt reservieren.</p>
                    <div class="flex items-center justify-end mt-4">
                        <form action="{{ route('occupations.update', [$occupation]) }}" method="post" class="mr-1">
                            @csrf
                            @method('PUT')
                            <x-button class="ml-4">Jetzt reservieren</x-button>
                        </form>
                    </div>
                @endif
            @else
                <h2 class="text-xl font-bold leading-none text-left lg:text-3xl">Reservation nicht möglich</h2>
                <p class="mt-4">Leider haben Sie für diese Woche bereits alle Plätze reserviert oder für den Zeitraum kein gültiges Abonoment</p>
                <div class="flex items-center justify-end mt-4">
                    <x-button-link class="ml-4" :href="route('occupations.create', $location)">
                        {{ __('Zurück zur Übersicht') }}
                    </x-button-link >
                </div>
            @endcan
        @endif


    </x-auth-card>
</x-modal-layout>
