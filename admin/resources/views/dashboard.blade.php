@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="col-span-12 mt-8">
        <div class="intro-y flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">
                General Report

            </h2>
            <a href="" class="ml-auto flex items-center text-primary"> <i data-lucide="refresh-ccw"
                    class="w-4 h-4 mr-3"></i> Reload Data </a>
        </div>
        <?php
        $permissions = session('permissions');
        if ($permissions != '') {
            $userPermissions = explode(',', $permissions);
        } else {
            $userPermissions = [];
        }
        ?>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                @if (session('role') == 'admin' || in_array('Blogs', $userPermissions))
                    <a href="{{ route('blogs.index') }}" class="block">
                @endif
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-lucide="inbox" class="report-box__icon text-primary"></i>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">{{ $blogCount }}</div>
                        <div class="text-base text-slate-500 mt-1">Total Blogs</div>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                @if (session('role') == 'admin' || in_array('Users', $userPermissions))
                    <a href="{{ route('users.user.index') }}" class="block">
                @endif
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-lucide="users" class="report-box__icon text-success"></i>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">{{ $userCount }}</div>
                        <div class="text-base text-slate-500 mt-1">Total Users</div>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                @if (session('role') == 'admin' || in_array('Countries', $userPermissions))
                    <a href="{{ route('countries.index') }}" class="block">
                @endif
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-lucide="globe" class="report-box__icon text-pending"></i>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">{{ $adminCountryCount }}</div>
                        <div class="text-base text-slate-500 mt-1">Total Countries</div>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                @if (session('role') == 'admin' || in_array('Confession', $userPermissions))
                    <a href="{{ route('confessions.index') }}" class="block">
                @endif
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-lucide="filter" class="report-box__icon text-warning"></i>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">{{ $confessionCount }}</div>
                        <div class="text-base text-slate-500 mt-1">Total Confessions</div>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                @if (session('role') == 'admin' || in_array('Forum', $userPermissions))
                    <a href="{{ route('typeforums.index') }}" class="block">
                @endif
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-lucide="filter" class="report-box__icon text-warning"></i>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">{{ $forumCount }}</div>
                        <div class="text-base text-slate-500 mt-1">Total Forums</div>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                @if (session('role') == 'admin' || in_array('Classified_Categories', $userPermissions))
                    <a href="{{ route('category.index') }}" class="block">
                @endif
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-lucide="plus" class="report-box__icon text-warning"></i>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">{{ $mainCategoriesCount }}</div>
                        <div class="text-base text-slate-500 mt-1">Total Categories</div>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                @if (session('role') == 'admin' || in_array('Classified_Categories', $userPermissions))
                    <a href="{{ route('category.index') }}" class="block">
                @endif
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-lucide="plus" class="report-box__icon text-warning"></i>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">{{ $subCategoriesCount }}</div>
                        <div class="text-base text-slate-500 mt-1">Total Sub Categories</div>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                @if (session('role') == 'admin' || in_array('Forum', $userPermissions))
                    <a href="{{ route('forum.index') }}" class="block">
                @endif
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-lucide="layers" class="report-box__icon text-success"></i>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">{{ $forumCategoryCount }}</div>
                        <div class="text-base text-slate-500 mt-1">Total Forum Categories</div>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
@endsection
