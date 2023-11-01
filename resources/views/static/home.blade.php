<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <h2 class="font-semibold
                            text-xl text-gray-800
                            dark:text-gray-200 leading-tight pr-10">
                {{ __('HOME') }}
            </h2>
        </div>
    </x-slot>

    <section class="w-full p-6 flex flex-col gap-4">
        <div>
            <h1 class="dark:text-gray-100 text-gray-800">Welcome to THROAT!</h1>
        </div>
        <div>
            <p class="dark:text-gray-100 text-gray-800">A Terrifying Huge Resource of Organised Acronyms and Terminology!</p>
        </div>
    </section>
</x-app-layout>
