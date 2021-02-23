<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            Abos
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-700 body-font">
                        <h2 class="text-xl font-bold leading-none text-left lg:text-3xl">Bewerbungsphase</h2>
                        <p>Um die Qualität der Marktfahrer sicherzustellen verlangen wir von allen Makrtfahrern die Absolvierung einer Bewerbungsphase.</p>
                        <div class="container pt-4 mx-auto lg:px-6">
                            <div class="flex flex-wrap ">
                                @foreach ($initialPlans as $plan)
                                    <div class="px-4 py-6 mx-auto lg:px-6 lg:w-1/3 md:w-full">
                                        <div class="h-full px-4 py-6 border rounded-xl">
                                            <h4 class="tracking-widest">{{ $plan->name }}</h3>
                                            <h3
                                                class="flex items-center justify-start mt-2 mb-4 text-3xl font-bold leading-none text-left text-blue-800 lg:text-4xl">
                                                CHF {{ $plan->price }}
                                                <span class="ml-1 text-base text-gray-600">/{{ $plan->duration }} mo</span>
                                            </h3>
                                            <p class="mb-4 text-base leading-relaxed">{{ $plan->description }}</p>
                                            @can('create-trial-order')
                                                <x-button-link :href="route('orders.create', $plan)">
                                                    Jetzt abschliessen
                                                </x-button-link>
                                            @endcan
                                        </div>
                                    </div>
                                 @endforeach
                            </div>
                        </div>
                        <h2 class="mt-8 text-xl font-bold leading-none text-left lg:text-3xl">Abonomente nach der Bewerbungsphase</h2>
                        <div class="container pt-4 mx-auto lg:px-6">
                            <div class="flex flex-wrap">
                                @foreach ($plans as $plan)
                                    <div class="px-4 py-6 mx-auto lg:px-6 lg:w-1/3 md:w-full">
                                        <div class="h-full px-4 py-6 border rounded-xl">
                                            <h4 class="tracking-widest">{{ $plan->name }}</h3>
                                            <h3
                                                class="flex items-center justify-start mt-2 mb-4 text-3xl font-bold leading-none text-left text-blue-800 lg:text-4xl">
                                                CHF {{ $plan->price }}
                                                <span class="ml-1 text-base text-gray-600">/{{ $plan->duration }} mo</span>
                                            </h3>
                                            <p class="mb-4 text-base leading-relaxed">{{ $plan->description }}</p>
                                            @can('create-order')
                                                @can('create-full-order')
                                                    <x-button-link :href="route('orders.create', $plan)">
                                                        Jetzt abschliessen
                                                    </x-button-link>
                                                @endcan
                                            @endcan
                                        </div>
                                    </div>
                                 @endforeach
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>





