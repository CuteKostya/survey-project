@props(['type' => 'checkbox', 'name'=>'', 'value' => ''])

<x-input {{ $attributes->merge([
    'type' => $type,
    'name' => $name,
    'value' => $value,
]) }} />

<x-label>
    {{ $slot }}
</x-label>
