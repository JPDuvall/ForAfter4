@extends('layouts.layout')

@section('page_styles')
<style>
    
    .row {
        font-size: 12px;
    }

    .titles {
        display: block;
        text-align: center;
    }

    .titles h3 {
        margin-top: .25em;
        font-weight: 400!important;
    }

    .titles p {
        margin: 0;
        padding: 0;
        font-size: 1.25em;
        color: #21bfc3;
    }

    h1, h3 {
        margin: .5em auto;
        text-align: center;
    }

    h5 {
        text-align: center;
    }

    form {
        margin: auto;
        margin-bottom: .5rem;
        max-width: 800px;
    }

    form fieldset {
        margin: 3.5em auto;
        padding: 1.5em;
        padding-top: .75em;
        max-width: 800px;
        border: 1px solid #e3e4e8;
        border-radius: 2px;
        transition: .3s;
    }

    form fieldset:hover {
        box-shadow: 0 0 2px 0 rgba(150,150,150,.25);
    }

    form fieldset .field-header {
        margin-top: .25em;
        margin-bottom: 2em;
    }

    form fieldset .field-header .header-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: .5em;
        margin-left: 0;
        /* padding: .5em .65em; */
        width: 40px;
        height: 40px;
        background-color: #21bfc3;
        color: #fff;
        border-radius: 100%;
        font-size: 1.5em;
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
        padding: 1em;
        background-color: #21bfc3;
        border-color: #21bfc3;
        border-radius: 2px;
        font-size: 1.05em;
    }

    .btn.btn-primary:hover {
        background-color: #f1c634;
        border-color: #f1c634;
    }

    #SessionSchedule .form-control {
        margin-bottom: .75em;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-lg">
        <div class="titles">
            <p>Create</p>
            <h3>List Your Activity</h3>
        </div>
        {!! Form::open(['action' => 'ActivitiesController@store', 'method' => 'post', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) !!}
            <fieldset>
                <div class="field-header">
                    <span class="header-icon"><i class="fas fa-pencil-alt"></i></span> Add activity
                </div>
                <div class="form-group">
                    {{ Form::label('name', 'Activity name') }}
                    {{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Give your activity a title']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('tagline', 'Activity tagline') }}
                    {{ Form::text('tagline', '', ['class' => 'form-control', 'placeholder' => 'Describe your activity in three words', 'maxlength' => '50']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('description', 'Activity description') }}
                    {{ Form::textarea('description', '', ['class' => 'form-control']) }}
                </div>
            </fieldset>
            <fieldset>
                <div class="field-header">
                    <span class="header-icon"><i class="fas fa-map-marker-alt"></i></span> Activity location
                </div>
                <div class="form-group">
                    {{ Form::label('location', 'Activity location') }}
                    {{ Form::text('location', '', ['class' => 'form-control']) }}
                </div>
            </fieldset>
            <fieldset>
                <div class="field-header">
                    <span class="header-icon"><i class="far fa-images"></i></span> Add images
                </div>
                <div class="form-group">
                    {{ Form::label('images', 'Images') }}
                    <input class="form-control" type="file" name="images[]" multiple>
                </div>
            </fieldset>
            <fieldset>
                <div class="field-header">
                    <span class="header-icon"><i class="fas fa-clipboard-list"></i></span> Activity details
                </div>
                <div class="form-group">
                    {{ Form::label('price', 'Activity price') }}
                    {{ Form::number('price', '', ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('category', 'Category') }}
                    <select class="form-control" name="category">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    {{ Form::label('term', 'Term or session?') }}
                    {{ Form::select('term', ['term' => 'Term', 'session' => 'Session'], '', ['class' => 'form-control']) }}
                </div>
                <div class="row justify-content-center" id="SessionSchedule">
                    <div class="col-12">
                        <h3>Availability</h3>
                    </div>
                    <div class="col-md-3">
                        <h5>Sunday</h5>
                        <div class="form-group">
                            {{ Form::label('sun_from', 'From') }}
                            {{ Form::select('sun_from', ['' => 'Select Availability', 'n/a' => 'Not Available'], '', ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('sun_to', 'To') }}
                            {{ Form::select('sun_to', ['' => 'Select Availability', 'n/a' => 'Not Available'], '', ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h5>Monday</h5>
                        <div class="form-group">
                            {{ Form::label('mon_from', 'From') }}
                            {{ Form::select('mon_from', ['' => 'Select Availability', 'n/a' => 'Not Available'], '', ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('mon_to', 'To') }}
                            {{ Form::select('mon_to', ['' => 'Select Availability', 'n/a' => 'Not Available'], '', ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h5>Tuesday</h5>
                        <div class="form-group">
                            {{ Form::label('tue_from', 'From') }}
                            {{ Form::select('tue_from', ['' => 'Select Availability', 'n/a' => 'Not Available'], '', ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('tue_to', 'To') }}
                            {{ Form::select('tue_to', ['' => 'Select Availability', 'n/a' => 'Not Available'], '', ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h5>Wednesday</h5>
                        <div class="form-group">
                            {{ Form::label('wed_from', 'From') }}
                            {{ Form::select('wed_from', ['' => 'Select Availability', 'n/a' => 'Not Available'], '', ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('wed_to', 'To') }}
                            {{ Form::select('wed_to', ['' => 'Select Availability', 'n/a' => 'Not Available'], '', ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h5>Thursday</h5>
                        <div class="form-group">
                            {{ Form::label('thu_from', 'From') }}
                            {{ Form::select('thu_from', ['' => 'Select Availability', 'n/a' => 'Not Available'], '', ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('thu_to', 'To') }}
                            {{ Form::select('thu_to', ['' => 'Select Availability', 'n/a' => 'Not Available'], '', ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h5>Friday</h5>
                        <div class="form-group">
                            {{ Form::label('fri_from', 'From') }}
                            {{ Form::select('fri_from', ['' => 'Select Availability', 'n/a' => 'Not Available'], '', ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('fri_to', 'To') }}
                            {{ Form::select('fri_to', ['' => 'Select Availability', 'n/a' => 'Not Available'], '', ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h5>Saturday</h5>
                        <div class="form-group">
                            {{ Form::label('sat_from', 'From') }}
                            {{ Form::select('sat_from', ['' => 'Select Availability', 'n/a' => 'Not Available'], '', ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('sat_to', 'To') }}
                            {{ Form::select('sat_to', ['' => 'Select Availability', 'n/a' => 'Not Available'], '', ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="form-group" id="SessionLength">
                    {{ Form::label('session_length', 'Length of each session (in minutes)') }}
                    {{ Form::number('session_length', '', ['class' => 'form-control']) }}
                </div>
                <div class="form-group" id="TermStart">
                    {{ Form::label('term_start', 'Term start') }}
                    {{ Form::text('term_start', '', ['class' => 'form-control']) }}
                </div>
                <div class="form-group" id="TermEnd">
                    {{ Form::label('term_end', 'Term end') }}
                    {{ Form::text('term_end', '', ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('spots_available', 'Spots available') }}
                    {{ Form::number('spots_available', '', ['class' => 'form-control']) }}
                </div>
            </fieldset>
            <fieldset class="button-wrapper">
                {{ Form::submit('Preview', ['class' => 'btn btn-primary btn-block']) }}
            </fieldset>
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('page_scripts')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCR6AOuQsB6exa92mIRvhldD517WzZsaqI&amp;libraries=places&amp;v=3"></script>
<script>
    function ChangeForm(select) {
        switch(select.selectedIndex) {
            case 1:
                $("#SessionSchedule").css({ display: 'flex' });
                $("#SessionLength").css({ display: 'block' });
                $("#TermStart").css({ display: 'none' });
                $("#TermEnd").css({ display: 'none' });
                break;
            case 0:
                $("#SessionSchedule").css({ display: 'none' });
                $("#SessionLength").css({ display: 'none' });
                $("#TermStart").css({ display: 'block' });
                $("#TermEnd").css({ display: 'block' });
                break;
        }
    }
    ChangeForm(document.querySelector("select[name=term]"));

    $("select[name=term]").on('change', function(){
        ChangeForm(this);
    });

    function SetTimeTables() {
        for(var i = 0; i < 24; i++) {
            var opt = document.createElement("option");
            
            opt.value = i + ':00';
            if(i == 11)
                opt.innerHTML = (i + 1) + ':00 PM';
            else if(i > 11 && i < 23)
                opt.innerHTML = (i + 1) - 12 + ':00 PM';
            else if(i == 23)
                opt.innerHTML = (i + 1) - 12 + ':00 AM';
            else
                opt.innerHTML = (i + 1) + ':00 AM';
            
            $("#SessionSchedule select").append(opt);
            
            opt = document.createElement("option");
            
            opt.value = i + ':30';
            if(i == 11)
                opt.innerHTML = (i + 1) + ':30 PM';
            else if(i > 11 && i < 23)
                opt.innerHTML = (i + 1) - 12 + ':30 PM';
            else if(i == 23)
                opt.innerHTML = (i + 1) - 12 + ':30 AM';
            else
                opt.innerHTML = (i + 1) + ':30 AM';

            $("#SessionSchedule select").append(opt);
            
        }
    }
    SetTimeTables();
</script>
@endsection