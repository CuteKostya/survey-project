@props(['color' => 'successcol', 'size' => ''])

<button {{ $attributes->class([
    "btn btn-{$color}", ($size ? "btn-{$size}" : ''),
])->merge([
    'type' => 'button',
]) }}>
    {{ $slot }}
</button>
