<x-modal-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo-small class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-validation-errors class="mb-4" :errors="$errors" />

        <div class="flex items-center justify-between mt-4">
        <form action="{{ route('audits.store', [$user, '1']) }}" method="post" class="mr-1">
            @csrf
            <x-button class="ml-4">Bestanden</x-button>
        </form>
        <form action="{{ route('audits.store', [$user, '0']) }}" method="post" class="mr-1">
            @csrf
            <x-button class="ml-4 bg-red-400">Nicht Bestanden</x-button>
        </form>
        </div>
    </x-auth-card>
</x-modal-layout>
