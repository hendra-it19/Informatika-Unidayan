@props(['name', 'label', 'value' => null, 'disabled' => false, 'readonly' => false, 'required' => true])

<div>
    <label for="{{ $name }}" class="block mb-1.5 text-sm text-gray-800">
        {{ $label }} @if ($required)
            <span class="text-red-400">*</span>
        @endif
    </label>
    <input type="text" class="hidden" name="{{ $name }}" id="{{ $name }}" value="{{ $value }}"
        {{ $required ? 'required' : '' }} {{ $readonly ? 'required' : '' }} {{ $disabled ? 'required' : '' }}
        @error($name)
            autofocus
        @enderror>
    <trix-editor input="{{ $name }}"
        class="min-h-48 konten @error($name)
        is-invalid
        @else
        input
    @enderror"
        {{ $required ? 'required' : '' }} {{ $readonly ? 'required' : '' }} {{ $disabled ? 'required' : '' }}
        @error($name)
        autofocus
    @enderror></trix-editor>
    @error($name)
        <small class="text-red-500 ml-1 -mt[1px]">
            {{ $message }}
        </small>
    @enderror
</div>


@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/trix/trix.css') }}">
    <script src="{{ asset('vendor/trix/trix.js') }}"></script>
    <style>
        .trix-button-group--file-tools {
            display: none !important;
        }

        .konten {
            font-size: 14px !important;
        }

        .konten ul li {
            list-style-type: disc;
            list-style-position: inside;
        }

        .konten ol li {
            list-style-type: decimal;
            list-style-position: inside;
        }

        #trix-toolbar-1 .trix-button-row span button {
            font-size: 11px !important;
            /* height: 10px !important; */
        }
    </style>
@endpush
