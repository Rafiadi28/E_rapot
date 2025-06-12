@props(['active' => false, 'id' => uniqid()])

<button 
    x-data="{}"
    x-on:click="$store.sidebar.dropdownOpen['{{ $id }}'] = !$store.sidebar.dropdownOpen['{{ $id }}']" 
    {{ $attributes->merge(['class' => 'flex items-center w-full px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out rounded']) }}
>
    @if (isset($icon))
        <span class="mr-2">{{ $icon }}</span>
    @endif
    <span class="flex-grow text-left">{{ $slot }}</span>
    <svg 
        x-bind:class="{'rotate-180': $store.sidebar.dropdownOpen['{{ $id }}']}"
        class="w-5 h-5 ml-auto transition-transform duration-200" 
        xmlns="http://www.w3.org/2000/svg" 
        fill="none" 
        viewBox="0 0 24 24" 
        stroke="currentColor"
    >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
    </svg>
</button>