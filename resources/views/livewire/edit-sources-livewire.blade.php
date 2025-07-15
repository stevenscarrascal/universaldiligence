<div>
    <div class="xl:px-10 2xl:px-20">

        <form wire:submit.prevent="submit">
            {{ $this->form }}

            <div class="flex flex-wrap mt-6 gap-4 items-center justify-start">
                <x-button class="btn-primary" wire:target="submit" >
                    <span wire:loading.remove wire:target="submit">{{ __('Guardar') }}</span>
                    <span wire:loading wire:target="submit">Cargando</span>
                </x-button>
                <a class="btn-ghost btn inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150" href="{{route('countries.show',['id' => $this->source_id, 'name' => $this->source_name])}}">{{ __('Cancelar') }}</a>
            </div>
        </form>
    </div>
</div>
