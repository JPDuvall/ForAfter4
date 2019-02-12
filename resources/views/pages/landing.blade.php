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
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

        <!-- Owl Carousel -->
        <link rel="stylesheet" href="{{ config('app.url') }}/owlcarousel/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="{{ config('app.url') }}/owlcarousel/assets/owl.theme.default.min.css">

        <!-- Select2 -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet">

        <!-- Global Styles -->
        <style>
            @import url('https://fonts.googleapis.com/css?family=Poppins:300,400|Rubik:300,400');

            body {
                font-family: 'Rubik', 'Poppins', sans-serif;
                color: #fff;
            }

            .landing-container {
                position: relative;
                width: 100%;
                height: 100vh;
            }

            .landing-container .landing-content {
                display: flex;
                align-items: center;
                align-content: center;
                justify-content: flex-start;
                flex-wrap: wrap;
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                margin: auto;
                width: 80%;
                height: 100%;
            }

            .landing-content div {
                flex-basis: 100%;
                position: relative;
                text-align: left;
            }

            .landing-content h4 {
                width: 50%;
                max-width: 550px;
            }

            .landing-header {
                display: flex;
                align-items: center;
                justify-content: flex-start;
                position: relative;
                margin-top: -15%;
                margin-bottom: 2em;
                width: 500px;
                height: 170px;
            }

            .landing-header img {
                position: relative;
                left: -194px;
                height: 300px;
                max-width: 100%;
            }

            .landing-container .overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(transparent, 80%, #fff);
                background: -webkit-linear-gradient(transparent, 80%, #fff);
                background: -moz-linear-gradient(transparent, 80%, #fff);
            }

            .landing-container .background-layer {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                overflow: hidden;
            }

            .landing-container .background-layer video {
                min-width: 100%;
                min-height: 100%;
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

            form {
                margin-top: 2em;
            }

            .form-control {
                border-radius: 0;
                border: none;
                border-bottom: 1px solid #ccc;
                background-color: #fff;
                border-radius: 50px 0 0 50px;
            }

            form .btn.btn-primary {
                background-color: #21bfc3;
                border-color: #21bfc3;
                outline: none;
                border-radius: 0 50px 50px 0;
            }

            form .btn.btn-primary:hover {
                background-color: #2fbabd;
            }

            form .btn.btn.btn-primary:active {
                background-color: #21bfc3;
                outline: none;
                box-shadow: none;
            }

            @media screen and (max-width: 600px) {
                .landing-container {
                    overflow-x: hidden;
                }

                .landing-header img {
                    left: -38%;
                    max-width: 160%;
                    height: unset;
                }

                .form-inline {
                    flex-flow: nowrap;
                    max-width: 85%;
                }

                .form-inline .form-group.sub {
                    max-width: 98px;
                }

                .landing-content div.content-section {
                    margin-top: -5em;
                    max-width: 100%;
                }

                .landing-content h4 {
                    width: unset;
                    max-width: 98%;
                }

                .landing-content .landing-header {
                    top: -5em;
                    max-width: 100%;
                }

                .landing-container .overlay {
                    background: linear-gradient(transparent, 40%, #fff);
                    background: -webkit-linear-gradient(transparent, 40%, #fff);
                    background: -moz-linear-gradient(transparent, 40%, #fff);
                }
            }
        </style>

        <title>{{ config('app.name') }} - Coming Soon</title>

    </head>
    <body>
        <div class="load-overlay">
            <img src="{{ config('app.url') }}images/ForAfter4-4Logo-TRANSPARENT.gif">
        </div>
        <div class="landing-container">
            <div class="background-layer">
                <video muted playsinline autoplay loop>
                    <source src="{{ config('app.url') }}/images/FA4 Website Background.mp4" type="video/mp4">
                </video>
            </div>
            <div class="overlay"></div>
            <div class="landing-content">
                <div class="landing-header"><img src="{{ config('app.url') }}images/ForAfter4-Logo-TRANSPARENT.gif"></div>
                <div class="content-section">
                    <h4>Your online community for local tutors, instructors and activities. Subscribe below for updates!</h4>
                </div>
                <form class="form form-inline">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email address">
                    </div>
                    <div class="form-group sub">
                        <button class="btn btn-primary btn-block" type="submit">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Boostrap Scripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

        <!-- Owl Carousel Scripts -->
        <script src="{{ config('app.url') }}/owlcarousel/owl.carousel.min.js"></script>

        <!-- Select2 Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script>
            window.onload = function() {
                setTimeout(function(){
                    $(".load-overlay").fadeOut('slow');
                }, 1600);
            }

            $('form').on('submit', function(e){
                e.preventDefault();
                
                var email = this.querySelector('input').value;

                this.querySelector('input').disabled = true;
                this.querySelector('button').disabled = true;
                this.querySelector('button').innerHTML = 'Subscribing <i class="fas fa-spinner fa-pulse"></i>';

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.post('{{ config('app.url') }}subscribe', {email: email})
                    .done(function(data){
                        console.log(data);
                        document.querySelector('form button').innerHTML = 'Thanks!';
                    });
            });
        </script>
    </body>
</html>