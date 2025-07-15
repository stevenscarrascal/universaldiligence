<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fuentes') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-2">
        <x-button-href class="btn bg-green-500 hover:bg-green-700 focus:bg-green-700 active:bg-green-900 text-white font-bold gap-2" :href="route('sources.create',['id' => $id, 'name' => $name])">
            <x-heroicon-o-plus-circle class="h-6 w-6 text-white" />
            Nueva fuente
        </x-button-href>
        <x-button-href class="btn bg-neutral-500 hover:bg-neutral-700 focus:bg-neutral-700 active:bg-neutral-900 text-white font-bold gap-2" :href="route('dashboard')">
            <x-heroicon-o-arrow-uturn-left class="h-6 w-6 text-white" />
            volver
        </x-button-href>
    </div>
    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <livewire:ListSourcesLivewire :source_id="$id" :source_name="$name"/>
            </div>
        </div>
    </div>
</x-app-layout>