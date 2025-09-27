@extends('layouts.app')

@section('title')
    Advertisement For
@endsection

@section('content')
    <br>
    <div class="intro-y col-span-12 lg:col-span-6" style="width: 60%; margin-left:20%;margin-right:20%;">
        <div class="intro-y box">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    Select Location
                </h2>
            <a href="{{ url('/countryAdvertisment') }}" class="text-primary hover:text-primary-dark ml-auto">Go Back</a>

            </div>
            <div id="input" class="p-5">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{-- <label>Advertisement For</label> --}}
                            {{-- <div class="mt-2 grid grid-cols-2 gap-4">
                                @foreach (['Ad # 1', 'Ad # 2', 'Ad # 3', 'Ad # 4', 'Ad # 5', 'Ad # 6', 'Ad # 7', 'Ad # 8'] as $ad)
                                    <button type="button" class="btn btn-outline-primary" onclick="selectAdFor('{{ $ad }}')" value="{{ $ad }}">{{ $ad }}</button>
                                @endforeach
                            </div> --}}

                            <div class="mt-2 grid grid-cols-2 gap-4">
                                <a href="{{ url('ad-create/1') }}"class="btn btn-outline-primary">Ad#1</a>
                                <a href="{{ url('ad-create/2') }}"class="btn btn-outline-primary">Ad#2</a>
                                <a href="{{ url('ad-create/3') }}"class="btn btn-outline-primary">Ad#3</a>
                                <a href="{{ url('ad-create/4') }}"class="btn btn-outline-primary">Ad#4</a>
                                <a href="{{ url('ad-create/5') }}"class="btn btn-outline-primary">Ad#5</a>
                                <a href="{{ url('ad-create/6') }}"class="btn btn-outline-primary">Ad#6</a>
                                <a href="{{ url('ad-create/7') }}"class="btn btn-outline-primary">Ad#7</a>
                                <a href="{{ url('ad-create/8') }}"class="btn btn-outline-primary">Ad#8</a>

                            </div>

                            <input type="hidden" name="ad_for" id="ad_for">
                            @error('ad_for')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        function selectAdFor(adFor) {
            localStorage.setItem('ad_for', adFor);
            
            switch(adFor) {
                case 'Ad # 1':
                    window.location.href = '{{ route("create_page") }}';
                    break;
                case 'Ad # 2':
                    window.location.href = '{{ route("add_2") }}';
                    break;
                case 'Ad # 3':
                    window.location.href = '{{ route("product_ad") }}';
                    break;
                case 'Ad # 4':
                    // Define the route for Ad #4 if needed
                    break;
                case 'Ad # 5':
                    // Define the route for Ad #5 if needed
                    break;
                case 'Ad # 6':
                    // Define the route for Ad #6 if needed
                    break;
                case 'Ad # 7':
                    // Define the route for Ad #7 if needed
                    break;
                case 'Ad # 8':
                    // Define the route for Ad #8 if needed
                    break;
                default:
                    // Default action if ad not found
                    break;
            }
        }
    </script> --}}
@endsection
