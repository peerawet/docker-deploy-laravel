@props([
    'type' => 'single',
    'setup' => '',
    'class' => 'form-control w-56 block mr-2',
])


<input x-ref="litepicker" type="text" x-init="new Litepicker({
    element: $refs.litepicker,
    ...config_datepicker.{{ $type }},
    setup: (picker) => {
        config_datepicker.range.setup(picker);
        {{ $setup }}
    },
});" {{ $attributes->merge(['class' => $class]) }} />
