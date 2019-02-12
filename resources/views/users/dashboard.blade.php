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
</style>
@endsection

@section('content')
<div class="row mt-5 ml-5 mb-5" style="min-height: 60vh;">
    <div class="col-sm-2 ml-5">
        @include('inc/hub_sidebar')
    </div>
    <div class="col-sm-7">
        {{-- <h1>Hello, </h1> --}}
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <span class="card-icon"><i class="fas fa-user-cog"></i></span>
                    Account Settings
                </h5>
            </div>
            <div class="card-body">
                {{-- <p>Hello, <b>{{ Auth::user()->name }}</b> (not <b>{{ Auth::user()->name }}</b>? <a href="/logout">Log out</a>)</p> --}}
                <form class="form" method="post">
                    <div class="form-heading">
                        <div class="short-underline">
                            <p>Edit account information</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="email">Email address</label>
                            <input class="form-control" type="email" name="email" value="{{ Auth::user()->email }}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="username">Username</label>
                            <input class="form-control" type="text" name="username" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group col-12" style="display: flex; justify-content: flex-end;">
                            <button class="btn btn-primary">Update account info</button>
                        </div>
                    </div>
                </form>
                <form class="form" method="post">
                    <div class="form-heading">
                        <div class="short-underline">
                            <p>Change password</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="new-password">New password</label>
                            <input class="form-control" type="password" name="new-password" placeholder="Choose a password">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="confirm-password">Confirm password</label>
                            <input class="form-control" type="password" name="confirm-password" placeholder="Confirm that password">
                        </div>
                        <div class="form-group col-12" style="display: flex; justify-content: flex-end;">
                            <button class="btn btn-primary">Update password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection