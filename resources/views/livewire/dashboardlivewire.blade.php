<div class="max-w-md mx-auto p-6 bg-white rounded-xl shadow-lg space-y-6">
    <h2 class="text-sm font-bold uppercase text-gray-500">Dashboard</h2>

    <h1 class="text-xl font-semibold text-center text-gray-800">
        Explora la debida diligencia<br>en el mundo.
    </h1>

    <div class="flex justify-center">
        <img src="{{ asset('storage/89edf7b2-a1a7-4830-905a-1298f8e91623.png') }}" alt="Mapa del mundo" class="w-full h-auto rounded-md">
    </div>

    <div class="relative">
        <input
            type="text"
            wire:model="search"
            placeholder="Buscar país"
            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
        />

        @if($search && $countries->count())
            <ul class="absolute z-10 w-full mt-1 bg-white border rounded-md max-h-60 overflow-y-auto">
                @foreach($countries as $country)
                    <li wire:click="selectCountry({{ $country->id }})"
                        class="px-4 py-2 hover:bg-blue-100 cursor-pointer"
                    >
                        {{ $country->name }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <div>
        <button
            class="w-full bg-blue-900 text-white py-2 px-4 rounded-md hover:bg-blue-800 transition"
            @disabled(!$selectedCountry)
        >
            {{ $selectedCountry ? 'País seleccionado: ' . $selectedCountry->name : 'Selecciona un país' }}
        </button>
    </div>
</div>
