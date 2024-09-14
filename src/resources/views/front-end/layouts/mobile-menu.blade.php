<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img alt="Midone - HTML Admin Template" class="w-6" src="dist/images/logo.svg">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-lucide="bar-chart-2"
                class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-white/[0.08] py-5 hidden">
        @foreach ($menus as $menu)
            @php
                $isActive =
                    isset($menu['submenu']) &&
                    collect($menu['submenu'])->contains(function ($submenu) {
                        return request()->routeIs($submenu['route']);
                    });
            @endphp
             <li>
                <a href="javascript:;" class="side-menu {{ $isActive ? 'side-menu--active ' : '' }}">
                    <div class="side-menu__icon"> <i data-lucide="{{ $menu['icon'] }}"></i> </div>
                    <div class="side-menu__title">
                        {{ $menu['title'] }}
                        @if (!empty($menu['submenu']))
                            <div class="side-menu__sub-icon"> <i data-lucide="chevron-down"></i> </div>
                        @endif
                    </div>
                </a>
                @if (!empty($menu['submenu']))
                    <ul class="{{ $isActive ? 'side-menu--active side-menu__sub-open' : '' }}">
                        @foreach ($menu['submenu'] as $submenu)
                            <li>
                                <a href="{{ $submenu['route'] != '#' ? route($submenu['route']) : 'javascript:;' }}"
                                    class="side-menu {{ request()->routeIs($submenu['route']) ? 'side-menu--active' : '' }}">
                                    <div class="menu__icon"> <i data-lucide="{{ $submenu['icon'] }}"></i> </div>
                                    <div class="menu__title"> {{ $submenu['title'] }} </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
            {{-- <li>
                <a href="javascript:;" class="menu">
                    <div class="menu__icon"> <i data-lucide="home"></i> </div>
                    <div class="menu__title"> Dashboard <i data-lucide="chevron-down" class="menu__sub-icon "></i>
                    </div>
                </a>
                <ul class="">
                    <li>
                        <a href="index.html" class="menu">
                            <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                            <div class="menu__title"> Overview 1 </div>
                        </a>
                    </li>
                    <li>
                        <a href="side-menu-light-dashboard-overview-2.html" class="menu">
                            <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                            <div class="menu__title"> Overview 2 </div>
                        </a>
                    </li>
                    <li>
                        <a href="side-menu-light-dashboard-overview-3.html" class="menu">
                            <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                            <div class="menu__title"> Overview 3 </div>
                        </a>
                    </li>
                    <li>
                        <a href="side-menu-light-dashboard-overview-4.html" class="menu">
                            <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                            <div class="menu__title"> Overview 4 </div>
                        </a>
                    </li>
                </ul>
            </li> --}}
        @endforeach
    </ul>
</div>
