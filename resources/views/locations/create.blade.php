<x-modal-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo-small class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('locations.store') }}">
            @csrf

            <!-- Description -->
            <div class="mt-4">
                <x-label for="description" :value="__('Beschreibung')" />
                <x-textarea id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" autofocus/>
            </div>

            <!-- Streetname -->
            <div class="mt-4">
                <x-label for="streetname" :value="__('Strasse *')" />
                <x-input id="streetname" class="block mt-1 w-full" type="text" name="streetname" :value="old('streetname')" required  />
            </div>

            <!-- Streetnumber -->
            <div class="mt-4">
                <x-label for="streetnumber" :value="__('Hausnummer *')" />
                <x-input id="streetnumber" class="block mt-1 w-full" type="text" name="streetnumber" :value="old('streetnumber')" required  />
            </div>

            <!-- PLZ -->
            <div class="mt-4">
                <x-label for="plz" :value="__('PLZ *')" />
                <x-input id="plz" class="block mt-1 w-full" type="text" name="plz" :value="old('plz')" required  />
            </div>

            <!-- City -->
            <div class="mt-4">
                <x-label for="city" :value="__('Stadt *')" />
                <x-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required  />
            </div>


            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Jetzt erstellen') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-modal-layout>
