<!DOCTYPE html>
<html lang="en" class="light">
<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <link href="{{ asset('asset/images/small_logo.svg') }}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="LEFT4CODE">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-xrR5l42Dv4odaiWAx7akuplGX9tmdPfFNsTUepQy2OVXB1qP6vkgf2HuBRgx/Y98tLTA8Hp1LlYwtsOqkcZ+lw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sortablejs/1.14.0/Sortable.min.css">


    <title>@yield('Dashboard')</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ asset('asset/css/app.css') }}" />
    <!-- END: CSS Assets-->
    <style>
        #stars[disabled] option[value=""] {
            color: black !important;
        }

        .side-menu li.active {
            background-color: red;
        }

        .description-popup {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            display: none;
        }
    </style>
</head>
<!-- END: Head -->

<body class="py-5 md:py-0">
    <!-- BEGIN: Mobile Menu -->
    <div class="mobile-menu md:hidden">
        <div class="mobile-menu-bar">
            <a href="{{ url('/dashboard') }}" class="flex mr-auto">
                <img alt="Logo" class="w-6" src="{{ asset('asset/images/small_logo.svg') }}">
            </a>
            <a href="javascript:;" class="mobile-menu-toggler"> <i data-lucide="bar-chart-2"
                    class="w-8 h-8 text-white transform -rotate-90"></i> </a>
        </div>
        <div class="scrollable">
            <a href="javascript:;" class="mobile-menu-toggler"> <i data-lucide="x-circle"
                    class="w-8 h-8 text-white transform -rotate-90"></i> </a>
            <ul class="scrollable__content py-2">
                <?php
                $permissions = session('permissions');
                if ($permissions != '') {
                    $userPermissions = explode(',', $permissions);
                } else {
                    $userPermissions = [];
                }
                ?>
                <ul>
                    @if (session('role') == 'admin' || in_array('Dashboard', $userPermissions))
                        <li>
                            <a href="{{ url('/dashboard') }}"
                                class="menu {{ Request::is('dashboard') ? 'side-menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="home"></i> </div>
                                <div class="menu__title"> Dashboard </div>
                            </a>
                        </li>
                    @endif
                    @if (session('role') == 'admin' || in_array('Countries', $userPermissions))
                        <li> <a href="{{ url('/admin-countries') }}"
                                class="menu {{ Request::is('admin-countries*') ? 'side-menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="globe"></i> </div>
                                <div class="menu__title"> Conutries </div>
                            </a>
                        </li>
                    @endif
                    @if (session('role') == 'admin')
                        <li>
                            <a href="{{ url('/sub-admin') }}"
                                class="menu {{ Request::is('sub-admin*') ? 'side-menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="shield"></i> </div>
                                <div class="menu__title"> Sub Admin </div>
                            </a>
                        </li>
                    @endif
                    @if (session('role') == 'admin' || in_array('Classified_Categories', $userPermissions))
                        <li>
                            <a href="{{ url('/category') }}"
                                class="menu {{ Request::is('category*') ? 'side-menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="plus"></i> </div>
                                <div class="menu__title">Classified Categories </div>
                            </a>
                        </li>
                    @endif
                    @if (session('role') == 'admin' || in_array('Classified', $userPermissions))
                        <li>
                            <a href="#"
                                class="menu {{ Str::startsWith(Request::url(), url('/show-classifer-')) ? 'side-menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="shopping-bag"></i> </div>
                                <div class="menu__title">
                                    Classifieds
                                    <div class="menu__sub-icon transform rotate-180"> <i
                                            data-lucide="more-vertical"></i>
                                    </div>
                                </div>
                            </a>
                            <ul class="menu__sub">
                                <li>
                                    <a href="{{ url('/show-classifer-Events') }}"
                                        class="menu {{ Request::is('show-classifer-Events*') ? 'side-menu--active' : '' }}">
                                        <div class="menu__icon"> <i data-lucide="corner-down-right"></i> </div>
                                        <div class="menu__title">Events</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/show-classifer-IT_Training') }}"
                                        class="menu {{ Request::is('show-classifer-IT_Training*') ? 'side-menu--active' : '' }}">
                                        <div class="menu__icon"> <i data-lucide="corner-down-right"></i> </div>
                                        <div class="menu__title">IT Training</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/show-classifer-Jobs') }}"
                                        class="menu {{ Request::is('show-classifer-Jobs*') ? 'side-menu--active' : '' }}">
                                        <div class="menu__icon"> <i data-lucide="corner-down-right"></i> </div>
                                        <div class="menu__title">Jobs</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/show-classifer-Roomates&Rental') }}"
                                        class="menu {{ Request::is('show-classifer-Roomates&Rental*') ? 'side-menu--active' : '' }}">
                                        <div class="menu__icon"> <i data-lucide="corner-down-right"></i> </div>
                                        <div class="menu__title">Roomates & Rentals</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/show-classifer-Services') }}"
                                        class="menu {{ Request::is('show-classifer-Services*') ? 'side-menu--active' : '' }}">
                                        <div class="menu__icon"> <i data-lucide="corner-down-right"></i> </div>
                                        <div class="menu__title">Services</div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if (session('role') == 'admin' || in_array('Advertisment', $userPermissions))
                       
                        <li>
                            <a href="{{ url('/countryAdvertisment') }}"
                                class="menu {{ Str::startsWith(Request::url(), url('/product-ads')) ||    Str::startsWith(Request::url(), url('/countryAdvertisment')) ||  Str::startsWith(Request::url(), url('/ad-create')) ? 'side-menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="monitor"></i> </div>
                                <div class="menu__title">Advertisment</div>
                            </a>
                            
                    @endif
                    @if (session('role') == 'admin' || in_array('Payment_Plans', $userPermissions))
                        <li> <a href="{{ url('/payment-plans') }}"
                                class="menu {{ Str::startsWith(Request::url(), url('/payment-plans')) || Str::startsWith(Request::url(), url('/payment-plans')) ? 'side-menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="dollar-sign"></i> </div>
                                <div class="menu__title"> Payment Plans </div>
                            </a>
                        </li>
                    @endif
                    @if (session('role') == 'admin' || in_array('Users', $userPermissions))
                        <li>
                            <a href="{{ url('/users') }}"
                                class="menu {{ Request::is('users*') ? 'side-menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="users"></i> </div>
                                <div class="menu__title"> Users </div>
                            </a>
                        </li>
                    @endif
                    @if (session('role') == 'admin' || in_array('Forum', $userPermissions))
                        <li>
                            <a href="#"
                                class="menu {{ Str::startsWith(Request::url(), url('/type-forums')) || Str::startsWith(Request::url(), url('/forum-category')) ? 'side-menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="list"></i> </div>
                                <div class="menu__title">
                                    Forum
                                    <div class="menu__sub-icon transform rotate-180"> <i
                                            data-lucide="more-vertical"></i>
                                    </div>
                                </div>
                            </a>
                            <ul class="menu__sub">
                                <li>
                                    <a href="{{ url('/type-forums') }}"
                                        class="menu {{ Request::is('type-forums*') ? 'side-menu--active' : '' }}">
                                        <div class="menu__icon"> <i data-lucide="corner-down-right"></i> </div>
                                        <div class="menu__title">Forums</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/forum-category') }}"
                                        class="menu {{ Str::startsWith(Request::url(), url('/forum-category')) || Str::startsWith(Request::url(), url('/forum')) ? 'side-menu--active' : '' }}">
                                        <div class="menu__icon"> <i data-lucide="corner-down-right"></i> </div>
                                        <div class="menu__title"> Forum Category </div>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    @endif
                    @if (session('role') == 'admin' || in_array('Confession', $userPermissions))
                        <li>
                            <a href="{{ url('/type-confessions') }}"
                                class="menu {{ Request::is('type-confessions*') ? 'side-menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="message-square"></i> </div>
                                <div class="menu__title">Confession</div>
                            </a>
                        </li>
                    @endif
                    @if (session('role') == 'admin' || in_array('Blogs', $userPermissions))
                        <li>
                            <a href="{{ url('/blogs') }}"
                                class="menu {{ Str::startsWith(Request::url(), url('/blogs')) || Str::startsWith(Request::url(), url('/blog-view')) ? 'side-menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="inbox"></i> </div>
                                <div class="menu__title"> Blogs </div>
                            </a>
                        </li>
                    @endif
                    @if (session('role') == 'admin' || in_array('FAQS', $userPermissions))
                        <li> <a href="{{ url('/faqs') }}"
                                class="menu {{ Request::is('faqs*') ? 'side-menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="help-circle"></i> </div>
                                <div class="menu__title"> FAQs </div>
                            </a>
                        </li>
                    @endif
                    @if (session('role') == 'admin' || in_array('Static_Page', $userPermissions))
                        <li> <a href="{{ url('/static-page') }}"
                                class="menu {{ Request::is('static-page*') ? 'side-menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="anchor"></i> </div>
                                <div class="menu__title"> Static Page </div>
                            </a>
                        </li>
                    @endif
                    @if (session('role') == 'admin' || in_array('Testimonials', $userPermissions))
                        <li> <a href="{{ url('/testimonials') }}"
                                class="menu {{ Request::is('testimonials*') ? 'side-menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="smile"></i> </div>
                                <div class="menu__title"> Testimonials </div>
                            </a>
                        </li>
                    @endif
                    @if (session('role') == 'admin' || in_array('Google_Ads', $userPermissions))
                        <li>
                            <a href="{{ url('/google-ads') }}"
                                class="menu {{ Request::is('google-ads*') ? 'side-menu--active' : '' }}">
                                <div class="menu__icon"> <i class="fa-brands fa-google"></i> </div>
                                <div class="menu__title"> Google Ads </div>
                            </a>
                        </li>
                    @endif
                    @if (session('role') == 'admin' || in_array('Email_Templates', $userPermissions))
                        <li>
                            <a href="{{ url('/email-templates') }}"
                                class="menu {{ Request::is('email-templates*') ? 'side-menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="at-sign"></i> </div>
                                <div class="menu__title"> Email Templates </div>
                            </a>
                        </li>
                    @endif
                    @if (session('role') == 'admin' || in_array('All_Comments', $userPermissions))
                        <li>
                            <a href="{{ url('/all-comments') }}"
                                class="menu {{ Request::is('all-comments*') ? 'side-menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="message-square"></i> </div>
                                <div class="menu__title"> All Comments </div>
                            </a>
                        </li>
                    @endif
                    @if (session('role') == 'admin' || in_array('Coupons', $userPermissions))
                        <li>
                            <a href="{{ url('/coupons') }}"
                                class="menu {{ Request::is('coupons*') ? 'side-menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="percent"></i> </div>
                                <div class="menu__title"> Coupons </div>
                            </a>
                        </li>
                    @endif
                    @if (session('role') == 'admin' || in_array('Notifications', $userPermissions))
                        <li>
                            <a href="{{ url('/notifications') }}"
                                class="menu {{ Request::is('notifications*') ? 'side-menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="bell"></i> </div>
                                <div class="menu__title"> Notifications </div>
                            </a>
                        </li>
                    @endif
                    @if (session('role') == 'admin' || in_array('Settings', $userPermissions))
                        <li>
                            <a href="{{ url('/setting') }}"
                                class="menu {{ Request::is('setting*') ? 'side-menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="settings"></i> </div>
                                <div class="menu__title"> Settings </div>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('reset_password') }}"
                            class="menu {{ Request::is('reset_password*') ? 'side-menu--active' : '' }}">
                            <div class="menu__icon"> <i data-lucide="lock"></i> </div>
                            <div class="menu__title"> Change Password </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/manage-profile') }}"
                            class="menu {{ Request::is('manage-profile*') ? 'side-menu--active' : '' }}">
                            <div class="menu__icon"> <i data-lucide="user"></i> </div>
                            <div class="menu__title"> Manage Profile </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/logout') }}" class="menu">
                            <div class="menu__icon"> <i data-lucide="toggle-right"></i> </div>
                            <div class="menu__title"> Logout </div>
                        </a>
                    </li>
                </ul>
            </ul>
        </div>
    </div>
    <!-- END: Mobile Menu -->
    <!-- BEGIN: Top Bar -->
    <div
        class="top-bar-boxed h-[70px] md:h-[65px] z-[51] border-b border-white/[0.08] mt-12 md:mt-0 -mx-3 sm:-mx-8 md:-mx-0 px-3 md:border-b-0 relative md:fixed md:inset-x-0 md:top-0 sm:px-8 md:px-10 md:pt-10 md:bg-gradient-to-b md:from-slate-100 md:to-transparent dark:md:from-darkmode-700">
        <div class="h-full flex items-center">
            <!-- BEGIN: Logo -->
            <a href="" class="logo -intro-x hidden md:flex xl:w-[180px] block">
                <img alt="" class="logo__image" src="{{ $setting->site_logo }}">
            </a>
            <!-- END: Logo -->
            <!-- BEGIN: Breadcrumb -->
            <nav aria-label="breadcrumb" class="-intro-x h-[45px] mr-auto">
                {{-- <ol class="breadcrumb breadcrumb-light">
                    <li class="breadcrumb-item"><a href="#">Application</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol> --}}
            </nav>
            <!-- END: Breadcrumb -->
            <!-- BEGIN: Search -->
            {{-- <div class="intro-x relative mr-3 sm:mr-6">
                <div class="search hidden sm:block">
                    <input type="text" class="search__input form-control border-transparent"
                        placeholder="Search...">
                    <i data-lucide="search" class="search__icon dark:text-slate-500"></i>
                </div>
                <a class="notification notification--light sm:hidden" href=""> <i data-lucide="search"
                        class="notification__icon dark:text-slate-500"></i> </a>

            </div> --}}
            <!-- END: Search -->

            <!-- BEGIN: Account Menu -->
            <?php
            $permissions = session('permissions');
            if ($permissions != '') {
                $userPermissions = explode(',', $permissions);
            } else {
                $userPermissions = [];
            }
            ?>
            @if (session('role') == 'admin' || in_array('Notifications', $userPermissions))

                @php
                    $unreadNotifications = $notifications->where('read', 0);
                    $hasUnreadNotifications = $unreadNotifications->isNotEmpty();
                    $lastFiveUnreadNotifications = $unreadNotifications->reverse()->take(5);
                @endphp
                <div class="intro-x dropdown mr-4 sm:mr-6">
                    <div class="dropdown-toggle notification cursor-pointer" role="button" aria-expanded="false"
                        data-tw-toggle="dropdown">
                        <i data-lucide="bell"
                            class="notification__icon {{ $hasUnreadNotifications ? 'text-red-500' : 'dark:text-slate-500' }}"></i>
                    </div>
                    <div class="notification-content pt-2 dropdown-menu">
                        <div class="notification-content__box dropdown-content" style="width: 250px">
                            <div class="notification-content__title">Notifications</div>
                            @if ($hasUnreadNotifications)
                                @foreach ($lastFiveUnreadNotifications as $notification)
                                    <div class="overflow-hidden">
                                        <div class="flex items-center">
                                            <div class="text-xs text-slate-400 whitespace-nowrap">
                                                {{ $notification->created_at->format('h:i A') }}
                                            </div>
                                        </div>
                                        <div class="truncate text-slate-500 mt-0.5" style="width: 200px">
                                            {{ $notification->content }}
                                        </div>
                                    </div>
                                    <br>
                                @endforeach
                            @else
                                <div class="text-slate-500 text-center mt-2">No Unread Notification</div>
                            @endif
                            <hr style="width: 100%; color: rgb(0, 0, 0)">
                            <a href="{{ url('/notifications') }}"
                                style="color:black;display:flex;justify-content:center; margin-top:15px">View all
                                notifications</a>
                        </div>
                    </div>
                </div>
            @endif
            <div class="intro-x dropdown w-8 h-8">
                <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110"
                    role="button" aria-expanded="false" data-tw-toggle="dropdown">
                    <img alt="profile" style="background-color: white" src="{{ $admin->admin_profile_pic }}">
                </div>
                <div class="dropdown-menu w-56">
                    <ul
                        class="dropdown-content bg-primary/80 before:block before:absolute before:bg-black before:inset-0 before:rounded-md before:z-[-1] text-white">
                        <li class="p-2">
                            <i>
                                <div class="font-medium text-white dark:text-slate-500">
                                    @if (is_null($admin))
                                        Go to Manage Profile to Add Name
                                    @elseif (empty($admin->name))
                                        Go to Manage Profile to Add Name
                                    @else
                                        {{ $admin->name }}
                                    @endif
                                </div>
                            </i>
                            <div class="text-xs text-white/60 mt-0.5 dark:text-slate-500">{{ $admin->username }}</div>
                        </li>
                        <li>
                            <hr class="dropdown-divider border-white/[0.08]">
                        </li>

                        <li>
                            <a href="{{ url('/manage-profile') }}" class="dropdown-item hover:bg-white/5"> <i
                                    data-lucide="user" class="w-4 h-4 mr-2"></i>Manage Profile </a>
                        </li>
                        <?php
                        $permissions = session('permissions');
                        if ($permissions != '') {
                            $userPermissions = explode(',', $permissions);
                        } else {
                            $userPermissions = [];
                        }
                        ?>
                        @if (session('role') == 'admin' || in_array('Settings', $userPermissions))
                            <li>
                                <a href="{{ url('/setting') }}" class="dropdown-item hover:bg-white/5"> <i
                                        data-lucide="settings" class="w-4 h-4 mr-2"></i>Settings </a>
                            </li>
                        @endif
                        <a href="{{ route('reset_password') }}" class="dropdown-item hover:bg-white/5">
                            <i data-lucide="lock" class="w-4 h-4 mr-2"></i>Change Password
                        </a>
                        <li>
                            <hr class="dropdown-divider border-white/[0.08]">
                        </li>
                        <li>
                            <a href="{{ url('/logout') }}" class="dropdown-item hover:bg-white/5"> <i
                                    data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- END: Account Menu -->
        </div>
    </div>
    <!-- END: Top Bar -->
    <div class="flex overflow-hidden">
        <!-- BEGIN: Side Menu -->
        <nav class="side-nav">
            <?php
            $permissions = session('permissions');
            if ($permissions != '') {
                $userPermissions = explode(',', $permissions);
            } else {
                $userPermissions = [];
            }
            ?>
            <ul>
                @if (session('role') == 'admin' || in_array('Dashboard', $userPermissions))
                    <li>
                        <a href="{{ url('/dashboard') }}"
                            class="side-menu {{ Request::is('dashboard') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                            <div class="side-menu__title"> Dashboard </div>
                        </a>
                    </li>
                @endif
                @if (session('role') == 'admin' || in_array('Countries', $userPermissions))
                    <li> <a href="{{ url('/admin-countries') }}"
                            class="side-menu {{ Request::is('admin-countries*') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon"> <i data-lucide="globe"></i> </div>
                            <div class="side-menu__title"> Conutries </div>
                        </a>
                    </li>
                @endif
                @if (session('role') == 'admin')
                    <li>
                        <a href="{{ url('/sub-admin') }}"
                            class="side-menu {{ Request::is('sub-admin*') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon"> <i data-lucide="shield"></i> </div>
                            <div class="side-menu__title"> Sub Admin </div>
                        </a>
                    </li>
                @endif
                @if (session('role') == 'admin' || in_array('Classified_Categories', $userPermissions))
                    <li>
                        <a href="{{ url('/category') }}"
                            class="side-menu {{ Request::is('category*') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon"> <i data-lucide="plus"></i> </div>
                            <div class="side-menu__title">Classified Categories </div>
                        </a>
                    </li>
                @endif
                @if (session('role') == 'admin' || in_array('Classified', $userPermissions))
                    <li>
                        <a href="#"
                            class="side-menu {{ Str::startsWith(Request::url(), url('/show-classifer-')) ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon"> <i data-lucide="shopping-bag"></i> </div>
                            <div class="side-menu__title">
                                Classifieds
                                <div class="side-menu__sub-icon transform rotate-180"> <i
                                        data-lucide="more-vertical"></i>
                                </div>
                            </div>
                        </a>
                        <ul class="side-menu__sub">
                            <li>
                                <a href="{{ url('/show-classifer-Events') }}"
                                    class="side-menu {{ Request::is('show-classifer-Events*') ? 'side-menu--active' : '' }}">
                                    <div class="side-menu__icon"> <i data-lucide="corner-down-right"></i> </div>
                                    <div class="side-menu__title">Events</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/show-classifer-IT_Training') }}"
                                    class="side-menu {{ Request::is('show-classifer-IT_Training*') ? 'side-menu--active' : '' }}">
                                    <div class="side-menu__icon"> <i data-lucide="corner-down-right"></i> </div>
                                    <div class="side-menu__title">IT Training</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/show-classifer-Jobs') }}"
                                    class="side-menu {{ Request::is('show-classifer-Jobs*') ? 'side-menu--active' : '' }}">
                                    <div class="side-menu__icon"> <i data-lucide="corner-down-right"></i> </div>
                                    <div class="side-menu__title">Jobs</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/show-classifer-Roomates&Rental') }}"
                                    class="side-menu {{ Request::is('show-classifer-Roomates&Rental*') ? 'side-menu--active' : '' }}">
                                    <div class="side-menu__icon"> <i data-lucide="corner-down-right"></i> </div>
                                    <div class="side-menu__title">Roomates & Rentals</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/show-classifer-Services') }}"
                                    class="side-menu {{ Request::is('show-classifer-Services*') ? 'side-menu--active' : '' }}">
                                    <div class="side-menu__icon"> <i data-lucide="corner-down-right"></i> </div>
                                    <div class="side-menu__title">Services</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (session('role') == 'admin' || in_array('Advertisment', $userPermissions))
                    <li> <a href="{{ url('/countryAdvertisment') }}"
                            class="side-menu {{ Str::startsWith(Request::url(), url('/countryAdvertisment')) || Str::startsWith(Request::url(), url('/ad-create')) || Str::startsWith(Request::url(), url('/product-ads')) ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon"> <i data-lucide="monitor"></i> </div>
                            <div class="side-menu__title"> Advertisment </div>
                        </a>
                    </li>
                @endif
                @if (session('role') == 'admin' || in_array('Payment_Plans', $userPermissions))
                    <li> <a href="{{ url('/payment-plans') }}"
                            class="side-menu {{ Str::startsWith(Request::url(), url('/payment-plans')) || Str::startsWith(Request::url(), url('/payment-plans')) ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon"> <i data-lucide="dollar-sign"></i> </div>
                            <div class="side-menu__title"> Payment Plans </div>
                        </a>
                    </li>
                @endif
                @if (session('role') == 'admin' || in_array('Users', $userPermissions))
                    <li>
                        <a href="{{ url('/users') }}"
                            class="side-menu {{ Request::is('users*') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon"> <i data-lucide="users"></i> </div>
                            <div class="side-menu__title"> Users </div>
                        </a>
                    </li>
                @endif
                @if (session('role') == 'admin' || in_array('Forum', $userPermissions))
                    <li>
                        <a href="#"
                            class="side-menu {{ Str::startsWith(Request::url(), url('/type-forums')) || Str::startsWith(Request::url(), url('/forum-category')) ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon"> <i data-lucide="list"></i> </div>
                            <div class="side-menu__title">
                                Forum
                                <div class="side-menu__sub-icon transform rotate-180"> <i
                                        data-lucide="more-vertical"></i>
                                </div>
                            </div>
                        </a>
                        <ul class="side-menu__sub">

                            <li>
                                <a href="{{ url('/type-forums') }}"
                                    class="side-menu {{ Request::is('type-forums*') ? 'side-menu--active' : '' }}">
                                    <div class="side-menu__icon"> <i data-lucide="corner-down-right"></i> </div>
                                    <div class="side-menu__title">Forums</div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/forum-category') }}"
                                    class="side-menu {{ Str::startsWith(Request::url(), url('/forum-category')) || Str::startsWith(Request::url(), url('/forum')) ? 'side-menu--active' : '' }}">
                                    <div class="side-menu__icon"> <i data-lucide="corner-down-right"></i> </div>
                                    <div class="side-menu__title"> Forum Category </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (session('role') == 'admin' || in_array('Confession', $userPermissions))
                    <li>
                        <a href="{{ url('/type-confessions') }}"
                            class="side-menu {{ Request::is('type-confessions*') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon"> <i data-lucide="message-square"></i> </div>
                            <div class="side-menu__title">Confession</div>
                        </a>
                    </li>
                @endif
                @if (session('role') == 'admin' || in_array('Blogs', $userPermissions))
                    <li>
                        <a href="{{ url('/blogs') }}"
                            class="side-menu {{ Str::startsWith(Request::url(), url('/blogs')) || Str::startsWith(Request::url(), url('/blog-view')) ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon"> <i data-lucide="inbox"></i> </div>
                            <div class="side-menu__title"> Blogs </div>
                        </a>
                    </li>
                @endif
                @if (session('role') == 'admin' || in_array('FAQS', $userPermissions))
                    <li> <a href="{{ url('/faqs') }}"
                            class="side-menu {{ Request::is('faqs*') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon"> <i data-lucide="help-circle"></i> </div>
                            <div class="side-menu__title"> FAQs </div>
                        </a>
                    </li>
                @endif
                @if (session('role') == 'admin' || in_array('Static_Page', $userPermissions))
                    <li> <a href="{{ url('/static-page') }}"
                            class="side-menu {{ Request::is('static-page*') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon"> <i data-lucide="anchor"></i> </div>
                            <div class="side-menu__title"> Static Page </div>
                        </a>
                    </li>
                @endif
                @if (session('role') == 'admin' || in_array('Testimonials', $userPermissions))
                    <li> <a href="{{ url('/testimonials') }}"
                            class="side-menu {{ Request::is('testimonials*') ? 'side-menu--active' : '' }}">
                            {{-- <a href="/admin-countries" class="side-menu side-menu--active"> --}}
                            <div class="side-menu__icon"> <i data-lucide="smile"></i> </div>
                            <div class="side-menu__title"> Testimonials </div>
                        </a>
                    </li>
                @endif
                @if (session('role') == 'admin' || in_array('Google_Ads', $userPermissions))
                    <li>
                        <a href="{{ url('/google-ads') }}"
                            class="side-menu {{ Request::is('google-ads*') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon"> <i class="fa-brands fa-google"></i> </div>
                            <div class="side-menu__title"> Google Ads </div>
                        </a>
                    </li>
                @endif
                @if (session('role') == 'admin' || in_array('Email_Templates', $userPermissions))
                    <li>
                        <a href="{{ url('/email-templates') }}"
                            class="side-menu {{ Request::is('email-templates*') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon"> <i data-lucide="at-sign"></i>  </div>
                            <div class="side-menu__title"> Email Templates </div>
                        </a>
                    </li>
                @endif
                @if (session('role') == 'admin' || in_array('All_Comments', $userPermissions))
                    <li>
                        <a href="{{ url('/all-comments') }}"
                            class="side-menu {{ Request::is('all-comments*') ? 'side-menu--active' : '' }}">
                            {{-- <a href="/admin-countries" class="side-menu side-menu--active"> --}}
                            <div class="side-menu__icon"> <i data-lucide="message-square"></i> </div>
                            <div class="side-menu__title"> All Comments </div>
                        </a>
                    </li>
                @endif
                @if (session('role') == 'admin' || in_array('Coupons', $userPermissions))
                    <li>
                        <a href="{{ url('/coupons') }}"
                            class="side-menu {{ Request::is('coupons*') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon"> <i data-lucide="percent"></i> </div>
                            <div class="side-menu__title"> Coupons </div>
                        </a>
                    </li>
                @endif
                @if (session('role') == 'admin' || in_array('Notifications', $userPermissions))
                    <li>
                        <a href="{{ url('/notifications') }}"
                            class="side-menu {{ Request::is('notifications*') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon"> <i data-lucide="bell"></i> </div>
                            <div class="side-menu__title"> Notifications </div>
                        </a>
                    </li>
                @endif
                @if (session('role') == 'admin' || in_array('Settings', $userPermissions))
                    <li>
                        <a href="{{ url('/setting') }}"
                            class="side-menu {{ Request::is('setting*') ? 'side-menu--active' : '' }}">
                            <div class="side-menu__icon"> <i data-lucide="settings"></i> </div>
                            <div class="side-menu__title"> Settings </div>
                        </a>
                    </li>
                @endif
                <li>
                    <a href="{{ route('reset_password') }}"
                        class="side-menu {{ Request::is('reset_password*') ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-lucide="lock"></i> </div>
                        <div class="side-menu__title"> Change Password </div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/manage-profile') }}"
                        class="side-menu {{ Request::is('manage-profile*') ? 'side-menu--active' : '' }}">
                        {{-- <a href="/admin-countries" class="side-menu side-menu--active"> --}}
                        <div class="side-menu__icon"> <i data-lucide="user"></i> </div>
                        <div class="side-menu__title"> Manage Profile </div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/logout') }}" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="toggle-right"></i> </div>
                        <div class="side-menu__title"> Logout </div>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="content">
            @yield('content')
        </div>
    </div>

    <!-- Include Alpine.js library -->
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.counterup/1.0.0/jquery.counterup.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sortablejs/1.14.0/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>




    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script> --}}
    <script src="{{ asset('asset/js/app.js') }}"></script>
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script> --}}
    <script src="{{ asset('asset/js/ckeditor-classic.js') }}"></script>



    <script>
        // const  ClassicEditor = require("@ckeditor/ckeditor5-build-classic")

        // $(document).ready(function() {
        //     $(".editor").each(function() {
        //         const el = this;
        //         ClassicEditor.create(el).catch((error) => {
        //             console.error(error);
        //         });
        //     });
        // });
    </script>

    <script src="https://cdn.tiny.cloud/1/9d5p272q2jiloo9ewi2q8jhq0yvo3pg3738q0h11zwfpdnr7/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: 'textarea',
            height: 350,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:12px }'
        });
    </script>
    @yield('script')

</body>

</html>
