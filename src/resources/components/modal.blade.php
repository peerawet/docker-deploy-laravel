@props(['title', 'size' => 'xl'])
<!-- BEGIN: Small Modal Content -->
<div class="modal" tabindex="-1" aria-hidden="true" {{ $attributes }}>
    <div class="modal-dialog modal-{{ $size }}">
        <div class="modal-content">
            @if (isset($title))
                <div class="modal-header">
                    <h2 class="font-medium text-base">{{ $title ?? '' }}</h2>
                    <a data-tw-dismiss="modal" aria-label="Close" class="ml-auto">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </a>
                </div>
            @endif
            <div class="modal-body p-10">
                {{ $slot }}
            </div>
            @if (isset($footer))
                <div class="modal-footer">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>
<!-- END: Small Modal Content -->
