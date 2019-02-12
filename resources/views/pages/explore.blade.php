@extends('layouts.layout')

@section('page_styles')
<link rel="stylesheet" href="{{ config('app.url') }}css/jquery.mCustomScrollbar.css">
<style>
    h1 {
        text-align: center;
    }

    .card {
        margin-bottom: 1em;
    }

    .activity-results {
        margin: auto;
        padding-top: 3rem;
        max-width: 1200px;
    }

    .activity-results .results-header,
    .activity-results .results-header h6 {
        font-weight: 400;
        font-size: .8rem;
    }

    .activity-results .results-header a {
        color: inherit;
        transition: .3s;
    }

    .activity-results .results-header a:hover {
        color: #21bfc3;
        position: relative;
        z-index: 500;
    }

    .activity-results .results-header i {
        font-size: .75rem;
    }

    .activity-results .results-header {
        margin-bottom: 1rem;
    }

    .activity-card {
        opacity: 0;
        border-radius: 2px;
        transition: .3s;
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
        background-size: cover;
        background-repeat: no-repeat;
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

    /* Filters */
    .filters {
        display: block;
        position: fixed;
        top: 0;
        left: -100%;
        z-index: 1001;
        width: 100%;
        max-width: 400px;
        height: 100%;
        background-color: #fff;
        transition: .3s;
    }

    .filters-overlay {
        display: none;
        opacity: 0;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .7);
        transition: .3s;
    }

    .filters .filters-scroll {
        height: 98%;
        overflow: hidden;
    }

    .filters .filters-inner {
        display: block;
        margin: auto;
        width: 86%;
        /* height: 98%; */
    }

    /* .mCustomScrollBox {
        overflow: unset;
    } */

    .mCSB_inside > .mCSB_container {
        margin-right: unset;
    }

    /* .mCSB_scrollTools {
        right: -3%;
    } */

    .filters .filters-inner .filters-header {
        display: block;
        padding: 2em 1em;
        padding-bottom: 1em;
    }

    .filters .filters-inner .filters-header h5 {
        text-align: center;
        font-weight: 300;
    }

    .filters .filters-inner .filters-header p {
        text-align: center;
        font-weight: 300;
        font-size: .8rem;
    }

    .filters .filters-inner .filters-tabs {
        display: flex;
        justify-content: space-around;
        width: 100%;
    }

    .filters .filters-inner .filters-tabs .filters-tab {
        margin: .161616%;
        padding-bottom: 1.35rem;
        width: 33%;
        text-align: center;
        font-size: .825rem;
        font-weight: 300;
        border-bottom: 1px solid rgba(0,0,0,.25);
        cursor: pointer;
    }

    .filters .filters-inner .filters-tabs .filters-tab i {
        margin-bottom: .65em;
        font-size: 1.25rem;
        transition: .3s;
    }

    .filters .filters-inner .filters-tabs .filters-tab.active {
        border-bottom: 2px solid #21bfc3;
    }

    .filters .filters-inner .filters-tabs .filters-tab:hover i,
    .filters .filters-inner .filters-tabs .filters-tab.active i {
        color: #21bfc3;
    }

    .filters .form .form-group {
        margin-top: 1rem;
    }

    .filters-dismiss {
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        top: 10px;
        right: 10px;
        width: 30px;
        height: 30px;
        color: #666;
        opacity: .8;
        text-shadow: 1px 1px 1px rgba(0,0,0,.1);
        font-size: 1.15em
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .category-tile {
        display: block;
        margin: 1em auto;
        position: relative;
        width: 100%;
        height: 175px;
        cursor: pointer;
    }

    .category-tile .tile-background {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center center;
    }

    .category-tile .tile-overlay {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #333;
        opacity: .7;
        -webkit-transition: .3s;
        -moz-transition: .3s;
        transition: .3s;
    }

    .category-tile:hover .tile-overlay {
        opacity: .9;
    }

    .category-tile .tile-content {
        display: flex;
        align-content: space-between;
        flex-wrap: wrap;
        padding: 2em;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        color: #fff;
    }

    .category-tile .tile-content .tile-item {
        flex-basis: 100%;
    }

    .category-tile .tile-content .tile-item i {
        font-size: 1.5rem;
    }
    
    .category-tile .tile-content .tile-item p {
        margin-bottom: 0;
        font-size: .75rem;
        font-weight: 600;
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

    select[name=sorting] {
        border: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }

    @media screen and (min-width: 500px) {
        .filters-dismiss { display: none; }
    }
</style>
@endsection

@section('content')
<div class="filters">
    <div class="filters-scroll">
        <div class="filters-dismiss"><i class="fas fa-times"></i></div>
        <div class="filters-inner">
            <div class="filters-header">
                <h5>What are you looking for?</h5>
                <p>Search or select categories</p>
            </div>
            <div class="filters-tabs">
                {{-- <div class="filters-tab" data-target="#Sessions">
                    <div class="tab-icon"><i class="far fa-clock"></i></div>
                    <div class="tab-label">All</div>
                </div> --}}
                <div class="filters-tab active" data-target="#Filters">
                    <div class="tab-icon"><i class="fas fa-sliders-h"></i></div>
                    <div class="tab-label">Filters</div>
                </div>
                <div class="filters-tab" data-target="#Categories">
                    <div class="tab-icon"><i class="far fa-bookmark"></i></div>
                    <div class="tab-label">Categories</div>
                </div>
            </div>
            <div class="filters-tab-content">
                <div class="tab-content active" id="Filters">
                    <form class="form">
                        <div class="form-group">
                            <input class="form-control" name="" placeholder="What are you looking for?">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="categories">
                                <option value="">Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->category }}">{{ $category->category }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="location" placeholder="Where are you looking?">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block">Search</button>
                        </div>
                    </form>
                </div>
                <div class="tab-content" id="Categories">
                @foreach($categories as $category)
                <div class="category-tile">
                    <div class="tile-background" style="background-image: url('/storage{{ $category->category_img }}')"></div>
                    <div class="tile-overlay"></div>
                    <div class="tile-content">
                        <div class="tile-item">{!! $category->category_icon !!}</div>
                        <div class="tile-item">
                            <div>{{ $category->category }}</div>
                            <p>{{ $category->total }} listings</p>
                        </div>
                    </div>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="filters-overlay"></div>
