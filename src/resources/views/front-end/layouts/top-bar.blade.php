<div class="top-bar">
    <!-- BEGIN: Breadcrumb -->
    <nav aria-label="breadcrumb" class="-intro-x mr-auto hidden sm:flex">
        {{-- <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Application</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol> --}}
    </nav>
    <!-- END: Breadcrumb -->
    <!-- BEGIN: Search -->

    <!-- END: Search -->
    <!-- BEGIN: Notifications -->
    {{-- <div class="intro-x dropdown mr-auto sm:mr-6">
        <div class="dropdown-toggle notification notification--bullet cursor-pointer" role="button"
            aria-expanded="false" data-tw-toggle="dropdown"> <i data-lucide="bell"
                class="notification__icon dark:text-slate-500"></i> </div>
        <div class="notification-content pt-2 dropdown-menu">
            <div class="notification-content__box dropdown-content">
                <div class="notification-content__title">Notifications</div>
                <div class="cursor-pointer relative flex items-center ">
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                        <img alt="Midone - HTML Admin Template" class="rounded-full"
                            src="dist/images/profile-14.jpg">
                        <div
                            class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white dark:border-darkmode-600">
                        </div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                        <div class="flex items-center">
                            <a href="javascript:;" class="font-medium truncate mr-5">Arnold
                                Schwarzenegger</a>
                            <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">01:10 PM</div>
                        </div>
                        <div class="w-full truncate text-slate-500 mt-0.5">Contrary to popular belief,
                            Lorem Ipsum is not simply random text. It has roots in a piece of classical
                            Latin literature from 45 BC, making it over 20</div>
                    </div>
                </div>
                <div class="cursor-pointer relative flex items-center mt-5">
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="dist/images/profile-8.jpg">
                        <div
                            class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white dark:border-darkmode-600">
                        </div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                        <div class="flex items-center">
                            <a href="javascript:;" class="font-medium truncate mr-5">Keira Knightley</a>
                            <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">05:09 AM</div>
                        </div>
                        <div class="w-full truncate text-slate-500 mt-0.5">Contrary to popular belief,
                            Lorem Ipsum is not simply random text. It has roots in a piece of classical
                            Latin literature from 45 BC, making it over 20</div>
                    </div>
                </div>
                <div class="cursor-pointer relative flex items-center mt-5">
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                        <img alt="Midone - HTML Admin Template" class="rounded-full"
                            src="dist/images/profile-10.jpg">
                        <div
                            class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white dark:border-darkmode-600">
                        </div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                        <div class="flex items-center">
                            <a href="javascript:;" class="font-medium truncate mr-5">Johnny Depp</a>
                            <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">05:09 AM</div>
                        </div>
                        <div class="w-full truncate text-slate-500 mt-0.5">There are many variations of
                            passages of Lorem Ipsum available, but the majority have suffered alteration in
                            some form, by injected humour, or randomi</div>
                    </div>
                </div>
                <div class="cursor-pointer relative flex items-center mt-5">
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                        <img alt="Midone - HTML Admin Template" class="rounded-full"
                            src="dist/images/profile-14.jpg">
                        <div
                            class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white dark:border-darkmode-600">
                        </div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                        <div class="flex items-center">
                            <a href="javascript:;" class="font-medium truncate mr-5">Russell Crowe</a>
                            <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">03:20 PM</div>
                        </div>
                        <div class="w-full truncate text-slate-500 mt-0.5">It is a long established fact
                            that a reader will be distracted by the readable content of a page when looking
                            at its layout. The point of using Lorem </div>
                    </div>
                </div>
                <div class="cursor-pointer relative flex items-center mt-5">
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="dist/images/profile-2.jpg">
                        <div
                            class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white dark:border-darkmode-600">
                        </div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                        <div class="flex items-center">
                            <a href="javascript:;" class="font-medium truncate mr-5">Keanu Reeves</a>
                            <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">01:10 PM</div>
                        </div>
                        <div class="w-full truncate text-slate-500 mt-0.5">There are many variations of
                            passages of Lorem Ipsum available, but the majority have suffered alteration in
                            some form, by injected humour, or randomi</div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- END: Notifications -->
    <!-- BEGIN: Account Menu -->
    <div class="intro-x dropdown w-8 h-8">
        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in" role="button"
            aria-expanded="false" data-tw-toggle="dropdown">
            <img alt="Midone - HTML Admin Template" src="{{ asset('assets/images/[Logo]_Express_Intertrade.jpg') }}">
        </div>
        <div class="dropdown-menu w-56">
            <ul class="dropdown-content bg-primary text-white">
                <li class="p-2">
                    <div class="font-medium">ชื่อ : {{ Auth::user()->name }}</div>
                    <div class="text-xs text-white/70 mt-0.5 dark:text-slate-500">Username :
                        {{ Auth::user()->username }}
                    </div>
                </li>
                <li>
                    <hr class="dropdown-divider border-white/[0.08]">
                </li>


                <li>
                    <a href="{{ route('logout') }}" class="dropdown-item hover:bg-white/5"> <i
                            data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Account Menu -->
</div>
