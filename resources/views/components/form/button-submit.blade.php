@props([
    'label' => 'label',
])
<button type="submit"
    class="py-1.5 px-8 text-sm text-white bg-primary-500 hover:bg-primary-600 outline-none focus:outline-none focus:ring-2 focus:ring-primary-200 rounded active:outline-none active:border-none">
    {{ $label }}
</button>
