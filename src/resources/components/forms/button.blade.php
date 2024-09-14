@props([
    'id' => '',
    'tag' => 'button',
    'color' => 'btn-primary',
    'class' => '',
    'customClass' => false,
    'isFile' => false,
    'multiple' => false,
    'name' => '',
])


@if ($tag == 'a')
    <a
        {{ $attributes->merge(['class' => !$customClass ? 'btn ' . $color . ' w-24 mr-1 mb-2 ' . $class : $class, 'isFile' => $isFile]) }}>
        {{ $slot }}
    </a>
@else
    <button @if ($isFile) data-file-id="#file-{{ $id }}" @endif
        {{ $attributes->merge(['class' => !$customClass ? 'btn ' . $color . ' w-24 mr-1 mb-2 ' . $class : $class, 'isFile' => $isFile]) }}>
        {{ $slot }}
    </button>
@endif
@if ($isFile)
    <input type="file" class="hidden" id="file-{{ $id }}"
        {{ $attributes->merge(['multiple' => $multiple, 'name' => $name ]) }}  />
@endif
