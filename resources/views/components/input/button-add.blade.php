@props(['text'])

<button type="button"
    class="text-white w-fit h-fit bg-primary-500 hover:bg-primary-600 focus:ring-4 focus:outline-none focus:ring-primary-200 font-medium rounded text-sm px-1 py-2.5 sm:px-3 sm:py-1 text-center flex justify-center items-center me-1">
    {{ $slot }}
    <span class="hidden sm:inline-block">{{ $text }}</span>
</button>
