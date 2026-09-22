@props(['href', 'text'])

<li>
    <a href="{{ $href }}"
       class="py-2 px-4 text-sm font-semibold text-blue-800 rounded-lg transition-all duration-200 hover:bg-blue-100 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 block w-full"
       {{ $attributes }}>
        {{ $text }}
    </a>
</li>
