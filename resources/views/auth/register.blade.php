<x-modal-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo-small class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email *')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" autocomplete="email" :value="old('email')" required autofocus/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Passwort *')" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Passwort bestätigen *')" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            </div>

            <!-- Companyname -->
            <div class="mt-4">
                <x-label for="companyname" :value="__('Firma')" />
                <x-input id="companyname" class="block mt-1 w-full" type="text" name="companyname" :value="old('companyname *')" />
            </div class="mt-4">

            <!-- Firstname -->
            <div class="mt-4">
                <x-label for="firstname" :value="__('Vorname *')" />
                <x-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" autocomplete="fname" :value="old('firstname')" required />
            </div class="mt-4">

            <!-- Lastname -->
            <div class="mt-4">
                <x-label for="lastname" :value="__('Nachname *')" />
                <x-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" autocomplete="lanme" :value="old('lastname')" required  />
            </div>

            <!-- Streetname -->
            <div class="mt-4">
                <x-label for="streetname" :value="__('Strasse *')" />
                <x-input id="streetname" class="block mt-1 w-full" type="text" name="streetname" autocomplete="street-address" :value="old('streetname')" required  />
            </div>

            <!-- Streetnumber -->
            <div class="mt-4">
                <x-label for="streetnumber" :value="__('Hausnummer *')" />
                <x-input id="streetnumber" class="block mt-1 w-full" type="text" name="streetnumber" :value="old('streetnumber')" required  />
            </div>

            <!-- PLZ -->
            <div class="mt-4">
                <x-label for="plz" :value="__('PLZ *')" />
                <x-input id="plz" class="block mt-1 w-full" type="text" name="plz" autocomplete="postal-code" :value="old('plz')" required  />
            </div>

            <!-- City -->
            <div class="mt-4">
                <x-label for="city" :value="__('Stadt *')" />
                <x-input id="city" class="block mt-1 w-full" type="text" name="city" autocomplete="address-level2" :value="old('city')" required  />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Bereits registriert?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Registrieren') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-modal-layout>
