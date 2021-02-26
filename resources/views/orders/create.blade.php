<x-modal-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo-small class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <h1 class="mb-4 text-2xl text-gray-600">
            Abonoment abschliessen
        </h1>

        <!-- Validation Errors -->
        <x-validation-errors class="mb-4" :errors="$errors" />

        @if ($fromDate)

            <form method="POST" action="{{ route('orders.store') }}">
                @csrf

                <!-- Plan ID -->
                <div class="hidden">
                    <x-label for="plan" :value="__('')" />
                    <x-input id="plan_id" class="block mt-1 w-full"
                                    required
                                    type="text"
                                    name="plan_id"
                                    value="{{ $plan->id }}" />
                </div>

                <!-- Plan -->
                <div>
                    <x-label for="plan" :value="__('Abonoment')" />

                    <x-input id="plan" class="block mt-1 w-full"
                                    disabled
                                    required
                                    type="text"
                                    name="Abonoment"
                                    value="{{ $plan->name }}" />
                </div>

                <!-- From -->
                <div class="mt-4">
                    <x-label for="from" :value="__('Gültig ab')" />

                    <x-input id="from" class="block mt-1 w-full"
                                    disabled
                                    required
                                    type="text"
                                    name="Gültig ab"
                                    value="{{ \Carbon\Carbon::parse($fromDate)->toFormattedDateString() }}" />
                </div>

                <!-- Until -->
                <div class="mt-4">
                    <x-label for="until" :value="__('Gültig bis')" />

                    <x-input id="until" class="block mt-1 w-full"
                                    disabled
                                    required
                                    type="text"
                                    name="Gültig bis"
                                    value="{{ \Carbon\Carbon::parse($fromDate)->addMonths($plan->duration)->toFormattedDateString() }}" />
                </div>

                <!-- Price -->
                <div class="mt-4">
                    <x-label for="price" :value="__('Preis')" />

                    <x-input id="price" class="block mt-1 w-full"
                                    disabled
                                    required
                                    type="text"
                                    name="Preis"
                                    value="{{ $plan->price }}.- CHF" />
                </div>

                <!-- Card -->
                <div class="mt-4">
                    <x-label for="card" :value="__('Kreditkarten Nummer (optional)')" />

                    <x-input id="card" class="block mt-1 w-full"
                                    type="text"
                                    name="Kreditkarten Nummer" />
                </div>

                <div class="flex justify-end mt-4">
                    <x-button>
                        Jetzt Bezahlen
                    </x-button>
                </div>
            </form>
        @else
            <p>Aktuell ist es nicht möglich ein Abo abzuschliessen.</p>
            <p class="mt-4"> Falls Sie noch in der Bewerbungsphase sind, können Sie am letzen Tag des Abonoments das Abonoment erneuern</p>
            <div class="flex justify-end mt-4">
                <x-button-link :href="route('plans.index')">
                    Zurück zum den Angeboten
                </x-button-link>
            </div>
        @endif

    </x-auth-card>
</x-modal-layout>
