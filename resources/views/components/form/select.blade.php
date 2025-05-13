@props([
    'name',
    'label',
    'value' => null,
    'placeholder',
    'disabled' => false,
    'readonly' => false,
    'required' => true,
])
<div>
    <label for="{{ $name }}" class="block mb-1.5 text-sm text-gray-700">
        <span>{{ $label }}</span>
        @if ($required)
            <span class="text-red-400">*</span>
        @endif
    </label>
    <div class="flex h-fit">
        <button
            class="flex-shrink-0 z-10 inline-flex items-center py-2 px-3 text-sm text-center text-gray-500 bg-gray-50 border rounded-s border-r-0 border-gray-300"
            type="button">
            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                    d="M5 6a1 1 0 0 1 1-1h12a1 1 0 1 1 0 2H6a1 1 0 0 1-1-1Zm0 12a1 1 0 0 1 1-1h12a1 1 0 1 1 0 2H6a1 1 0 0 1-1-1Zm3.85-9.76A1 1 0 0 1 10.5 9v6a1 1 0 0 1-1.65.76l-3.5-3a1 1 0 0 1 0-1.52l3.5-3ZM12 10a1 1 0 0 1 1-1h5a1 1 0 1 1 0 2h-5a1 1 0 0 1-1-1Zm0 4a1 1 0 0 1 1-1h5a1 1 0 1 1 0 2h-5a1 1 0 0 1-1-1Z"
                    clip-rule="evenodd" />
            </svg>
        </button>
        <label for="{{ $name }}" class="sr-only">Choose a state</label>
        <select id="{{ $name }}" name="{{ $name }}"
            class="bg-gray-50 border text-gray-900 text-sm rounded-e border-s-gray-100 border-s-2 block w-full py-1.5 lg:py-2 px-2.5 border-l-0 cursor-pointer
            @error($name)
            focus:ring-red-500 focus:border-red-500 border-red-300
            @else
            focus:ring-primary-500 focus:border-primary-500 border-gray-300
            @enderror"
            placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }} {{ $readonly ? 'readonly' : '' }}
            {{ $disabled ? 'disabled' : '' }} @error($name)
                autofocus
            @enderror>
            <option value="">{{ $placeholder }}</option>
            {{ $slot }}
        </select>
    </div>
    @error($name)
        <small class="text-red-500 text-xs ml-2 -mt-[1px] block">{{ $message }}</small>
    @enderror
</div>
