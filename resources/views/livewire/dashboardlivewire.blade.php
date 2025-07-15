<div class="max-w-3xl mx-auto p-4">
    <h2 class="text-center text-2xl font-semibold mb-4">Explora la debida diligencia en el mundo.</h2>

    <div class="bg-blue-100 p-4 rounded-xl mb-4">
        <!-- Mapa o Imagen del mundo -->
        <img src="/images/world-map.png" alt="Mapa del mundo" class="w-full rounded" />
    </div>

    <div class="mb-6">
        <select wire:model.live="selectedCountry" class="w-full p-2  rounded-md">
            <option value="">Selecciona un país</option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>
    </div>

    @if ($sources && count($sources))
        <div class="overflow-x-auto">
            <table class="w-full text-sm border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 border">Fuente Oficial</th>
                        <th class="p-2 border">Tipo de Información</th>
                        <th class="p-2 border">Categoría</th>
                        <th class="p-2 border">Tipo de Riesgo</th>
                        <th class="p-2 border">URL Oficial</th>
                        <th class="p-2 border">Video</th>
                        <th class="p-2 border">Descripción breve</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sources as $source)
                        <tr class="odd:bg-white even:bg-gray-50">
                            <td class="p-2 border">{{ $source->name }}</td>
                            <td class="p-2 border">{{ $source->type_info }}</td>
                            <td class="p-2 border">{{ $source->category }}</td>
                            <td class="p-2 border">{{ $source->type_risk }}</td>
                            <td class="p-2 border">
                                @if ($hasAccess)
                                    <a href="{{ $source->url }}" target="_blank" class="text-blue-600 underline">Ver enlace</a>
                                @else
                                    <span>🔒 Solo suscriptores</span>
                                @endif
                            </td>
                            <td class="p-2 border">
                                @if ($hasAccess)
                                    <a href="{{ $source->video_url }}" target="_blank" class="text-blue-600 underline">Ver video</a>
                                @else
                                    <span>🔒 Solo suscriptores</span>
                                @endif
                            </td>
                            <td class="p-2 border">{{ $source->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
