<!doctype html>
<html>
    <head>
        <style>
            html, body {
                margin: auto;
                padding: 0;
                max-width: 600px;
                min-height: 100%;
                overflow: hidden;
            }

            body {
                top: 0;
                bottom: 0;
                min-height: 100%;
                font: 16px sans-serif;
            }

            header {
                display: block;
                padding: 1em .25em;
                width: 100%;
                background-color: #f1c634;
            }

            header img {
                display: block;
                margin: auto;
                width: 80%;
                max-width: 80%;
            }
            
            .container {
                padding: 15px;
            }

            .btn {
                display: flex;
                align-items: center;
                justify-content: center;
                margin: auto;
                padding: 1em 2.5em;
                max-width: 200px;
                background-color: #1fbec2;
                color: #fff;
                text-decoration: none;
                text-align: center;
                cursor: pointer;
                border-radius: 2px;
            }

            footer {
                display: block;
                position: relative;
                bottom: 0;
                padding: 15px;
                width: 100%;
                text-align: center;
                background-color: #f1c634;
                color: #1fbec2;
            }
        </style>
    </head>
    <body>
        <header>
            <img src="{{ $message->embed(config('app.url').'images/ForAfter4_Logoalt.png') }}">
        </header>
        <div class="container">
            <p>
                Hello again! Thank you for verifying your email, your account is ready to go! You can now browse, bookmark and book local tutors, instructors & activities for your kids. Follow the link below to get started!
            </p>
            <p>
                <a class="btn" href="{{ config('app.url') }}">Get Started</a>
            </p>
        </div>
        <footer>
            <p>&copy; 2018 ForAfter4</p>
        </footer>
    </body>
</html>