<button type="{{ $type }}" class="btn btn-{{ $color }} w-36 mr-2 mb-2"
    @if ($action) wire:click="{{ $action }}" @endif>
    <i data-lucide="{{ $icon }}" class="w-4 h-4 mr-2"></i>
    {{ $title }}</button>
