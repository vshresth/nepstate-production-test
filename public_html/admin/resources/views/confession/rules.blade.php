@extends('layouts.app')

@section('title')
    Rules
@endsection

@section('content')
    <div class="col-span-12 mt-6">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">
                Confession Rules
            </h2>
        </div>

        <div class="intro-y col-span-12 md:col-span-6 xl:col-span-4 box">
            <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 px-5 py-4">
                <div class="ml-3 mr-auto">
                    <div class="font-medium">
                        @foreach ($settings as $setting)
                            @php
                                $rulesArray = explode(', ', $setting->rules);
                                $formattedRules = implode(',<br>', $rulesArray);
                            @endphp
                            {!! $formattedRules !!}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
