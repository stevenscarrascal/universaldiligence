@props(['href'])

<a role="button" @isset($href) href="{{ $href }}" @endisset
    {{ $attributes->merge(['class' => 'btn inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</a>
