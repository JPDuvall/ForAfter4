<!doctype html>
<html>
    <head>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>Email Testing Page</title>
    </head>
    <body>
        <form id="TestForm">
            <input type="email" name="email" placeholder="Email Address">
            <button type="submit">Send Test Message</button>
        </form>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#TestForm").on("submit", function(e){
                e.preventDefault();
                var fData = {
                    email: this.elements[0].value
                };
                $.post('{{ config('app.url') }}send', fData)
                    .done(function(data){
                        console.log(data);
                    });
            });
        </script>
    </body>
</html>