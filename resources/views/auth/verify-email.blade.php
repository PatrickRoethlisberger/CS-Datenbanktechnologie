<x-modal-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo-small class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Vielen Dank für die Registrierung! Bevor wir jedoch starten könenn, müssen Sie Ihre Mailadresse mit einem Klick auf den Link bestätigen. Wenn Sie keine Mail erhalten haben, senden wir Ihnen gerne eine neue.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('Eine neue Bestätigungsmail wude an die Addresse geschickt, wo Sie bei der Registrierung angegeben haben.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('Mail nicht erhalten?') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Logout') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-modal-layout>
