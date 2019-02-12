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
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <span class="card-icon"><i class="fas fa-users"></i></span>
                    My Children
                </h5>
            </div>
            <div class="card-body">
                <form class="form" id="ChildForm" action="/hub/save-child" method="post">
                    <h6 style="margin-bottom: .5rem;">Add your child(ren)</h6>
                    <div class="row">
                        {{ csrf_field() }}
                        <div class="form-group col-sm-6">
                            <label for="child_name">Child name</label>
                            <input class="form-control" name="child_name" placeholder="What is your child's name?">
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="birth_day">Date of birth</label>
                            <input class="form-control" name="birth_day" placeholder="DD" maxlength="2">
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="birth_month" style="padding-top: 22px;"></label>
                            <select class="form-control" name="birth_month">
                                <option value="">MM</option>
                                <option value="01">Jan</option>
                                <option value="02">Feb</option>
                                <option value="03">Mar</option>
                                <option value="04">Apr</option>
                                <option value="05">May</option>
                                <option value="06">Jun</option>
                                <option value="07">Jul</option>
                                <option value="08">Aug</option>
                                <option value="09">Sep</option>
                                <option value="10">Oct</option>
                                <option value="11">Nov</option>
                                <option value="12">Dec</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="birth_year" style="padding-top: 14px;"></label>
                            <input class="form-control" name="birth_year" placeholder="YYYY" maxlength="4">
                        </div>
                        <div class="form-group col-12" style="display: flex; justify-content: flex-end;">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </form>
                @if($children->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Date of birth</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($children as $child)
                            @php
                                $date = DateTime::createFromFormat('Y-m-d', $child->birth_date);
                            @endphp
                            <tr>
                                <td>{{ $child->name }}</td>
                                <td>{{ $date->format("D M j, Y") }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_scripts')
<script>
    $("#ChildForm").on("submit", function(e){
        e.preventDefault();
        
        var bd = $("input[name=birth_day]").val();
        var by = $("input[name=birth_year]").val();

        var valid_day = isNaN(bd) ? false : true;
        var valid_year = isNaN(by) ? false : true;

        if(!valid_day) {
            alert('Please enter a valid birth day');
            return false;
        }

        if(!valid_year) {
            alert('Please enter a valid birth year');
            return false;
        }

        var areusure = confirm("Is your child's information correct? Please make sure it is before submitting.");
        if(areusure)
            this.submit();
        else
            return false;
    });
</script>
@endsection