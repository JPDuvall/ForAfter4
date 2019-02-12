@extends('layouts.layout')

@section('page_styles')
<style>
    .nav-pills .nav-item .nav-link {
        padding: 1em 2em;
        padding-left: 1.5em;
        font-size: 13px;
        font-weight: 400;
        border-radius: 2px;
    }

    .nav-pills .nav-item .nav-link { color: #484848; transition: .5s; }

    .nav-pills .nav-item .nav-link:hover { color: #21bfc3; }
    
    .nav-pills .nav-item .nav-link.active { background-color: #21bfc3; color: #fff; }

    .card {
        color: #484848;
        font-size: 13px;
        border-radius: 2px;
        box-shadow: 0 1px 3px 0px rgba(150,150,150,.25);
    }

    .card .card-header {
        background-color: #fff;
        border-bottom: none;
    }

    .card .card-header h5.card-title {
        margin-top: 1em;
        font-size: 13px;
    }

    .card-title .card-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: .25em;
        width: 40px;
        height: 40px;
        font-size: 18px;
        background-color: #21bfc3;
        color: #fff;
        border-radius: 100%;
    }

    .card .card-body a {
        color: inherit;
        text-decoration: none;
        transition: .5s;
    }

    .card .card-body a:hover {
        color: #21bfc3;
    }

    .form-heading {
        margin-bottom: .5em;
        padding: 1em 0;
    }

    .form-heading .short-underline {
        width: 20px;
        border-bottom: 1px solid #21bfc3;
    }

    .form-heading p {
        display: block;
        margin-bottom: 0;
        padding-bottom: 0;
        min-width: 200px;
        font-weight: 900;
    }

    label {
        color: #565662;
    }

    .form-control {
        padding-left: 0;
        font-size: inherit;
    }

    input.form-control {
        padding: 13px;
        padding-left: 0;
        transition: .3s;
    }

    .form-control:focus {
        padding-left: 6px;
        border-bottom: 2px solid #21bfc3;
    }

    .form-control:disabled {
        background-color: #fefefc;
        color: #666;
    }

    fieldset.button-wrapper {
        border: none;
        box-shadow: none;
    }

    .btn.btn-primary {
        padding: 1em 2em;
        background-color: #21bfc3;
        border-color: #21bfc3;
        border-radius: 2px;
        font-size: .95em;
    }

    .btn.btn-primary:hover {
        background-color: #f1c634;
        border-color: #f1c634;
    }

    button.remove {
        display: block;
        margin: auto;
        background-color: transparent;
        border: none;
        color: #f00;
        cursor: pointer;
        transition: .5s;
    }

    button.remove:hover {
        color: #f30;
    }
</style>
@endsection

@section('content')
<div class="row mt-5 ml-5 mb-5" style="min-height: 60vh;">
    <div class="col-sm-2 ml-5">
        @include('inc/hub_sidebar')
    </div>
    <div class="col-sm-7">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <span class="card-icon"><i class="fas fa-user-alt"></i></span>
                    Watchlist
                </h5>
            </div>
            <div class="card-body">
                <div id="WatchList"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_scripts')
<script>
    var loadTable = function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.post('{{config('app.url')}}hub/watch-list/table')
            .done(function(data) {
                $('#WatchList').html(data);

                $('.remove').on('click', function(){
                    var id = this.getAttribute('data-id');
                    removeWatchItem(id);
                });
            });
    }
    loadTable();

    var removeWatchItem = function(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.post('{{config('app.url')}}watch-list/add', { activity_id: id })
            .done(function(data) {
                loadTable();
            });
    }
</script>
@endsection