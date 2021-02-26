<x-modal-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo-small class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-validation-errors class="mb-4" :errors="$errors" />
        <h2 class="text-xl font-bold leading-none text-left lg:text-3xl">Audit {{$user->name}}</h2>
        <p class="font-bold mt-2">Stand:</p>
        <p>{{$location->streetname}} {{$location->streetnumber}}</p>
        <p>{{$location->plz}} {{$location->city}}</p>
        <div class="flex items-center justify-between mt-4">
        <form action="{{ route('audits.store', [$user, '1']) }}" method="post" class="mr-1">
            @csrf
            <x-button class="mx-2">Bestanden</x-button>
        </form>
        <form action="{{ route('audits.store', [$user, '0']) }}" method="post" class="mr-1">
            @csrf
            <x-button class="mx-2 bg-red-400">Nicht Bestanden</x-button>
        </form>
        </div>
    </x-auth-card>
</x-modal-layout>
