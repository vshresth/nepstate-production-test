@extends('layouts.app')

@section('title')
    Reset Passsword
@endsection

@section('content')
    <br>
    @if (Session::has('success'))
        <div class="alert alert-secondary alert-dismissible show flex items-center mb-2" role="alert"> <i
                data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> {{ Session::get('success') }} <button type="button"
                class="btn-close" data-tw-dismiss="alert" aria-label="lock"> <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
    @endif
    <div class="intro-y flex items-center mt-8">

        <h2 class="text-lg font-medium mr-auto">
            Change Password
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <?php
        $permissions = session('permissions');
        if ($permissions != '') {
            $userPermissions = explode(',', $permissions);
        } else {
            $userPermissions = [];
        }
        ?>
        <!-- BEGIN: Profile Menu -->
        <div class="col-span-12 lg:col-span-4 2xl:col-span-3 flex lg:block flex-col-reverse">
            <div class="intro-y box mt-5">
                <div class="relative flex items-center p-5">
                    <div class="w-12 h-12 image-fit">
                        <img alt="Photo" class="rounded-full" src="{{ $admin->admin_profile_pic }}">
                    </div>
                    <div class="ml-4 mr-auto">
                        <div class="font-medium text-base">{{ $admin->name }}</div>
                        <div class="text-slate-500">{{ $admin->username }}</div>
                    </div>

                </div>
                <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                    <div class="flex items-center text-primary font-medium" href=""> <i data-lucide="mail"
                            class="w-4 h-4 mr-2"></i> {{ $admin->email }}</div>
                    <div class="flex items-center mt-5" href=""> <i data-lucide="shield" class="w-4 h-4 mr-2"></i>
                        @if ($admin->status == 1)
                            <span class="flex items-center bg-success/20 text-success rounded px-2 ml-2">
                                <span class="mr-1">Active</span>
                                <i data-loading-icon="puff" data-color="white" class="w-4 h-4"></i>
                            </span>
                        @elseif($admin->status == 2)
                            <span class="flex items-center bg-danger/20 text-danger rounded px-2 ml-2">
                                <span class="mr-1">Disabled</span>
                                <i data-loading-icon="three-dots" data-color="1a202c" class="w-4 h-4"></i>
                            </span>
                        @endif
                    </div>
                    @if (session('role') == 'admin' || in_array('Settings', $userPermissions))
                        <a class="flex items-center mt-5" href="{{ url('/setting') }}"> <i data-lucide="settings"
                                class="w-4 h-4 mr-2"></i>Settings </a>
                    @endif
                </div>

            </div>
        </div>
        <!-- END: Profile Menu -->
        <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
            <!-- BEGIN: Change Password -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">

                    <h2 class="font-medium text-base mr-auto">
                        Change Password
                    </h2>
                </div>
                <form id="changePasswordForm" action="{{ route('change_password') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="p-5">
                        <div>
                            <label for="old_password" class="form-label">Old Password</label>
                            <input id="old_password" name="old_password" type="password" class="form-control"
                                placeholder="Enter old password" required>
                            <br><br>
                            @error('old_password')
                                <div class="alert alert-outline-danger alert-dismissible show flex items-center mb-2"
                                    role="alert">
                                    <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> {{ $message }}
                                    <button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="Close">
                                        <i data-lucide="x" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="form-label">New Password</label>
                            <input id="password" name="password" type="password" class="form-control"
                                placeholder="Enter new password" required>
                            <br><br>

                        </div>

                        <div>
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                class="form-control" placeholder="Confirm new password" required>
                        </div>
                        <br>
                        @error('password')
                            <div class="alert alert-outline-danger alert-dismissible show flex items-center mb-2"
                                role="alert">
                                <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> {{ $message }}
                                <button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="Close">
                                    <i data-lucide="x" class="w-4 h-4"></i>
                                </button>
                            </div>
                        @enderror
                        <br>
                        <button type="button" id="confirmChangePassword" class="btn btn-success text-white mt-4">Change
                            Password</button>
                    </div>
                </form>



                <script>
                    function handleSubmit() {

                        if (confirm('Are you sure you want to change your password?')) {

                            document.getElementById('changePasswordForm').submit();
                        }
                    }


                    document.getElementById('confirmChangePassword').addEventListener('click', handleSubmit);


                    document.getElementById('password').addEventListener('keypress', function(event) {

                        if (event.keyCode === 13) {

                            event.preventDefault();

                            handleSubmit();
                        }
                    });
                </script>



            </div>
            <!-- END: Change Password -->
        </div>
    </div>
    </div>
@endsection
