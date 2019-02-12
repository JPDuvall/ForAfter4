<!doctype html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Boostrap Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

        <!-- Owl Carousel -->
        <link rel="stylesheet" href="{{ config('app.url') }}/owlcarousel/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="{{ config('app.url') }}/owlcarousel/assets/owl.theme.default.min.css">

        <!-- Select2 -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet">

        <!-- Global Styles -->
        <style>
            @import url('https://fonts.googleapis.com/css?family=Poppins:300,400|Rubik:300,400');

            body {
                position: relative;
                font-family: 'Rubik', 'Poppins', sans-serif;
                overflow-x: hidden;
                z-index: 0;
            }

            .navbar {
                padding: 1rem 1rem;
            }

            .navbar.navbar-light {
                background-color: #fff!important;
            }

            .navbar .nav-item-wrapper {
                display: flex;
            }

            .navbar-brand {
                display: flex;
                align-items: center;
                justify-content: center;
                max-height: 40px;
                max-width: 175px;
            }

            .nav-item.login,
            .nav-item.dropdown.login {
                display: none;
            }

            .navbar-text.login {
                padding-top: .35rem;
                padding-right: .75rem;
                padding-left: .75rem;
            }

            .navbar-text.login a {
                padding-top: 1rem;
                padding-bottom: 1rem;
                color: inherit;
                font-size: .85rem;
                text-decoration: none;
                transition: color 600ms ease;
            }

            .navbar .btn.btn-primary.create {
                padding: .5em 1em;
                font-size: .9em;
                border-radius: 50px;
                background-color: #21bfc3;
                border-color: #21bfc3;
            }

            .navbar .login-button,
            .navbar .nav-button {
                border: none;
                background: none;
                color: inherit;
                font-size: 1.25em;
                z-index: 50;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                cursor: pointer;
                outline: none;
            }

            .dropdown-toggle::after {
                border: none;
                font-family: "Font Awesome 5 Free";
                font-weight: 900;
                text-rendering: auto;
                font-size: .6em;
                content: "\f078";
                vertical-align: center;
            }

            .form-control {
                border: none;
                border-bottom: 1px solid #c0c0c0;
                border-radius: 0;
                resize: none;
            }

            .form-control:focus {
                border-color: #a0a0a0;
                box-shadow: none;
            }

            .calendar {
                text-align: center;
            }

            .calendar .date {
                width: 14.285%;
            }

            .modal-dialog .modal-content {
                padding: 1em;
                border-radius: 2px;
            }

            .modal-content .modal-header {
                border-bottom: none;
            }

            h5.modal-title {
                font-size: 12px;
            }

            h5.modal-title i {
                padding-right: 8px;
                color: #c7cdcf;
            }

            .modal-body .form-control {
                padding-left: 2px;
                padding-bottom: 10px;
                font-size: 12px;
                transition: all .3s;
            }

            .modal-body .form-control:focus {
                padding-left: 6px;
                border-color: #21bfc3;
            }

            .modal-body .form-control::placeholder {
                color: #000;
            }

            .modal-body .form-check label {
                padding-top: 10px;
            }

            /* checkboxes */
            input[type=checkbox] {
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                border: none;
                outline: none;
            }

            input[type=checkbox]:checked {
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                border: none;
                outline: none;
                background-color: transparent;
            }

            input[type=checkbox]::before {
                font-family: "Font Awesome 5 Free";
                content: "\f0c8";
                font-size: 18px;
                color: #ccc;
                -webkit-appearance: none;
            }

            input[type=checkbox]:checked::before {
                font-family: "Font Awesome 5 Free";
                color: #21bfc3;
                font-weight: 900;
                content: "\f14a";
            }

            .modal-body .alert {
                font-size: 10px;
            }

            .modal-body .btn.btn-primary {
                padding: 12px;
                position: relative;
                border-radius: 2px;
                font-size: 13px;
                background-color: #21bfc3;
                border-color: #21bfc3;
            }

            .modal-body .btn.btn-primary div {
                display: flex;
                align-items: center;
                justify-content: center;
                position: absolute;
                top: 0;
                right: 20px;
                height: 100%;
                opacity: 0;
                -webkit-transition: all .3s;
                -moz-transition: all .3s;
                transition: all .3s;
            }

            .modal-body .btn.btn-primary:hover {
                background-color: #000;
                border-color: #111;
            }

            .modal-body .btn.btn-primary:hover > div {
                right: 10px;
                opacity: 1;
            }

            .load-overlay {
                display: flex;
                align-items: center;
                justify-content: center;
                position: fixed;
                top: 0;
                width: 100%;
                height: 100%;
                z-index: 1000;
                background-color: #21bfc3;
            }

            .load-overlay img {
                height: 70%;
            }
            
            footer.container-fluid {
                padding: 1rem 2rem;
                padding-right: 1.5rem;
                padding-left: 1.5rem;
                border-top: 1px solid #ebebeb;
            }

            footer .copy {
                display: flex;
                align-items: center;
                padding: .5rem;
                height: 100%;
                font-size: .98rem;
                color: #ccc;
            }

            footer .social-menu {
                display: flex;
                align-items: center;
                justify-content: flex-end;
                padding: .5rem;
            }

            footer .social-circle {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 40px;
                height: 40px;
                color: rgba(0,0,0,.5);
                font-size: .75em;
                font-weight: 600;
                text-decoration: none;
                border: 1px solid #adadad;
                border-radius: 100%;
                margin: .3rem .3rem;
                transition: background-color 600ms ease;
            }

            footer .social-circle.fb:hover { background-color: #4267b2; color: #fff; }

            footer .social-circle.tw:hover { background-color: #1da1f2; color: #fff; }

            footer .social-circle.li:hover { background-color: #0073b1; color: #fff; }

            footer .social-circle.gp:hover { background-color: #db4437; color: #fff; }

            @media screen and (min-width: 992px) {
                .login-button,
                .nav-button,
                .nav-close-wrapper {
                    display: none;
                }

                .nav-item.login,
                .nav-item.dropdown.login {
                    display: block;
                }

                .navbar-expand-lg .navbar-nav .nav-link {
                    padding-right: .75rem;
                    padding-left: .75rem;
                    font-size: 13px;
                }

                /* .dropdown-toggle .dropdown-menu */
                .dropdown-menu {
                    display: block;
                    position: absolute;
                    border-radius: 2px;
                    top: 150%;
                    font-size: .85rem;
                    border: none;
                    box-shadow: 0 0 50px -10px rgba(200,200,200,.6);
                    opacity: 0;
                    transition: opacity .4s, top .2s;
                    z-index: -1;
                }

                .dropdown:hover > .dropdown-menu {
                    opacity: 1;
                    top: 100%;
                    z-index: 100;
                }

                .dropdown.login {
                    margin-left: 1.75em;
                }

                .dropdown.login .dropdown-menu {
                    left: unset;
                    right: 0;
                }

                .dropdown-menu a.dropdown-item {
                    color: #ccc;
                    transition: padding .3s ease;
                }

                .dropdown-menu a.dropdown-item::after {
                    width: 90%;
                    border-bottom: 1px solid #ccc;
                }

                .dropdown-menu a.dropdown-item:hover {
                    padding-left: 2em;
                    color: #21bfc3;
                    background-color: #fff;
                }

                .nav-icon {
                    display: none;
                }
            }

            @media screen and (max-width: 992px) {
                .collapse:not(.show) {
                    display: block;
                }

                .collapse:not(.show) .navbar-nav {
                    left: -100%;
                }

                .collapse .navbar-nav {
                    position: fixed;
                    top: 0;
                    bottom: 0;
                    width: 300px;
                    height: 100%;
                    max-height: 100%;
                    background-color: #fff;
                    z-index: 1000;
                    transition: left .2s;
                }

                .collapse.show .navbar-nav {
                    left: 0;
                }

                .collapse .navbar-nav .nav-item,
                .dropdown-menu .dropdown-item {
                    padding: .5em 2em;
                }

                .navbar-light .collapse .navbar-nav .nav-link {
                    color: #666;
                }

                .nav-close-wrapper {
                    border-bottom: 1px solid #e3e3e3;
                }

                .nav-close {
                    cursor: pointer;
                }

                .nav-close::before {
                    font-family: "Font Awesome 5 Free";
                    font-weight: 900;
                    font-size: 1.25em;
                    content: "\f00d";
                }

                .dropdown-toggle::after {
                    content: "";
                }

                .navbar-nav .dropdown-menu {
                    display: block;
                    position: absolute;
                    margin-right: -2em!important;
                    width: 100%;
                    max-width: 100%;
                    max-height: 0;
                    overflow: hidden;
                    border-radius: 0;
                    border: none;
                    transition: max-height .2s ease;
                }

                .navbar-nav .dropdown-menu.show {
                    max-height: 1000px;
                    border-top: 1px solid #e3e3e3;
                    border-bottom: 1px solid #e3e3e3;
                }

                .nav-icon {
                    padding-right: 1em;
                }
            }

            @media screen and (min-width: 576px) {
                .modal-sm {
                    max-width: 360px;
                }
            }

            @media screen and (max-width: 576px) {
                .modal-sm {
                    margin: auto;
                    max-width: 300px;
                }

                .navbar-brand {
                    max-width: 125px;
                }
                footer .copy { justify-content: center; }

                footer .social-menu { justify-content: center; }
            }

            @keyframes blink {
                0% { opacity: 1; filter: hue-rotate(0); }
                50% { opacity: .5; filter: hue-rotate(90deg); }
                100% { opacity: 1; filter: hue-rotate(0); }
            }

            @keyframes fadeOut {
                0% { opacity: 1; }
                100% { opacity: 0; }
            }
        </style>
        
        @yield('page_styles')

        <title>{{ config('app.name') }}</title>
    </head>
    <body>
        @guest
        {{-- Login Modal --}}
        <div class="modal fade" tabindex="-1" role="dialog" id="LoginModal">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="far fa-user"></i> Sign in</h5>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" role="alert" id="LoginAlert" style="display: none;"></div>
                        <form class="form" method="post" action="{{ config('app.url') }}authenticate">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input class="form-control" type="text" name="email" id="email" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" id="LoginButton" type="submit" role="button">Sign in <div><i class="fas fa-chevron-right"></i></div></button>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember">
                                        <label class="form-check-label" for="remember" style="font-size: .75em;">Remember me</label>
                                    </div>
                                </div>
                                <div class="form-group col-6" style="padding-top: 4px; text-align: right;">
                                    <a href="#" style="font-size: .75em;">Forgot password?</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <a style="font-size: .75em; color: #6c6c6c;" data-toggle="modal" data-dismiss="modal" data-target="#SignupModal" href="#">Don't have an account?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Signup Modal --}}
        <div class="modal fade" tabindex="-1" role="dialog" id="SignupModal">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="far fa-user"></i> Create an account</h5>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" role="alert" id="SignupAlert" style="display: none;"></div>
                        <form class="form">
                            <div class="form-group">
                                <input class="form-control" type="text" name="first_name" placeholder="First name" required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="last_name" placeholder="Last name" required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="user_name" placeholder="User name" required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="number" name="num_kids" placeholder="# of kids" required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="password" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="giver">
                                    <label class="form-check-label" for="giver" style="font-size: .75em;">Apply to become a giver?</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit" role="button">Sign up <div><i class="fas fa-chevron-right"></i></div></button>
                            </div>
                            <div class="form-group">
                                <a style="font-size: .75em; color: #6c6c6c;" data-toggle="modal" data-dismiss="modal" data-target="#LoginModal" href="#">Already registered?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endguest
        {{-- Main Navigation --}}
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="nav-item-wrapper">
                <button class="nav-button"><i class="fas fa-bars"></i></button>
                <a class="navbar-brand" href="{{ config('app.url') }}"><img src="{{ config('app.url') }}images/ForAfter4-Logo-TRANSPARENT.gif" height="100"></a>
            </div>
            @guest
            <button class="login-button" data-toggle="modal" data-dismiss="modal" data-target="#LoginModal"><i class="far fa-user"></i></button>
            @endguest
            <div class="collapse navbar-collapse justify-content-end" id="MainNavigation">
                <ul class="navbar-nav">
                    <li class="nav-item nav-close-wrapper">
                        <a class="nav-link nav-close"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ config('app.url') }}"><span class="nav-icon"><i class="fas fa-home"></i></span>Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ config('app.url') }}explore"><span class="nav-icon"><i class="fas fa-compass"></i></span>Explore</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="MoreDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="nav-icon"><i class="fas fa-ellipsis-h"></i></span>More
                        </a>
                        <div class="dropdown-menu" aria-labelledby="MoreDropdown">
                            <a class="dropdown-item" href="#">Blog</a>
                            <a class="dropdown-item" href="#">About</a>
                        </div>
                    </li>
                    @guest
                    <li class="nav-item login">
                        <span class="navbar-text login">
                            <i class="far fa-user"></i> <a class="" data-toggle="modal" data-target="#LoginModal" href="#">Sign in</a> or <a class="" data-toggle="modal" data-target="#SignupModal" href="#">Register</a>
                        </span>
                    </li>
                    @else
                    <li class="nav-item dropdown login">
                        <a class="nav-link dropdown-toggle" href="#" id="UserDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="UserDropdown">
                            <a class="dropdown-item" href="{{ config('app.url') }}hub">Hub</a>
                            <a class="dropdown-item" href="{{ config('app.url') }}logout">Logout</a>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
            @guest
            @else
                @if(Auth::user()->giver_approved == true)
                <a href="{{ config('app.url') }}activities/create" class="btn btn-primary create">Add Listing</a>
                @endif
            @endguest
        </nav>
        {{-- Main Content --}}
        <div class="load-overlay">
            <img src="{{ config('app.url') }}images/ForAfter4-4Logo-TRANSPARENT.gif">
        </div>
        <div class="container-fluid">
            @include('inc.messages')
            @yield('content')
        </div>
        <footer class="container-fluid">
            <div class="row" style="width: 94%; margin: auto;">
                <div class="col-sm-6">
                    <div class="copy">
                        &copy; ForAfter4 2018 All Rights Reserved
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-menu">
                        <a class="social-circle fb" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                        <a class="social-circle tw" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                        <a class="social-circle li" href="https://linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                        <a class="social-circle gp" href="https://plus.google.com/"><i class="fab fa-google-plus-g"></i></a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Boostrap Scripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

        <!-- Stripe.js -->
        <script src="https://js.stripe.com/v3/"></script>

        <!-- Owl Carousel Scripts -->
        <script src="{{ config('app.url') }}/owlcarousel/owl.carousel.min.js"></script>

        <!-- Select2 Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script>
            window.onload = function() {
                setTimeout(function(){
                    $(".load-overlay").fadeOut('slow');
                }, 600);
            }

            $('.nav-button').on('click', function() {
                $('.collapse').addClass('show');
            });

            $('.nav-close').on('click', function() {
                $('.collapse').removeClass('show');
            });

            $("#LoginModal form").on('submit', function(e){
                e.preventDefault();
                
                var fData = {
                    email: this.elements[1].value,
                    password: this.elements[2].value
                };

                var _this = this;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.post('/check_login', fData)
                    .done(function(data){
                        data = JSON.parse(data);
                        if(data["Status"] == 0) {
                            $("#LoginAlert").html(data["Message"]);
                            $("#LoginAlert").css({ "display": "block" });

                            setTimeout(function(){
                                $("#LoginAlert").fadeOut("slow");
                            },4000);
                        }
                        else {
                            _this.submit();
                        }
                    });
            });

            $("#SignupModal form").on('submit', function(e){
                e.preventDefault();
                var fData = {
                    first: this.elements[0].value,
                    last: this.elements[1].value,
                    user: this.elements[2].value,
                    email: this.elements[3].value,
                    kids: this.elements[4].value,
                    pass: this.elements[5].value,
                    giver: this.elements[6].checked
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.post('{{ config('app.url') }}register', fData)
                    .done(function(data){
                        data = JSON.parse(data);
                        if(data["Status"] == 0) {
                            $("#SignupAlert").html(data["Message"]);
                            $("#SignupAlert").css({ "display": "block" });

                            setTimeout(function(){
                                $("#SignupAlert").fadeOut("slow");
                            },4000);
                        }
                        else {
                            alert(data["Message"]);
                            window.location.reload();
                        }
                        console.log(data["Message"]);
                    });
            });
        </script>
        @yield('page_scripts')
    </body>
</html>