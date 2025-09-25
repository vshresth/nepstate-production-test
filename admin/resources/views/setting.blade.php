@extends('layouts.app')

@section('title')
    Account Settings
@endsection

@section('content')
    <br>
    <div class="container space-around">
        <div class="intro-y block sm:flex items-center h-10 w-full">
            <h2 class="text-lg font-medium truncate mr-5">
                Settings
            </h2>
        </div>

        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data"
            class="grid grid-cols-4 w-full sm:w-auto">
            @csrf

           {{-- <div class="intro-y col-span-4 sm:w-auto">
                <div class="intro-y box ">
                    <div class="flex flex-col sm:flex-row p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">
                            Fees and Charges 
                        </h2>
                    </div>
                    <div id="input" class="p-5">
                        @foreach ($settings as $setting)
                            <div class="form-group">
                                <label for="paragraph">Fees In Percentage</label>
                                <input type="number" class="form-control" name="admin_fees_percentage"
                                        value="{{ $setting->admin_fees_percentage }}" step="0.01" min="0">
                                
                            </div>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
            <br> --}}
            <div class="intro-y  col-span-4 w-full sm:w-auto">
                <div class="intro-y col-span-4 box">
                    <div
                        class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">
                            Sites
                        </h2>
                    </div>
                    <div id="input" class="p-5">
                        @foreach ($settings as $setting)
                            <div class="form-group">
                                <label for="site_title">Site Title:</label>
                                <input type="text" class="form-control" name="site_title"
                                    value="{{ $setting->site_title }}">
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="site_logo">Site Logo</label>
                                <div class="input-with-image">
                                    @if ($setting->site_logo)
                                        <img src="{{ $setting->site_logo }}" alt="Site Logo"
                                            style="max-width: 100px; max-height: 100px;" class="logo-preview">
                                    @endif
                                    <br>
                                    <input type="file" name="site_logo" id="site_logo" class="form-control-file"
                                        accept="image/jpeg,image/png,image/jpg,image/svg">
                                </div>
                                @error('site_logo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <br>
                            {{--   <div class="form-group">
                                    <label for="site_logo_small">Site Logo Small:</label>
                                    <div class="input-with-image">
                                        @if ($setting->site_logo_small)
                                            <img src="{{ asset('images/logo/' . $setting->site_logo_small) }}"
                                                style="max-width: 100px; max-height: 100px;" alt="Site Logo Small"
                                                class="logo-preview">
                                        @endif <br>
                                        <input type="file" name="site_logo_small" id="site_logo_small"
                                            class="form-control-file" accept="image/jpeg,image/png,image/jpg"> <br><br>
                                    </div>
                                    @error('site_logo_small')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="site_favicon">Site Favicon:</label>
                                    <div class="input-with-image">
                                        @if ($setting->site_favicon)
                                            <img src="{{ asset('images/logo/' . $setting->site_favicon) }}"
                                                alt="Site Favicon" style="max-width: 100px; max-height: 100px;"
                                                class="logo-preview">
                                        @endif <br>
                                        <input type="file" name="site_favicon" id="site_favicon"
                                            class="form-control-file" accept="image/jpeg,image/png,image/jpg"> <br><br>

                                    </div>
                                    @error('site_favicon')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> --}}
                        @endforeach
                    </div>
                </div>
            </div>
            <br>
            <div class="intro-y col-span-4 w-full sm:w-auto">
                <div class="intro-y box">
                    <div
                        class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">
                            Contact Information
                        </h2>
                    </div>
                    <div id="input" class="p-5">
                        @foreach ($settings as $setting)
                            <div class="flex" style="justify-content: space-evenly">
                                <div class="form-group" style=" width: -webkit-fill-available; margin-right:10px ">
                                    <label for="mobile">Mobile:</label>
                                    <input type="text" class="form-control" name="mobile"
                                        value="{{ $setting->mobile }}">
                                </div>
                                <div class="form-group" style=" width: -webkit-fill-available; margin-left:10px ">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" name="email" value="{{ $setting->email }}">
                                </div>
                            </div>
                            <br>
                            <div class="flex" style="justify-content: space-around">
                                <div class="form-group" style=" width: -webkit-fill-available; margin-right:10px">
                                    <label for="address">Address:</label>
                                    <input type="text" class="form-control" name="address"
                                        value="{{ $setting->address }}">
                                </div>
                                <div class="form-group" style=" width: -webkit-fill-available; margin-left:10px ">
                                    <label for="map_address">Map</label>
                                    <input type="text" class="form-control" name="map_address"
                                        value="{{ $setting->map_address }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <br>
            <div class="intro-y col-span-4  w-full sm:w-auto">
                <div class="intro-y box">
                    <div
                        class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">
                            URLs
                        </h2>
                    </div>
                    <div id="input" class="p-5">
                        @foreach ($settings as $setting)
                            <div class="flex">
                                <div class="form-group" style=" width: -webkit-fill-available; margin-right:10px">
                                    <label for="facebook">Facebook URL:</label>
                                    <input type="text" class="form-control" name="facebook"
                                        value="{{ $setting->facebook }}">
                                </div>
                                <div class="form-group" style=" width: -webkit-fill-available; margin-left:10px ">
                                    <label for="instagram">Instagram URL:</label>
                                    <input type="text" class="form-control" name="instagram"
                                        value="{{ $setting->instagram }}">
                                </div>
                            </div>
                            <br>
                            <div class="flex" style="justify-content: space-around">
                                <div class="form-group" style=" width: -webkit-fill-available; margin-right:10px">
                                    <label for="twitter">Twitter URL:</label>
                                    <input type="text" class="form-control" name="twitter"
                                        value="{{ $setting->twitter }}">
                                </div>
                                <div class="form-group" style=" width: -webkit-fill-available; margin-left:10px ">
                                    <label for="linkedin">Linkedin URL:</label>
                                    <input type="text" class="form-control" name="linkedin"
                                        value="{{ $setting->linkedin }}">
                                </div>
                            </div>
                            <br>
                            {{-- i am saving pinterest in url in snapchat  column --}}
                            <div class="flex" style="justify-content: space-around">
                                <div class="form-group" style=" width: -webkit-fill-available;">
                                    <label for="snapchat">Pinterest URL:</label> 
                                    <input type="text" class="form-control" name="snapchat"
                                        value="{{ $setting->snapchat }}">
                                </div>
                                {{-- <div class="form-group" style=" width: -webkit-fill-available; margin-left:10px ">
                                    <label for="skype">Skype URL:</label>
                                    <input type="text" class="form-control" name="skype"
                                        value="{{ $setting->skype }}">
                                </div>
                            </div>
                            <br>
                            <div class="flex" style="justify-content: space-around">
                                <div class="form-group" style=" width: -webkit-fill-available; margin-right:10px">
                                    <label for="youtube">Youtube URL:</label>
                                    <input type="text" class="form-control" name="youtube"
                                        value="{{ $setting->youtube }}">
                                </div>
                                <div class="form-group" style=" width: -webkit-fill-available; margin-left:10px ">
                                    <label for="frontend_url">Frontend URL:</label>
                                    <input type="text" class="form-control" name="frontend_url"
                                        value="{{ $setting->frontend_url }}">
                                </div>
                            </div> --}}
                        @endforeach
                    </div>
                </div>
            </div>
            <br>
            <div class="intro-y col-span-4 sm:w-auto">
                <div class="intro-y box  ">
                    <div class="flex flex-col sm:flex-row p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">
                            Rules
                        </h2>
                    </div>
                    <div class="flex p-5" style="justify-content:space-around">
                        <div id="input" class="" style="width:50%;margin-right:10px ">
                            @foreach ($settings as $setting)
                                <div class="form-group">
                                    <label for="confession_rules">Confession Rules</label>
                                    <textarea class="form-control editor" name="confession_rules" style="height: 120px">{{ $setting->confession_rules }}</textarea>
                                </div>
                                <script>
                                    CKEDITOR.replace('confession_rules');
                                </script>
                        </div>
                        <br>
                        <div id="input" class="" style="width:50% ;margin-left:10px">

                            <div class="form-group ">
                                <label for="forum_rules">Forum Rules</label>
                                <textarea class="form-control editor" name="forum_rules" style="height: 120px">{{ $setting->forum_rules }}</textarea>

                            </div>
                            <script>
                                CKEDITOR.replace('forum_rules');
                            </script>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="intro-y col-span-4 sm:w-auto">
                <div class="intro-y box ">
                    <div class="flex flex-col sm:flex-row p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">
                            Footer
                        </h2>
                    </div>
                    <div id="input" class="p-5">
                        @foreach ($settings as $setting)
                            <div class="form-group">
                                {{-- <label for="paragraph">Paragraph</label> --}}
                                <textarea class="form-control editor" name="paragraph" style="height: 120px">{{ $setting->paragraph }}</textarea>
                                <script>
                                    CKEDITOR.replace('paragraph');
                                </script>
                            </div>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
            <br>
            <div class="intro-y col-span-4 sm:w-auto">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">
                            Upcoming Event
                        </h2>
                        <button id="event-toggle" class="btn btn-primary ml-auto" type="button">
                            @foreach ($settings as $setting)
                                {{ $setting->event ? 'Disable Event' : 'Enable Event' }}
                            @endforeach
                        </button>
                    </div>

                    <div id="input" class="p-5">
                        @foreach ($settings as $setting)
                            <div class="form-group" id="event-settings"
                                style="display: {{ $setting->event ? 'block' : 'none' }};">
                                <div class="form-group">
                                    <label for="mainheading">Main Heading</label>
                                    <input type="text" class="form-control" name="mainheading"
                                        value="{{ $setting->mainheading }}">
                                </div>
                                <br>
                                <label for="subheading">Sub Heading</label>
                                <textarea class="form-control editor" name="subheading" style="height: 120px">{{ $setting->subheading }}</textarea>
                                <script>
                                    CKEDITOR.replace('subheading');
                                </script>
                            </div>
                            <br>
                            <input type="hidden" id="event-value" name="event" value="{{ $setting->event }}">
                        @endforeach
                    </div>

                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const eventToggle = document.getElementById('event-toggle');
                    const eventSettings = document.getElementById('event-settings');
                    const eventValue = document.getElementById('event-value');
                    const eventForm = document.getElementById('event-form');
                    eventToggle.addEventListener('click', function() {
                        if (eventValue.value == 0) {
                            eventSettings.style.display = 'block';
                            eventValue.value = 1;
                            eventToggle.textContent = 'Disable Event';
                        } else {
                            eventSettings.style.display = 'none';
                            eventValue.value = 0;
                            eventToggle.textContent = 'Enable Event';
                        }
                    });
                    if (eventValue.value == 1) {
                        eventToggle.textContent = 'Disable Event';
                    } else {
                        eventToggle.textContent = 'Enable Event';
                    }
                    eventForm.addEventListener('submit', function(event) {
                        event.preventDefault();
                        eventForm.submit();
                    });
                });
            </script>
            <br>

            <div class="intro-y col-span-4 sm:w-auto">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">
                            List View
                        </h2>
                        <button id="list-view-toggle" class="btn btn-primary ml-auto" type="button">
                            {{ $setting->list_view ? 'Disable List View' : 'Enable List View' }}
                        </button>
                    </div>

                    <div id="list-input" class="p-5">
                        @foreach ($settings as $setting)
                            <div class="form-group" id="list-settings"
                                style="display: {{ $setting->list_view ? 'block' : 'none' }};">
                                <div class="form-group">
                                    <label for="no_of_lists">Number of Lists</label>
                                    <input type="number" class="form-control" name="no_of_lists"
                                        value="{{ $setting->no_of_lists }}">
                                </div>
                                <br>
                                <div class="form-group" id="happy-customers-settings">
                                    <label for="happy_customers">Happy Customers</label>
                                    <input type="number" class="form-control" name="happy_customers"
                                        value="{{ $setting->happy_customers }}">
                                </div>
                                <br>
                                <div class="form-group" id="visitors-settings">
                                    <label for="visitors">Visitors</label>
                                    <input type="number" class="form-control" name="visitors"
                                        value="{{ $setting->visitors }}">
                                </div>
                            </div>
                            <input type="hidden" id="list-view-value" name="list_view"
                                value="{{ $setting->list_view }}">
                        @endforeach
                    </div>
                </div>
            </div>


            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const listViewToggle = document.getElementById('list-view-toggle');
                    const listSettings = document.getElementById('list-settings');
                    const listViewValue = document.getElementById('list-view-value');

                    if (listViewValue.value === '1') {
                        listSettings.style.display = 'block';
                        listViewToggle.textContent = 'Disable List View';
                    } else {
                        listSettings.style.display = 'none';
                        listViewToggle.textContent = 'Enable List View';
                    }

                    listViewToggle.addEventListener('click', function() {
                        const listSettingsDisplay = listSettings.style.display;
                        if (listSettingsDisplay === 'none' || listSettingsDisplay === '') {
                            listSettings.style.display = 'block';
                            listViewToggle.textContent = 'Disable List View';
                            listViewValue.value = 1;
                        } else {
                            listSettings.style.display = 'none';
                            listViewToggle.textContent = 'Enable List View';
                            listViewValue.value = 0;
                        }
                    });
                });
            </script>




            <div class="w-full sm:w-auto pt-4">
                <button class="btn btn-primary" style=" width:120px;">Save
                    Settings</button>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            $(".editor").each(function() {
                const el = this;
                ClassicEditor.create(el).catch((error) => {
                    console.error(error);
                });
            });
        });
    </script>
@endsection
