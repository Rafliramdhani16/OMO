@props(['type' => 'submit'])

<button 
    type="{{ $type }}"
    {{ $attributes->merge([
        'class' => 'w-full bg-blue-500 text-white px-6 py-3 rounded-lg button-hover transition-all duration-300 focus:outline-none focus:ring-offset-2 hover:bg-blue-600 active:bg-blue-700 disabled:opacity-70 disabled:cursor-not-allowed flex items-center justify-center space-x-2'
    ]) }}
>
    {{ $slot }}
</button>