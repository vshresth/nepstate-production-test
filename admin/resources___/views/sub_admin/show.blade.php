@extends('layouts.app')

@section('title')
    User Information
@endsection

@section('content')
    <div class="intro-y  mt-5">
        <div class="grid col-span-4 gap-3 lg:col-span-4 2xl:col-span-3">
            <div class="box p-5 rounded-md">
                <div
                    class="flex items-center justify-between border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate flex items-center">
                        <i data-lucide="user" class="w-4 h-4 mr-2"></i>
                        User Info
                    </div>
                    <a href="{{ route('subadmin-index') }}" class="text-primary hover:text-primary-dark ml-auto">Go Back</a>
                </div>

                <div class="intro-y box px-5 pt-5 mt-5">
                    <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 pb-5 -mx-5">
                        <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                                <div class="ml-5">
                                    <div class="sm:w-40 truncate sm:whitespace-normal font-medium text-lg">
                                        Name: <br> <span style="color: #448AF7;"> {{ $subAdmin->name }}
                                        </span>
                                    </div>
                                    <br>
                                    {{-- <div class="text-slate-500">Username: <span
                                            style="color: #448AF7;">{{ $subAdmin->username }}</span></div> --}}
                                </div>
                            </div>
                            <div class="mt-6 lg:mt-0 flex-1 px-5 border-t lg:border-t-0 pt-5 lg:pt-0">
                                <div class="flex flex-col justify-center items-end lg:items-end mt-4">
                                    <div class="truncate sm:whitespace-normal flex items-center justify-end">
                                        {{ $subAdmin->email }}
                                        <i data-lucide="mail" class="w-4 h-4 mr-2" style="margin-left: 10px"></i>
                                    </div>
                                    {{-- <div class="truncate sm:whitespace-normal flex items-center justify-end mt-3">
                                        {{ $user->mobile }} <i data-lucide="phone" class="w-4 h-4 mr-2"
                                            style="margin-left: 10px"></i>
                                    </div>
                                    <div class="truncate sm:whitespace-normal flex items-center justify-end mt-3">
                                        {{ $user->address }} <i data-lucide="home" class="w-4 h-4 mr-2"
                                            style="margin-left: 10px"></i>
                                    </div> --}}
                                    <div class="truncate sm:whitespace-normal flex items-center justify-end mt-3">
                                        @if ($subAdmin->status == 1)
                                            <span class="flex items-center bg-success/20 text-success rounded px-2 ml-2">
                                                <span class="mr-1">Active</span>
                                                <i data-loading-icon="puff" data-color="white" class="w-4 h-4"></i>
                                            </span>
                                        @elseif($subAdmin->status == 0)
                                            <span class="flex items-center bg-danger/20 text-danger rounded px-2 ml-2">
                                                <span class="mr-1">Disabled</span>
                                                <i data-loading-icon="three-dots" data-color="1a202c" class="w-4 h-4"></i>
                                            </span>
                                        @endif
                                        <i data-lucide="shield" class="w-4 h-4 text-slate-500 mr-2"
                                            style="margin-left: 10px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="px-5 pt-3 pb-5 border-t border-slate-200/60 dark:border-darkmode-400">
                    <div class="w-full flex text-slate-500 text-xs sm:text-sm">
                        <div class="block font-medium text-base mt-5">Role Type:<span
                                class="text-slate-600 dark:text-slate-500 mt-2"> <strong></strong>
                                @if (empty($subAdmin->role_type))
                                    No Role Assigned
                                @else
                                    {{ $subAdmin->role_type }}
                                @endif
                            </span>
                        </div>

                    </div>
                    <div class="w-full flex text-slate-500 text-xs sm:text-sm">

                    </div>

                </div>
                <span class="text-xs text-slate-400 ml-2" style="font-size: 0.75rem;">Created:
                    {{ $subAdmin->created_at }}</span>
                <span class="text-xs text-slate-400 ml-2" style="font-size: 0.75rem;">Updated:
                    {{ $subAdmin->updated_at }}</span>
            </div>
        </div>
    </div>
@endsection
