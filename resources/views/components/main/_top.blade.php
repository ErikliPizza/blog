<header>
    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="text-white font-georgia">About</h4>
                    <p class="font-georgia-pink">Hi, it's me. I hope you'd still remember your old friend again... No, just kidding. İt's me Samet, I'm a .net and web developer, doing this amazing job for years. My childhood is completely smells programming. That's all I remember.</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                    <h4 class="text-white">Contact</h4>
                    <ul class="list-unstyled">
                        <li><a href="https://www.instagram.com/vviglaf/" class="text-white"><i class="fa fa-instagram text-danger"></i> Instagram</a></li>
                        <li><a class="text-white"><i class="fa fa-envelope"></i> noircontactdevteam@gmail.com</a></li>
                        <li><a href="https://play.google.com/store/apps/developer?id=NCDT&hl=tr&gl=US" class="text-white"><i class="fa-brands fa-google-play"></i> Google Play</a></li>
                        <li>Visit on <x-r1o-logo/></li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
            <a href="/" class="navbar-brand d-flex align-items-center">
                <x-application-logo/>
            </a>
            <div class="d-flex">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <span class="ml-2" style="cursor: pointer;">
                    @auth
                        @can('admin')
                            <a href="{{  route('profile.edit') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Panel</a>
                        @else
                            <div class="dropdown show">
                            <a class="dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle" style="width: 40px; height: 40px;" alt="Avatar" src="{{ asset('storage/' . Auth::user()->avatar) }}">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{  route('profile.edit') }}">Profile</a>
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </div>
                        @endcan
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-weight-bold">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm font-weight-bold">Register</a>
                        @endif
                    @endauth
                </span>
            </div>
        </div>
    </div>

</header>
