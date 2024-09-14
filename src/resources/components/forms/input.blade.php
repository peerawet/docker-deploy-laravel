@props([
    'id' => 'input-id',
    'label' => '',
    'name' => '',
    'type' => 'text',
    'value' => '',
    'lists' => [['id' => 'check-box', 'label' => 'checkbox', 'value' => '']],
    'class' => '',
])

@if ($type == 'checkbox' || $type == 'radio')

    @foreach ($lists as $list)
        <div class="form-check mr-2">
            <input
                {{ $attributes->merge(['id' => $list['id'], 'name' => $name, 'type' => $type, 'class' => 'form-check-input ', 'value' => $list['value']]) }}>
            <label class="form-check-label" {{ $attributes->merge(['for' => $list['id']]) }}>{{ $list['label'] }}</label>
        </div>
    @endforeach
@else
    @if ($label != '')
        <label {{ $attributes->merge(['for' => $id]) }} class="form-label">{{ $label }}</label>
    @endif
    <input
        {{ $attributes->merge(['id' => $id, 'name' => $name, 'type' => $type, 'class' => 'form-control w-full ' . $class, 'placeholder' => $label]) }}>

@endif
