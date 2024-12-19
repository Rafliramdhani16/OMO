@props(['type' => 'text', 'name', 'placeholder', 'icon'])

<div x-data="{ 
    focused: false,
    passwordShown: false,
    inputType: '{{ $type }}'
}" class="relative">
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-{{ $icon }} text-gray-400"></i>
        </div>
        
        <input 
            x-ref="input"
            type="{{ $type }}"
            x-bind:type="inputType === 'password' ? (passwordShown ? 'text' : 'password') : inputType"
            name="{{ $name }}"
            id="{{ $name }}"
            placeholder="{{ $placeholder }}"
            @focus="focused = true"
            @blur="focused = false"
            {{ $attributes->merge([
                'class' => 'w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50'
            ]) }}
        >
        
        @if($type === 'password')
            <button 
                type="button"
                class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer text-gray-400 hover:text-gray-600 transition-colors duration-200"
                @click="passwordShown = !passwordShown"
            >
                <div class="relative w-5 h-5">
                    <div class="absolute inset-0 transition-opacity duration-200"
                         :class="passwordShown ? 'opacity-0' : 'opacity-100'">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 5.25C4.5 5.25 1.5 12 1.5 12C1.5 12 4.5 18.75 12 18.75C19.5 18.75 22.5 12 22.5 12C22.5 12 19.5 5.25 12 5.25Z" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="absolute inset-0 transition-opacity duration-200"
                         :class="passwordShown ? 'opacity-100' : 'opacity-0'">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 12C20 12 17.5 18 12 18C6.5 18 4 12 4 12C4 12 6.5 6 12 6C17.5 6 20 12 20 12Z" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M3 21L21 3" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
            </button>
        @endif
    </div>


    @error($name)
        <div class="mt-2 flex items-center text-sm text-red-600 space-x-1">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ $message }}</span>
        </div>
    @enderror
</div>