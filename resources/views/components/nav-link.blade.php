@props(['active' => false])

<a class="{{ $active ? 'border-b-orange-800 hover:border-b-orange-700' : 'border-transparent' }} 
           text-lg pb-1 border-b-2 
           transition-all duration-75 hover:text-red-600  font-semibold"
    {{ $attributes }} aria-current="{{ $active ? 'page' : 'false' }}">
    {{ $slot }}
</a>
