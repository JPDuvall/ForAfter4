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

    .nav-pills .nav-item .nav-link.active { background-color: #21bfc3; }

    .card {
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
        margin-right: .25em;
        padding: .5em .6em;
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
</style>
@endsection

@section('content')
<div class="row justify-content-center mt-5 ml-5 mb-5">
    <div class="col-sm-7">
        {{-- <h1>Hello, {{ Auth::user()->name }}</h1> --}}
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <span class="card-icon"><i class="far fa-envelope"></i></span>
                    Account verified
                </h5>
            </div>
            <div class="card-body">
                <p>Great! You're verified. You may now login to your account.</p>
                <p></p>
            </div>
        </div>
    </div>
</div>
@endsection