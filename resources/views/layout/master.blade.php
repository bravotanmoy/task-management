<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task || @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">


    @yield('page-style')
</head>

<body>

    <div class="container-fluid">

        <!-- Logo And Menu section -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="logo navbar-brand" href="#">Task Management</a>


            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('task.index') ? 'fw-bolder text-decoration-underline' : '' }}"
                            aria-current="page" href="{{ route('task.index') }}">All Task</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('task.create') || request()->routeIs('task.edit') ? 'fw-bolder text-decoration-underline' : '' }}"
                            href="{{ route('task.create') }}">Create Task</a>
                    </li>

                </ul>

            </div>
        </nav>

        {{-- Start Main Content Section --}}
        @yield('content')
        {{-- End Main Content Section --}}

    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>


    @yield('page-script')
</body>

</html>