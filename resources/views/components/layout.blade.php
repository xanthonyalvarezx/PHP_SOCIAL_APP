    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>OurApp | Home</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
        <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js"
            integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous">
        </script>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;0,700;1,400;1,700&display=swap"
            rel="stylesheet" />
        @vite(['resources/css/app.css'])
        @vite(['resources/js/app.js'])
        @livewireScripts
    </head>
    <header class="header-bar mb-3">
        <div class="container d-flex flex-column flex-md-row align-items-center p-3">
            <h4 class="my-0 mr-md-auto font-weight-normal"><a wire:navigate href="/" class="text-white">OurApp</a>
            </h4>
            @auth
                <div class="d-flex flex-row my-3 my-md-0">
                    @persist('headerdynamic')
                        <livewire:search />
                        <livewire:chat />
                    @endpersist
                    <a wire:navigate href="/profile/{{ auth()->user()->id }}" class="mr-2"><img title="My Profile"
                            data-toggle="tooltip" data-placement="bottom"
                            style="width: 32px; height: 32px; border-radius: 16px" src="{{ auth()->user()->photo }}" /></a>
                    <a wire:navigate class="btn btn-sm btn-success mr-2" href="/create-post">Create Post</a>
                    <form action="/logout" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-secondary">Sign Out</button>
                    </form>
                </div>
            @else
                <form action="/login" method="POST" class="mb-0 pt-2 pt-md-0">
                    @csrf
                    <div class="row align-items-center">
                        <div class="col-md mr-0 pr-md-0 mb-3 mb-md-0">
                            <input name="loginusername" class="form-control form-control-sm input-dark" type="text"
                                placeholder="Username" autocomplete="off" />
                        </div>
                        <div class="col-md mr-0 pr-md-0 mb-3 mb-md-0">
                            <input name="loginpassword" class="form-control form-control-sm input-dark" type="password"
                                placeholder="Password" />
                        </div>
                        <div class="col-md-auto">
                            <button class="btn btn-primary btn-sm">Sign In</button>
                        </div>
                    </div>
                </form>
            @endauth
        </div>
    </header>
    {{-- HEADER END --}}
    @if (session()->has('success'))
        <div class="container container--narrow">
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        </div>
    @elseif(session()->has('error'))
        <div class="container container--narrow">
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        </div>
    @endif
    {{ $slot }}
    {{-- FOOTER START --}}
    <footer class="border-top text-center small text-muted py-3">
        <p class="m-0">Copyright &copy; {{ date('Y') }} <a wire:navigate href="/"
                class="text-muted">OurApp</a>. All
            rights reserved.</p>
    </footer>