<div class="row activity-results">
    <div class="col-lg">
        <div class="row results-header">
            <div class="col-4">
                <a href="#" id="Search" style="text-decoration: none;"><i class="fas fa-sliders-h"></i> Search Filters</a>
            </div>
            <div class="col-4">
                <h6 style="text-align: center;"><span id="ResultsCount">0</span> result(s)</h6>
            </div>
            <div class="col-4" style="text-align: right;">
                <div style="text-decoration: none;">
                    <i class="fas fa-bars"></i>
                    <select name="sorting">
                        <option value="latest">Latest</option>
                        <option value="price-lowest">Price (Lowest)</option>
                        <option value="price-highest">Price (Highest)</option>
                    </select>
                </div>
            </div>
        </div>
        <div id="ResultsList"></div>
    </div>
</div>
@endsection

@section('page_scripts')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWiHuicU8IMxIh9doxd-_-0Oh0I4MzGhc&libraries=places"></script>
<script src="{{ config('app.url') }}js/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
    var qLength = window.location.search.length;
    var queryString = window.location.search.slice(1, qLength);
    var queryParams = queryString.split('&');
    var searchParams = {};

    for(var key in queryParams) {
        if(key >= 0 && queryParams[0] != "") {
            var param = queryParams[key];
            var params = param.split('=');
            var paramVar = params[1].replace(/%2C/g, ',');
            paramVar = paramVar.replace(/[+]/g,' ');
            if(paramVar != 'all')
                searchParams[params[0]] = paramVar;
        }
    }

    console.log(searchParams);

    var loadActivities = function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.post('{{ config('app.url') }}explore_list', searchParams)
            .done(function(data){
                $("#ResultsList").html(data);
                initCode();
                var count = document.querySelectorAll('.card').length;
                var cards = document.querySelectorAll('.activity-card');
                $("#ResultsCount").html(count);

                for(var key in cards) {
                    if(key >= 0) {
                        var card = cards[key];
                        card.style.opacity = 1;
                    }
                }

                $('.watch').on('click', addToList);
            });
    }
    loadActivities();

    addToList = function() {
        var aID = this.getAttribute('data-id');

        var btn = this;
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.post('{{config('app.url')}}watch-list/add', { activity_id: aID })
            .done(function(data){

                btn.innerHTML = "<i class='fas fa-check'></i>";
            });
    }

    $("#Search").on("click", function(e){
        e.preventDefault();

        document.querySelector(".filters-overlay").style.display = "block";
        setTimeout(function() {
            document.querySelector(".filters-overlay").style.opacity = 1;
            document.querySelector(".filters").style.left = 0;
        }, 300);
    });

    $(".filters-overlay").on("click", function(){
        document.querySelector(".filters-overlay").style.opacity = 0;
        document.querySelector(".filters").style.left = "-100%";

        setTimeout(function(){
            document.querySelector(".filters-overlay").style.display = "none";
        },300);
    });

    $('.filters-dismiss').on('click', function(){
        document.querySelector(".filters-overlay").style.opacity = 0;
        document.querySelector(".filters").style.left = "-100%";

        setTimeout(function(){
            document.querySelector(".filters-overlay").style.display = "none";
        },300);
    });

    var initCode = function() {
        $(".acard-slider").owlCarousel({
            loop: true,
            margin: 0,
            items: 1,
            dots: false
        });
    }

    $('.filters-scroll').mCustomScrollbar({
        theme: "minimal-dark"
    });

    $(".filters-tab").on("click", function(){
        if(!$(this).hasClass('active')) {
            $('.filters-tab.active').removeClass('active');
            $('.tab-content.active').removeClass('active');

            var tg = this.getAttribute('data-target');
            $(tg).addClass('active');
            $(this).addClass('active');
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