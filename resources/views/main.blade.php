<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPH-EmKWcQtwUGHlUSfL9O4PtToZ8qupE&libraries=places"></script>
</head>

<body>
<div id="app">

    <header>

        <nav class="navbar" role="navigation" aria-label="dropdown navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="">
                    <img src="https://nulldata.com/img/nulldata.svg"  width="112" height="28">
                </a>
                <div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div id="navbarExampleTransparentExample" class="navbar-menu">
                <div class="navbar-end">


                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link" href="{{url("/")}}">
                            Empleado
                        </a>

                        <div class="navbar-dropdown">
                            <a class="navbar-item" href="{{url("/newemployee")}}">
                                Nuevo
                            </a>

                        </div>
                    </div>
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link" href="{{url("/actors")}}">
                            Skills
                        </a>

                        <div class="navbar-dropdown">
                            <a class="navbar-item" href="{{url("/skills")}}">
                                Nuevo
                            </a>
                            <a class="navbar-item" href="{{url("/newactor")}}">
                                Consultar
                            </a>

                        </div>

                    </div>

                </div>
            </div>
        </nav>
    </header>
    <content>
        <div class="container">
            @yield('content')
        </div>
    </content>

    <footer></footer>
</div>
</body>
<script src="{{ asset('js/app.js') }}" defer></script>

{{--AIzaSyBPH-EmKWcQtwUGHlUSfL9O4PtToZ8qupE--}}




</html>
