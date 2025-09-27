<!DOCTYPE html>
<html lang="en" class="light">
<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <link href="asset/images/small_logo.svg" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Enigma admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Enigma Admin Template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <title>Nepstate Admin Login Page</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="asset/css/app.css" />
    <!-- END: CSS Assets-->
    <!-- Include Lucide CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lucide@0.57.0/dist/lucide.min.css">
</head>
<!-- END: Head -->

<body class="login">
    <form class="form-horizontal form-material" action="{{ route('login-user') }}" method="post">
        @csrf
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="hidden xl:flex flex-col min-h-screen">
                    <div class="-intro-x w-60">
                        <img alt="logo" class="" src="{{ asset('asset/images/main.svg') }}">
                        {{-- <span class="text-white text-lg ml-3"> Nepstate </span> --}}
                    </div>
                    <div class="my-auto">
                        <img alt="" class="-intro-x w-1/2 -mt-16" src="asset/images/illustration.svg">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                            A few more clicks to 
                            <br>
                            sign in to your account.
                        </div>
                        <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Manage your
                            website in one place</div>
                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div
                        class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left"
                            style="color: #ff9902">
                            Log In
                        </h2>
                        <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">A few more clicks to sign in to
                            your account. Manage all your e-commerce accounts in one place</div>
                        <div class="intro-x mt-8">
                            <input type="email" id="email" name="email"
                                class="intro-x login__input form-control py-3 px-4 block" placeholder="Email">

                                <div class="relative mt-4">
                                    <input type="password" name="password" id="password"
                                        class="intro-x login__input form-control py-3 px-4 block w-full pr-10 relative"
                                        placeholder="Password">
                                    <button type="button" onclick="togglePasswordVisibility('password')"
                                        class="absolute inset-y-0 right-0 mr-4 z-50 flex items-center ">
                                        <i data-lucide="eye" class="w-4 h-4 text-black"></i>
                                    </button>
                                </div>
                            <br>
                            @if (Session::has('fail'))
                                <div class="alert alert-danger alert-dismissible show flex items-center mb-2"
                                    role="alert"> <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i>
                                    {{ Session::get('fail') }} <button type="button" class="btn-close"
                                        data-tw-dismiss="alert" aria-label="lock"> <i data-lucide="x"
                                            class="w-4 h-4"></i>
                                    </button>
                                </div>
                            @endif
                            @if (Session::has('error'))
                                <div class="alert alert-danger alert-dismissible show flex items-center mb-2"
                                    role="alert"> <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i>
                                    {{ Session::get('error') }} <button type="button" class="btn-close"
                                        data-tw-dismiss="alert" aria-label="lock"> <i data-lucide="x"
                                            class="w-4 h-4"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
                            {{-- <div class="flex items-center mr-auto">
                                <input id="remember-me" type="checkbox" class="form-check-input border mr-2">
                                <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                            </div> --}}
                            {{-- <a href="">Forgot Password?</a> --}}
                        </div>
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button class="btn"
                                style="background-color: #ff9902; width:100px; color:whitesmoke">Login</button>
                        </div>

                    </div>
                </div>
                <!-- END: Login Form -->
            </div>
        </div>
    </form>
    <!-- BEGIN: Dark Mode Switcher-->
    {{-- <div data-url="login-dark-login.html" class="dark-mode-switcher cursor-pointer shadow-md fixed bottom-0 right-0 box dark:bg-dark-2 border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10">
            <div class="mr-4 text-gray-700 dark:text-gray-300">Dark Mode</div>
            <div class="dark-mode-switcher__toggle border"></div>
        </div> --}}
    <!-- END: Dark Mode Switcher-->

    <!-- BEGIN: JS Assets-->
    <script src="asset/js/app.js"></script>
    <!-- END: JS Assets-->
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.57.0/dist/lucide.min.js"></script>
    <script>
        lucide.createIcons(); // Initialize the Lucide icons

        function togglePasswordVisibility(fieldId) {
            const field = document.getElementById(fieldId);
            const type = field.type === 'password' ? 'text' : 'password';
            field.type = type;
        }
    </script>
 <script>
    function togglePasswordVisibility(id) {
        var input = document.getElementById(id);
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }
</script>
</body>

</html>
