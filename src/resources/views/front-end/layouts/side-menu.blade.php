<style>
    .side-nav {
        width: 200px;
        overflow-x: hidden;
        padding-right: 1.25rem;
        padding-bottom: 4rem;
    }

    @media (max-width: calc(1280px - 1px)) {
        .side-nav {
            width: 85px
        }
    }
</style>
<nav class="side-nav">
    <a href="{{ route('home') }}" class="intro-x flex items-center pl-5 pt-4">
        <img alt="Midone - HTML Admin Template" class="w-6" src="{{ asset('assets/images/logo.svg') }}">
        <span class="hidden xl:block text-white text-lg ml-3"> <b>Express Intertrade</b> </span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        @foreach ($menus as $menu)
            {{-- Determine if any submenu is active --}}
            @php
                $isActive =
                    isset($menu['submenus']) &&
                    collect($menu['submenus'])->contains(function ($submenu) {
                        return request()->routeIs($submenu['route']);
                    });
            @endphp
            <li>
                <a href="javascript:;" class="side-menu {{ $isActive ? 'side-menu--active ' : '' }}">
                    <div class="side-menu__icon"> <i data-lucide="{{ $menu['icon'] }}"></i> </div>
                    <div class="side-menu__title">
                        {{ $menu['title'] }}
                        @if (!empty($menu['submenus']))
                            <div class="side-menu__sub-icon"> <i data-lucide="chevron-down"></i> </div>
                        @endif
                    </div>
                </a>
                @if (!empty($menu['submenus']))
                    <ul class="{{ $isActive ? 'side-menu--active side-menu__sub-open' : '' }}">
                        @foreach ($menu['submenus'] as $submenu)
                            <li>
                                <a href="{{ $submenu['route'] != '#' ? route($submenu['route']) : 'javascript:;' }}"
                                    class="side-menu {{ request()->routeIs($submenu['route']) ? 'side-menu--active' : '' }}">
                                    <div class="side-menu__icon"> <i data-lucide="{{ $submenu['icon'] }}"></i> </div>
                                    <div class="side-menu__title"> {{ $submenu['title'] }} </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
    <div class="side-nav__devider my-6"></div>
    <ul class="">




        <li>
            <a href="{{ route('logout') }}" class="side-menu">
                <div class="side-menu__icon"> <i data-lucide="log-out"></i> </div>
                <div class="side-menu__title">Logout</div>
            </a>

        </li>
        <li class="nav-item">
            <div class="side-menu">
                <div class="form-check form-switch">
                    <input id="toggleZoom" class="form-check-input" type="checkbox" role="switch">
                    <label class="form-check-label" for="toggleZoom">Toggle Zoom</label>
                </div>
            </div>
        </li>

        <script>
            // jQuery ready shorthand
            jQuery(function($) {
                // Retrieve zoom state from localStorage
                var zoomEnabled = localStorage.getItem('zoomEnabled') === 'true';

                // Function to toggle zoom
                function toggleZoom() {
                    if (zoomEnabled) {
                        $('body').addClass('zoom-80');
                        $('#toggleZoom').prop('checked', true);
                    } else {
                        $('body').removeClass('zoom-80');
                        $('#toggleZoom').prop('checked', false);
                    }
                }

                // Toggle zoom when checkbox changes
                $('#toggleZoom').change(function() {
                    zoomEnabled = $(this).prop('checked');
                    localStorage.setItem('zoomEnabled', zoomEnabled);
                    toggleZoom();
                });

                // Initialize zoom state
                toggleZoom();
            });
        </script>

    </ul>
</nav>
