@extends('layouts.layout')

@section('page_styles')
<style>
    body {
        z-index: 9;
    }

    nav.navbar.navbar-light.bg-light {
        position: absolute;
        width: 100%;
        background-color: transparent!important;
        z-index: 10;
    }

    .navbar-brand img {
        filter: grayscale(100%) contrast(100);
    }

    .navbar-light .navbar-nav .nav-link {
        color: #fff;
    }

    .navbar-text.login { color: #fff; }

    .navbar .login-button,
    .navbar .nav-button {
        color: #fff;
    }

    .home-banner {
        position: relative;
        height: 100vh;
        max-height: 800px;
        overflow-y: hidden;
    }

    .home-banner .content {
        display: flex;
        align-content: center;
        align-items: center;
        justify-content: center;
        position: relative;
        top: 0;
        width: 100%;
        height: 90%;
        z-index: 6;
    }

    .home-banner h1 {
        flex-basis: 100%;
        color: #fff;
        text-align: center;
        font-size: 7.5em;
    }

    .home-banner .content h3 {
        font-size: 1.6em;
        text-align: center;
        color: #fff;
    }

    .home-banner .content .discovery-bar {
        display: flex;
        justify-content: space-between;
        margin-top: 1em;
        padding-left: 20px;
        width: 60%;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 50px;
        /* overflow: hidden; */
        /* opacity: 0.7; */
    }

    .home-banner .content .discovery-bar .input-outter {
        display: flex;
        align-items: center;
        flex-basis: 50%;
    }

    .input-outter .input-wrapper {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .input-outter .input-wrapper .float-icon {
        position: absolute;
        right: .5em;
        top: 0;
        bottom: 0;
        margin-top: auto;
        margin-bottom: auto;
        height: 1.5em;
        color: #666;
    }

    #FindLocation {
        cursor: pointer;
    }

    .nu-select {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding-left: 15px;
        height: 100%;
        /* border: 1px solid #ccc; */
        border-left: none;
        color: #666;
        transition: padding-left 100ms linear;
        cursor: pointer;
    }

    .nu-select.active {
        padding-left: 20px;
    }

    .nu-select-list {
        max-height: 0;
        overflow: hidden;
        transition: max-height 200ms linear;
    }

    .nu-select.active ~ .nu-select-list {
        max-height: 200px;
        overflow-y: scroll;
    }

    .nu-select-list .nu-select-option,
    .pac-item {
        padding: 10px 15px;
        transition: padding-left 200ms ease;
        cursor: pointer;
    }

    .nu-select-list .nu-select-option:hover,
    .pac-item:hover {
        padding-left: 20px;
        color: #21bfc3;
    }

    .nu-select-list .nu-select-option.active {
        background-color: #21bfc3;
        color: #fff;
    }

    .nu-select-list .nu-select-option.active:hover {
        padding-left: 15px;
    }

    .input-outter .input-wrapper input,
    .input-outter .input-wrapper select {
        padding-left: 15px;
        width: 100%;
        height: 100%;
        /* border: 1px solid #ccc; */
        border: none;
        outline: none;
        -webkit-appearance: none;
    }

    .input-outter .input-wrapper input {
        border-right: 1px solid #ccc;
        border-top-left-radius: 50px;
        border-bottom-left-radius: 50px;
    }

    .input-outter .input-wrapper select {
        /* border-left: 1px solid #ccc; */
    }

    /* Google Places */
    .input-outter .input-wrapper input {
        padding-left: 1px;
    }
    
    .pac-container {
        /* margin-left: 20px; */
    }
    /* End Google Places */

    .home-banner .content .discovery-bar button {
        display: block;
        padding: .75em 1em;
        height: 100%;
        background-color: #21bfc3;
        border: 1px solid #229fa2;
        border-top-right-radius: 50px;
        border-bottom-right-radius: 50px;
        color: #fff;
        -webkit-appearance: none;
        cursor: pointer;
    }

    .home-banner .background-layer {
        position: absolute;
        top: 0;
        right: 0;
        width: 100%;
        height: 100vh;
        max-height: 800px;
        overflow: hidden;
        background-image: url("{{ config('app.url') }}images/boy-chair-children-1001914.jpg");
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    .home-banner .background-layer video {
        position: relative;
        top: -25%;
        min-width: 100%;
        z-index: 4;
    }

    .home-banner .overlay {
        position: absolute;
        top: 0;
        right: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(transparent, 45%, #fff);
        z-index: 5;
    }

    .fa4-section {
        display: block;
        margin-bottom: 40px;
    }

    .titles {
        display: flex;
        flex-wrap: wrap;
        
    }

    .titles h3,
    .titles h6 {
        flex-basis: 100%;
        text-align: center;
    }

    .titles h3 {
        font-weight: 200;
    }

    .titles h6 {
        font-weight: 500;
        color: #21bfc3;
    }

    .categories {
        display: flex;
        margin: auto;
        width: 95%;
        max-width: 1200px;
    }

    .category-card {
        height: 120px;
        margin: 1em auto;
        position: relative;
        transform: translateZ(0);
        z-index: 2;
        -webkit-transition: transform .3s;
        -moz-transition: transform .3s;
        transition: transform .3s;
    }

    .category-wrapper {
        display: block;
        position: relative;
        height: 100%;
        width: 100%;
        color: inherit;
        transform-style: preserve-3d;
        transition: all 1s linear;
        cursor: pointer;
    }

    .category-wrapper:hover .category {
        color: inherit;
        transform: rotateX(180deg);
    }

    .category-wrapper:hover .category-back {
        transform: rotateX(0);
    }

    .category {
        display: flex;
        align-items: center;
        align-content: space-around;
        justify-content: center;
        position: absolute;
        top: 0;
        right: 0;
        width: 100%;
        height: 100%;
        flex-wrap: wrap;
        padding: 1.75em 2em;
        border: 1px solid rgba(0,0,0,.1);
        border-radius: 2px;
        background-color: #fff;
        backface-visibility: hidden;
        transform: rotateX(0deg);
        transition: .5s;
    }

    .category-back {
        display: flex;
        align-items: center;
        align-content: space-around;
        justify-content: center;
        position: absolute;
        top: 0;
        right: 0;
        width: 100%;
        height: 100%;
        background-color: #21bfc3;
        border-radius: 2px;
        color: #fff;
        font-size: .85em;
        transform: rotateX(-180deg);
        transition: .5s;
    }

    .category .category-icon,
    .category .category-label {
        flex-basis: 100%;
        text-align: center;
    }

    .category .category-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: .25em;
        width: 45px;
        max-width: 45px;
        height: 45px;
        border-radius: 100%;
        background-color: #21bfc3;
        color: #fff;
        font-size: 1.25em;
    }

    .item, .owl-item {
        /* max-width: 400px; */
    }

    .activity-card {
        border-radius: 2px;
    }
    
    .activity-card .card-body {
        padding: 0;
    }

    .acard-header {
        position: relative;
        overflow: hidden;
    }

    .acard-header .overlay {
        position: absolute;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: #242429;
        border-radius: 2px 2px 0 0;
        opacity: .4;
        transition: all .5s;
        z-index: 2;
    }

    .acard-header:hover .overlay {
        opacity: .7;
    }

    .acard-slider {
        transition: transform .5s;
    }

    .acard-image {
        width: 100%;
        height: 250px;
        border-radius: 2px 2px 0 0;
    }

    .acard-header:hover .acard-slider {
        transform: scale(1.05);
    }

    .acard-header .btn.btn-outline-primary,
    .acard-header .btn.btn-outline-primary:hover {
        position: absolute;
        top: 25px;
        left: 25px;
        color: #fff;
        font-size: .85em;
        border-color: rgba(255,255,255,.6);
        border-radius: 2px;
        background-color: transparent;
        z-index: 3;
    }

    .acard-header .btn.btn-outline-primary sup {
        color: rgba(200,200,200,.6);
    }

    .acard-header .item-info {
        position: absolute;
        bottom: 20px;
        left: 25px;
        color: #fff;
        z-index: 3;
    }

    .acard-header .item-info .item-title {
        font-size: 1.1em;
        font-weight: 400!important;
    }

    .acard-list {
        margin: 0;
        padding: 0;
    }

    .acard-list li {
        position: relative;
        list-style-type: none;
        margin-bottom: -1px;
        padding: 8px;
        width: 50%;
        font-size: 12px;
        color: #565662;
        float: left;
        border-bottom: 1px solid #dfe0e4;
    }

    .acard-list li:nth-child(odd):after {
        content: "";
        display: block;
        width: 1px;
        height: 100%;
        background-color: #dfe0e4;
        position: absolute;
        top: 0;
        right: 0;
    }

    .acard-list li i {
        padding-top: 6px;
        width: 30px;
        height: 30px;
        font-size: 16px;
        text-align: center;
    }

    .acard-list li span {
        margin-top: 8px;
    }

    .acard-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 8px;
    }

    .acard-button {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 8px;
        font-size: 10px;
        border: none;
        border-radius: 100%;
        background-color: #dcdcdc;
        cursor: pointer;
        -webkit-appearance: none;
        -moz-appearance: none;
    }

    .owl-carousel .owl-nav button.owl-prev,
    .owl-carousel .owl-nav button.owl-next {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px;
        width: 35px;
        height: 35px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 100%;
        -webkit-transition: background-color .5s ease;
        -moz-transition: background-color .5s ease;
        transition: background-color .5s ease;
        outline: none;
    }

    .owl-carousel .owl-nav button.owl-prev:hover,
    .owl-carousel .owl-nav button.owl-next:hover {
        background-color: #21bfc3;
        color: #fff;
    }

    /* Bottom section */
    .fa4-section#FooterBG {
        position: relative;
        margin-left: -15px;
        margin-right: -15px;
        margin-bottom: 0;
        height: 100vh;
        max-height: 800px;
        overflow-y: hidden;
        background-image: url('{{ config('app.url') }}storage/images/two-families-with-kids-sitting-on-front-stoops-P86Z5GU.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
    }

    .ab-overlay {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(transparent, 40%, #fff);
    }

    .ab-card-wrapper {
        display: flex;
        align-content: center;
        align-items: center;
        justify-content: center;
        position: relative;
        height: 100vh;
        max-height: 800px;
    }

    .ab-card {
        margin: .5em;
        padding: 3.25em 3.25em;
        background-color: #fff;
        border-radius: 2px;
        border: 1px solid #ccc;
        transition: .3s;
    }

    .ab-card:hover {
        background-color: #21bfc3;
        color: #fff;
        border-color: #21bfc3;
    }

    .ab-card:hover .ab-card-inner .ab-card-icon {
        color: #fff;
    }

    .ab-card .ab-card-inner {
        display: flex;
        align-items: center;
        align-content: space-around;
        justify-content: center;
        flex-wrap: wrap;
        width: 250px;
        height: 175px;
    }

    .ab-card .ab-card-inner span {
        flex-basis: 100%;
        text-align: center;
    }

    .ab-card .ab-card-inner .ab-card-icon {
        font-size: 2em;
        color: #21bfc3;
        transition: .3s;
    }

    .ab-card .ab-card-content .ab-card-title {
        font-size: 18px;
    }

    .ab-card .ab-card-content p {
        font-size: 13px;
        font-weight: 400!important;
    }

    #ScrollButton {
        display: none;
        align-items: center;
        justify-content: center;
        position: fixed;
        bottom: 32px;
        right: 32px;
        width: 50px;
        height: 50px;
        background-color: #fff;
        opacity: .9;
        border-radius: 100%;
        box-shadow: 4px 4px 40px 2px rgba(100,100,100,.4);
        cursor: pointer;
        font-size: .7em;
        z-index: 100;
        opacity: 0;
        transition: all .3s;
    }

    #ScrollButton:hover {
        bottom: 38px;
        background-color: #21bfc3;
        color: #fff;
    }

    @media screen and (max-width: 950px) {
        .home-banner .content h1 {
            margin-left: 15px;
            font-size: 2.25em;
            text-align: left;
        }

        .home-banner .content h3 {
            margin-left: 15px;
            font-size: 1.5em;
            text-align: left;
        }

        .home-banner .content .discovery-bar {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: auto;
            margin-top: 1em;
            width: 80%;
            border-radius: 2px;
        }

        .home-banner .content .discovery-bar .input-outter {
            display: flex;
            align-items: center;
            flex-basis: 100%;
            height: 50px;
        }

        .input-outter .input-wrapper {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .input-outter .input-wrapper .float-icon {
            position: absolute;
            right: .5em;
            top: 0;
            bottom: 0;
            margin-top: auto;
            margin-bottom: auto;
            height: 1.5em;
            color: #666;
        }

        #FindLocation {
            cursor: pointer;
        }

        .nu-select {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding-left: 15px;
            height: 100%;
            border: 2px solid #ccc;
            border-left: none;
            color: #666;
            transition: padding-left 100ms linear;
            cursor: pointer;
        }

        .nu-select.active {
            padding-left: 20px;
        }

        .nu-select-list {
            max-height: 0;
            overflow: hidden;
            transition: max-height 200ms linear;
        }

        .nu-select.active ~ .nu-select-list {
            max-height: 200px;
            overflow-y: scroll;
        }

        .nu-select-list .nu-select-option {
            padding: 10px 15px;
            transition: padding-left 200ms ease;
            cursor: pointer;
        }

        .nu-select-list .nu-select-option:hover {
            padding-left: 20px;
            color: #21bfc3;
        }

        .nu-select-list .nu-select-option.active {
            background-color: #21bfc3;
            color: #fff;
        }

        .nu-select-list .nu-select-option.active:hover {
            padding-left: 15px;
        }

        .input-outter .input-wrapper input,
        .input-outter .input-wrapper select {
            padding-left: 15px;
            width: 100%;
            height: 100%;
            border: 2px solid #ccc;
            outline: none;
            -webkit-appearance: none;
        }

        .input-outter .input-wrapper input {
            /* border-top-left-radius: 20px; */
            /* border-bottom-left-radius: 20px; */
            border-radius: 0;
        }

        .input-outter .input-wrapper select {
            border-left: none;
        }

        .home-banner .content .discovery-bar .end-cap {
            flex-basis: 100%;
        }

        .home-banner .content .discovery-bar button {
            display: flex;
            flex-basis: 100%;
            align-items: center;
            justify-content: center;
            padding: 1em 1em;
            width: 100%;
            height: 50px;
            background-color: #21bfc3;
            border: 2px solid #229fa2;
            border-radius: 0;
            /* border-top-right-radius: 20px; */
            /* border-bottom-right-radius: 20px; */
            color: #fff;
            -webkit-appearance: none;
            cursor: pointer;
        }
    }

    @media screen and (max-width: 1200px) {
        .ab-card {
            padding: 3em 2em;
        }

        .ab-card-inner {
            width: 200px;
        }
    }

    @media screen and (max-width: 1025px) {
        .ab-card {
            padding: 2.5em 1.75em;
        }

        .ab-card .ab-card-inner {
            width: 175px;
        }
    }

    @media screen and (max-width: 995px) {
        .ab-card-wrapper {
            flex-wrap: wrap;
        }

        .ab-card {
            flex-basis: 90%;
            margin: 1em auto;
            padding: 2.5em 1.75em;
        }

        .ab-card .ab-card-inner {
            width: 100%;
        }
    }

    @media screen and (max-width: 400px) {
        .background-layer video {
            min-width: unset;
            min-height: 100%;
        }
    }

    @keyframes fadeIn {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }

    @keyframes fadeOut {
        0% { opacity: 1; }
        100% { opacity: 0; }
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12 home-banner">
        <div class="row content">
            <h1>Discover more</h1>
            <h3>Your online community for local tutors, instructors and activities</h3>
            <form class="form discovery-bar" action="/explore" method="get">
                <div class="input-outter">
                    <div class="input-wrapper">
                        <input type="text" name="location" placeholder="Where is it located?">
                        <div class="float-icon" id="FindLocation"><i class="far fa-dot-circle"></i></div>
                    </div>
                </div>
                <div class="input-outter">
                    <div class="input-wrapper">
                        <select class="category-select" name="category">
                            <option value="all">All Categories</option>
                            <option value="sports">Sports</option>
                            <option value="clubs">Clubs</option>
                            <option value="arts">Arts</option>
                            <option value="development">Development</option>
                            <option value="academic">Academic</option>
                            <option value="music">Music</option>
                            <option value="cultural">Cultural</option>
                            <option value="volunteer">Volunteer</option>
                        </select>
                        <div class="float-icon"><i class="fas fa-chevron-down"></i></div>
                    </div>
                </div>
                <div class="end-cap">
                    <button type="submit">Search</button>
                </div>
            </form>
        </div>
        <div class="overlay"></div>
        <div class="background-layer">
            <video muted playsinline autoplay loop>
                <source src="{{ config('app.url') }}/images/FA4 Website Background.mp4" type="video/mp4">
            </video>
        </div>
    </div>
    <div class="col-12 discover-categories">
        <section class="fa4-section" style="margin-top: 2rem;">
            <div class="titles">
                <h6>Discover</h6>
                <h3>What are you looking for</h3>
            </div>
        </section>
        <section class="fa4-section">
            <div class="row categories">
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 category-card">
                    <div class="category-wrapper">
                        <div class="category">
                            <div class="category-icon"><i class="fas fa-futbol"></i></div>
                            <div class="category-label">Sports</div>
                        </div>
                        <div class="category-back">
                            <div class="category-label">0 Listings</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 category-card">
                    <div class="category-wrapper">
                        <div class="category">
                            <div class="category-icon"><i class="fas fa-users"></i></div>
                            <div class="category-label">Clubs</div>
                        </div>
                        <div class="category-back">
                            <div class="category-label">0 Listings</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 category-card">
                    <div class="category-wrapper">
                        <div class="category">
                            <div class="category-icon"><i class="fas fa-book"></i></div>
                            <div class="category-label">Arts</div>
                        </div>
                        <div class="category-back">
                            <div class="category-label">0 Listings</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 category-card">
                    <div class="category-wrapper">
                        <div class="category">
                            <div class="category-icon"><i class="far fa-handshake"></i></div>
                            <div class="category-label">Development</div>
                        </div>
                        <div class="category-back">
                            <div class="category-label">0 Listings</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 category-card">
                    <div class="category-wrapper">
                        <div class="category">
                            <div class="category-icon"><i class="fas fa-graduation-cap"></i></div>
                            <div class="category-label">Academic</div>
                        </div>
                        <div class="category-back">
                            <div class="category-label">0 Listings</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 category-card">
                    <div class="category-wrapper">
                        <div class="category">
                            <div class="category-icon"><i class="fas fa-music"></i></div>
                            <div class="category-label">Music</div>
                        </div>
                        <div class="category-back">
                            <div class="category-label">0 Listings</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 category-card">
                    <div class="category-wrapper">
                        <div class="category">
                            <div class="category-icon"><i class="fas fa-globe"></i></div>
                            <div class="category-label">Cultural</div>
                        </div>
                        <div class="category-back">
                            <div class="category-label">0 Listings</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 category-card">
                    <a href="#" class="category-wrapper">
                        <div class="category">
                            <div class="category-icon"><i class="fas fa-hands-helping"></i></div>
                            <div class="category-label">Volunteer</div>
                        </div>
                        <div class="category-back">
                            <div class="category-label">0 Listings</div>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </div>
    <div class="col-12">
        <section class="fa4-section">
            <div class="titles">
                <h6>Latest</h6>
                <h3>Activities</h3>
            </div>
        </section>
        <section class="fa4-section">
            <div class="owl-carousel owl-theme activity-slider">
                <div class="item">
                    <div class="card activity-card">
                        <div class="card-body">
                            <div class="acard-header">
                                <a href="#">
                                    <div class="overlay"></div>
                                    <div class="owl-carousel owl-theme acard-slider">
                                        <div class="item">
                                            <div class="acard-image" style="background-image: url('{{ config('app.url') }}/images/pexels-photo-730807.jpeg');"></div>
                                        </div>
                                    </div>
                                    <a class="btn btn-outline-primary">$150 <sup>Session</sup></a>
                                    <div class="item-info">
                                        <h4 class="item-title">West End Art Class</h4>
                                    </div>
                                </a>
                            </div>
                            <div class="acard-footer">
                                <ul class="acard-list">
                                    <li>Local</li>
                                    <li>Teen friendly</li>
                                </ul>
                                <div class="acard-buttons">
                                    <button class="acard-button" data-toggle="tooltip" data-placement="top" title="Watch"><i class="fas fa-binoculars"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card activity-card">
                        <div class="card-body">
                            <div class="acard-header">
                                <a href="#">
                                    <div class="overlay"></div>
                                    <div class="owl-carousel owl-theme acard-slider">
                                        <div class="item">
                                            <div class="acard-image" style="background-image: url('{{ config('app.url') }}/images/pexels-photo-733854.jpeg');"></div>
                                        </div>
                                    </div>
                                </a>
                                <a class="btn btn-outline-primary">$750 <sup>Term</sup></a>
                                <div class="item-info">
                                    <h4 class="item-title">After School Art Club</h4>
                                </div>
                            </div>
                            <div class="acard-footer">
                                <ul class="acard-list">
                                    <li>Local</li>
                                    <li>Teen friendly</li>
                                </ul>
                                <div class="acard-buttons">
                                    <button class="acard-button" data-toggle="tooltip" data-placement="top" title="Watch"><i class="fas fa-binoculars"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card activity-card">
                        <div class="card-body">
                            <div class="acard-header">
                                <a href="#">
                                    <div class="overlay"></div>
                                    <div class="owl-carousel owl-theme acard-slider">
                                        <div class="item">
                                            <div class="acard-image" style="background-image: url('{{ config('app.url') }}/images/pexels-photo-296302.jpeg');"></div>
                                        </div>
                                    </div>
                                </a>
                                <a class="btn btn-outline-primary">$750 <sup>Term</sup></a>
                                <div class="item-info">
                                    <h4 class="item-title">After School Art Club</h4>
                                </div>
                            </div>
                            <div class="acard-footer">
                                <ul class="acard-list">
                                    <li>Local</li>
                                    <li>Teen friendly</li>
                                </ul>
                                <div class="acard-buttons">
                                    <button class="acard-button" data-toggle="tooltip" data-placement="top" title="Watch"><i class="fas fa-binoculars"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card activity-card">
                        <div class="card-body">
                            <div class="acard-header">
                                <a href="#">
                                    <div class="overlay"></div>
                                    <div class="owl-carousel owl-theme acard-slider">
                                        <div class="item">
                                            <div class="acard-image" style="background-image: url('{{ config('app.url') }}/images/pexels-photo-730807.jpeg');"></div>
                                        </div>
                                    </div>
                                    <a class="btn btn-outline-primary">$750 <sup>Term</sup></a>
                                    <div class="item-info">
                                        <h4 class="item-title">After School Art Club</h4>
                                    </div>
                                </a>
                            </div>
                            <div class="acard-footer">
                                <ul class="acard-list">
                                    <li>Local</li>
                                    <li>Teen friendly</li>
                                </ul>
                                <div class="acard-buttons">
                                    <button class="acard-button" data-toggle="tooltip" data-placement="top" title="Watch"><i class="fas fa-binoculars"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card activity-card">
                        <div class="card-body">
                            <div class="acard-header">
                                <a href="#">
                                    <div class="overlay"></div>
                                    <div class="owl-carousel owl-theme acard-slider">
                                        <div class="item">
                                            <div class="acard-image" style="background-image: url('{{ config('app.url') }}/images/pexels-photo-733854.jpeg');"></div>
                                        </div>
                                    </div>
                                </a>
                                <a class="btn btn-outline-primary">$750 <sup>Term</sup></a>
                                <div class="item-info">
                                    <h4 class="item-title">After School Art Club</h4>
                                </div>
                            </div>
                            <div class="acard-footer">
                                <ul class="acard-list">
                                    <li>Local</li>
                                    <li>Teen friendly</li>
                                </ul>
                                <div class="acard-buttons">
                                    <button class="acard-button" data-toggle="tooltip" data-placement="top" title="Watch"><i class="fas fa-binoculars"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card activity-card">
                        <div class="card-body">
                            <div class="acard-header">
                                <a href="#">
                                    <div class="overlay"></div>
                                    <div class="owl-carousel owl-theme acard-slider">
                                        <div class="item">
                                            <div class="acard-image" style="background-image: url('{{ config('app.url') }}/images/pexels-photo-296302.jpeg');"></div>
                                        </div>
                                    </div>
                                </a>
                                <a class="btn btn-outline-primary">$750 <sup>Term</sup></a>
                                <div class="item-info">
                                    <h4 class="item-title">After School Art Club</h4>
                                </div>
                            </div>
                            <div class="acard-footer">
                                <ul class="acard-list">
                                    <li>Local</li>
                                    <li>Teen friendly</li>
                                </ul>
                                <div class="acard-buttons">
                                    <button class="acard-button" data-toggle="tooltip" data-placement="top" title="Watch"><i class="fas fa-binoculars"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="fa4-section" id="FooterBG">
            <div class="ab-overlay"></div>
            <div class="ab-card-wrapper">
                <div class="ab-card">
                    <div class="ab-card-inner">
                        <span class="ab-card-icon">
                            <i class="fas fa-thumbs-up"></i>
                        </span>
                        <span class="ab-card-content">
                            <h5 class="ab-card-title">Safe</h5>
                            <p>With access to Giver bios & activity reviews from our community, you can register for activities for your kids with peace of mind.</p>
                        </span>
                    </div>
                </div>
                <div class="ab-card">
                    <div class="ab-card-inner">
                        <span class="ab-card-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </span>
                        <span class="ab-card-content">
                            <h5 class="ab-card-title">Affordable</h5>
                            <p>Find activities that fit your family's budget — with sorting & filtering tools as well as exclusive prices, you're bound to find something that fits!</p>
                        </span>
                    </div>
                </div>
                <div class="ab-card">
                    <div class="ab-card-inner">
                        <span class="ab-card-icon">
                            <i class="fas fa-handshake"></i>
                        </span>
                        <span class="ab-card-content">
                            <h5 class="ab-card-title">Reliable</h5>
                            <p>Through peer reviews & moderation, our priority is making sure our platform is consistent & reliable for everyone. We're always here to help.</p>
                        </span>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<div id="ScrollButton"><i class="fas fa-chevron-up"></i></div>
@endsection
@section('page_scripts')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWiHuicU8IMxIh9doxd-_-0Oh0I4MzGhc&libraries=places"></script>
<script>
    document.body.onload = function() {
        document.querySelector('.background-layer video').play();
        var offset = document.documentElement.scrollTop + 200;

        if(offset > document.querySelector('.discover-categories').offsetTop) {
            document.querySelector("#ScrollButton").style.display = "flex";
            document.querySelector("#ScrollButton").style.opacity = 1;
        }
        setTimeout(function(){
            $(".load-overlay").fadeOut('slow');
        }, 600);

        replaceSelect('.category-select');

        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    }

    function replaceSelect(element) {
        select = document.querySelector(element);

        select.style.display = "none";

        var dropdown = document.createElement('div');
        dropdown.className = 'nu-select';
        dropdown.innerHTML = select.options[select.selectedIndex].text;
        select.parentElement.appendChild(dropdown);

        var dropdownList = document.createElement('div');
        dropdownList.className = 'nu-select-list';
        dropdownList.style.position = 'absolute';
        dropdownList.style.top = '100%';
        dropdownList.style.width = '100%';
        dropdownList.style.backgroundColor = '#fff';

        for(var key in select.options) {
            if(key > 0) {
                var dropdownOption = document.createElement('div');
                
                dropdownOption.className = 'nu-select-option';
                dropdownOption.innerHTML = select.options[key].text;
                dropdownOption.setAttribute('data-index', key);

                dropdownList.appendChild(dropdownOption);
            }
        }
        
        select.parentElement.appendChild(dropdownList);

        $('.nu-select').on('click', function(){
            if($(this).hasClass('active')) {
                $(this).removeClass('active');
            }
            else {
                $(this).addClass('active');

                $('.nu-select-option').on('click', function(){
                    $('.nu-select-option.active').removeClass('active');
                    $(this).addClass('active');
                    select.selectedIndex = this.getAttribute('data-index');
                    $('.nu-select').html(select.options[select.selectedIndex].text);
                    $('.nu-select').removeClass('active');
                });
            }
        });

        $("#ScrollButton").on('click', function(){
            $('html, body').animate({
                scrollTop: 0
            });
        });

        $(window).on('scroll', function(){
            var offset = document.documentElement.scrollTop + 200;

            if(offset > document.querySelector('.discover-categories').offsetTop) {
                document.querySelector("#ScrollButton").style.display = "flex";
                document.querySelector("#ScrollButton").style.animation = "fadeIn 600ms ease forwards";
            }
            else {
                document.querySelector("#ScrollButton").style.animation = "fadeOut 600ms ease forwards";
                setTimeout(function() {
                    document.querySelector("#ScrollButton").style.display = "flex";
                }, 600);
            }
        });
    }

    $(".activity-slider").owlCarousel({
        loop: true,
        margin: 20,
        nav: true,
        dots: false,
        responsiveClass: true,
        mouseDrag: false,
        touchDrag: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1700: {
                items: 4
            }
        },
    });

    $(".acard-slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1
    });

    $("#FindLocation").on("click", function(){
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(function(position){
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                }
                $('input[name=location]').val(pos.lat);
            })
        }
    });
    
    var locationInput = document.querySelector("input[name=location]");
    var opts = {
        types: ['(cities)'],
        componentRestrictions: { country: 'ca' }
    };

    var autoComplete = new google.maps.places.Autocomplete(locationInput, opts);
</script>
@endsection