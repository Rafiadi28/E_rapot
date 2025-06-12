@props(['id' => uniqid()])

<div 
    x-data="{}"
    x-show="$store.sidebar.dropdownOpen['{{ $id }}'] || false"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 transform scale-95"
    x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 transform scale-100"
    x-transition:leave-end="opacity-0 transform scale-95"
    class="ml-4 space-y-1 mt-1 mb-2"
    style="display: none;"
>
    {{ $slot }}
</div>