<!-- BEGIN: Mobile Menu -->
<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img alt="Midone - HTML Admin Template" class="w-6" src="{{ asset('dist/images/logo.svg') }}">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler">
            <x-icon name="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"/>
        </a>
    </div>
    <ul class="border-t border-white/[0.08] py-5 hidden">
        @foreach ($side_menu as $menuKey => $menu)
            @if ($menu == 'devider')
                <li class="menu__devider my-6"></li>
            @else
                <li>
                    <a href="{{ isset($menu['route_name']) ? route($menu['route_name'], $menu['params']) : 'javascript:;' }}" class="{{ $first_level_active_index == $menuKey ? 'menu menu--active' : 'menu' }}">
                        <div class="menu__icon">
                            <x-icon name="{{ $menu['icon'] }}"/>
                        </div>
                        <div class="menu__title">
                            {{ $menu['title'] }}
                            @if (isset($menu['sub_menu']))
                                <x-icon name="chevron-down" class="menu__sub-icon {{ $first_level_active_index == $menuKey ? 'transform rotate-180' : '' }}"/>
                            @endif
                        </div>
                    </a>
                    @if (isset($menu['sub_menu']))
                        <ul class="{{ $first_level_active_index == $menuKey ? 'menu__sub-open' : '' }}">
                            @foreach ($menu['sub_menu'] as $subMenuKey => $subMenu)
                                <li>
                                    <a href="{{ isset($subMenu['route_name']) ? route($subMenu['route_name'], $subMenu['params']) : 'javascript:;' }}" class="{{ $second_level_active_index == $subMenuKey ? 'menu menu--active' : 'menu' }}">
                                        <div class="menu__icon">
                                            <x-icon name="activity"/>
                                        </div>
                                        <div class="menu__title">
                                            {{ $subMenu['title'] }}
                                            @if (isset($subMenu['sub_menu']))
                                                <x-icon name="chevron-down" class="menu__sub-icon {{ $second_level_active_index == $subMenuKey ? 'transform rotate-180' : '' }}"/>
                                            @endif
                                        </div>
                                    </a>
                                    @if (isset($subMenu['sub_menu']))
                                        <ul class="{{ $second_level_active_index == $subMenuKey ? 'menu__sub-open' : '' }}">
                                            @foreach ($subMenu['sub_menu'] as $lastSubMenuKey => $lastSubMenu)
                                                <li>
                                                    <a href="{{ isset($lastSubMenu['route_name']) ? route($lastSubMenu['route_name'], $lastSubMenu['params']) : 'javascript:;' }}" class="{{ $third_level_active_index == $lastSubMenuKey ? 'menu menu--active' : 'menu' }}">
                                                        <div class="menu__icon">
                                                            <x-icon name="zap"/>
                                                        </div>
                                                        <div class="menu__title">{{ $lastSubMenu['title'] }}</div>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endif
        @endforeach
    </ul>
</div>
<!-- END: Mobile Menu -->
