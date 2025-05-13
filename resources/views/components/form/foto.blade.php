@props([
    'label',
    'name',
    'placeholder',
    'disabled' => false,
    'readonly' => false,
    'required' => false,
    'foto' => null,
])
<div>
    <label for="{{ $name }}" class="text-gray-700 mb-1 inline-block text-sm font-semibold">{{ $label }}
        @if ($required)
            <span class="text-red-400">*</span>
        @endif
    </label>
    <div class="flex items-center justify-center aspect-square mb-3">
        <label for="{{ $name }}" id="foto-preview"
            class="flex flex-col items-center justify-center w-full h-full border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 hover:bg-gray-100 @error($name)
                            border-red-300
                        @else
                            border-gray-300
                        @enderror">
            <div class="flex flex-col items-center justify-center pt-5 pb-6 w-full h-full bg-gray-200 bg-opacity-30">
                <svg class="w-8 h-8 mb-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                </svg>
                <p class="mb-2 text-xs lg:text-sm text-gray-800 text-wrap"><span class="font-semibold">
                        Klik untuk upload </span></p>
                <p class="text-xs text-gray-800">
                    {{ $placeholder }}
                </p>
            </div>
            <input id="{{ $name }}" type="file" class="hidden" accept="image/*" name="{{ $name }}"
                {{ $required ? 'required' : '' }} />
        </label>
    </div>
    @error($name)
        <small class="text-red-500 ml-2 block -mt-[1px]">{{ $message }}</small>
    @enderror
</div>

@push('js')
    <script>
        const input = document.getElementById('foto');
        const preview = document.getElementById('foto-preview');
        preview.style.backgroundImage = `url('{{ asset($foto) }}')`;
        preview.style.backgroundPosition = 'center';
        preview.style.backgroundSize = 'cover';
        const previewPhoto = () => {
            const file = input.files;
            if (file) {
                const fileReader = new FileReader();
                fileReader.onload = function(event) {
                    preview.setAttribute('src', event.target.result);
                    preview.style.backgroundImage = `url('${event.target.result}')`;
                    preview.style.backgroundPosition = 'center';
                    preview.style.backgroundSize = 'cover';
                }
                fileReader.readAsDataURL(file[0]);
            }
        }
        input.addEventListener("change", previewPhoto);
    </script>
@endpush
