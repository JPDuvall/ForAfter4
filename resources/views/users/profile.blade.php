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

    /* Profile photo */
    .profile-photo {
        margin: auto;
        margin-bottom: 1em;
        position: relative;
        width: 75%;
        height: 100px;
        background-size: cover;
        background-position: center center;
        border-radius: 100%;
        transition: .4s;
    }

    .change-photo {
        padding: .5em 0;
        text-align: center;
        font-weight: 600;
        color: #21bfc3;
        cursor: pointer;
        transition: .4s;
    }

    .change-photo:hover {
        color: #f1c634;
    }

    .change-photo input { display: none; }

    /* Rich text editor */
    .editor-container {
        border: 1px solid #c0c0c0;
    }

    .editor-container .editor-toolbar-outer {
        display: block;
        margin-bottom: 4px;
    }

    .editor-container .editor-toolbar {
        display: flex;
        align-items: center;
        padding: .5em .25em;
        width: 100%;
        height: 50px;
        background-color: #f1ecec;
        box-shadow: 0 3px 1px 0 rgba(100,100,100,.4);
    }

    .editor-container .editor-toolbar button {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: .25em;
        width: 30px;
        height: 30px;
        border: 1px solid #f1ecec;
        background-color: inherit;
        -webkit-appearance: none;
        -moz-appearance: none;
        -moz-appearance: none;
        -ms-appearance: none;
        -webkit-transition: .3s;
        -moz-transition: .3s;
        -o-transition: .3s;
        transition: .3s;
        cursor: pointer;
    }

    .editor-container .editor-toolbar button:hover {
        background-color: #fafafa;
        border: 1px solid #666;
    }

    .editor-container .editor-toolbar button.active {
        background-color: #a1a3a3;
        border: 1px solid #666;
    }

    .editor-container .editor-toolbar .divider::after {
        margin: 0 5px;
        height: 50px;
        content: '';
        border-left: 1px solid #b2a8a8;
    }

    .editor-container .editor-content {
        display: block;
        padding: .5em;
        min-height: 200px;
        outline: none;
    }

    .editor-container textarea {
        display: none;
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
                    Profile
                </h5>
            </div>
            <div class="card-body">
                {{-- <p>Hello, <b>{{ Auth::user()->name }}</b> (not <b>{{ Auth::user()->name }}</b>? <a href="/logout">Log out</a>)</p> --}}
                <form class="form" action="/hub/save-profile" method="post" enctype="multipart/form-data">
                    <div class="form-heading">
                        <div class="short-underline">
                            <p>Edit your profile</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-12">
                            @if($ui->profile_image)
                            <div class="profile-photo" style="background-image: url('/storage/{{$ui->profile_image}}')"></div>
                            @else:
                            <div class="profile-photo" style="background-image: url('/storage/images/profile_photos/profile_photo.png')"></div>
                            @endif
                            <div class="change-photo">Change profile photo<input type="file" name="profile_image"></div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label for="first">First name (cannot change)</label>
                                <input class="form-control" type="text" name="first" value="{{ $ui->first_name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="last">Last name (cannot change)</label>
                                <input class="form-control" type="text" name="last" value="{{ $ui->last_name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="contact-no">Contact Number</label>
                                <input class="form-control" type="tel" name="contact_number" value="{{ $ui->contact_number }}">
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="bio">Bio</label>
                            <div class="editor-container">
                                <div class="editor-inner">
                                    <div class="editor-toolbar-outer">
                                        <div class="editor-toolbar">
                                            <button class="editor-button" id="EditBold"><i class="fas fa-bold"></i><span class="sr-only">Bold</span></button>
                                            <button class="editor-button" id="EditItalic"><i class="fas fa-italic"></i><span class="sr-only">Italics</span></button>
                                            <span class="divider"></span>
                                            {{-- <button class="editor-button" id="EditOL"></button> --}}
                                        </div>
                                    </div>
                                    <div class="editor-content" contenteditable="true">{!! $ui->bio !!}</div>
                                    <textarea style="" name="bio">{{ $ui->bio }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-12" style="display: flex; justify-content: flex-end;">
                            {{ csrf_field() }}
                            <button class="btn btn-primary">Update Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page_scripts')
<script>
    // profile image
    var profile_photo = document.querySelector('.profile-photo');
    profile_photo.style.height = profile_photo.offsetWidth + 'px';

    $(window).on('resize', function(){
        profile_photo.style.height = profile_photo.offsetWidth + 'px';
    });

    $('.change-photo').on('click', function(){
        document.querySelector('input[name=profile_image]').click();
    });

    $('input[name=profile_image]').on('change', function(){
        var file = this.files[0];
        var fr = new FileReader();

        var img = new Image();
        img.onload = function() {
            profile_photo.style.backgroundImage = img;
        }
        
        fr.onload = function(e) {
            profile_photo.style.backgroundImage = 'url("' + e.target.result + '")'
        }
        fr.readAsDataURL(file);
    });

    // editor scripts
    var editor = document.querySelector('.editor-content');
    document.execCommand('defaultParagraphSeparator', false, 'p');
    var editorPlaceholder = false;

    function checkEditorContent() {
        var l = editor.innerHTML.length;
        if(l < 1) {
            editor.innerHTML = "Tell us something about yourself";
            editor.style.opacity = 0.6;
            editorPlaceholder = true;
        }
        else {
            editorPlaceholder = false;
        }
    }
    checkEditorContent();

    editor.addEventListener('focus', function(e){
        if(editorPlaceholder) {
            editor.innerHTML = "";
            editor.style.opacity = 1;
            document.execCommand('formatBlock', false, 'p');
        }
        
        this.parentElement.parentElement.className += " active";
    });

    editor.addEventListener('blur', function(e){
        this.parentElement.parentElement.className += "editor-container";
        checkEditorContent();
    });

    editor.addEventListener('keydown', function(e){
        //
    });

    editor.addEventListener('keyup', function(e){
        document.querySelector('.editor-container textarea').value = this.innerHTML;
    });
</script>
@endsection