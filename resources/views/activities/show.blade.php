@extends('layouts.layout')

@section('page_styles')
<style>
    .calendar {
        margin-top: .25em;
        padding: 0;
        max-height: 0;
        border: none;
        overflow: hidden;
        transition: max-height 300ms linear, padding 300ms linear, border 300ms ease;
    }

    .calendar.active {
        padding: .25em;
        max-height: 1000px;
        border: 1px solid #ccc;
    }

    .cal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .cal-month {
        font-size: 1.5em;
        font-weight: 600;
    }

    .cal-prev, .cal-next {
        font-size: 1.5em;
    }

    .cal-days {
        display: flex;
        flex-wrap: wrap;
    }

    .cal-days div {
        padding: .5em 0;
        width: 14.285%;
    }

    .cal-body {
        display: flex;
        flex-wrap: wrap;
    }

    .cal-body .day {
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #ececec;
    }

    .cal-body .day.active {
        background-color: #fff;
        cursor: pointer;
        transition: background-color 600ms ease;
    }

    .cal-body .day.active:hover {
        background-color: #ececec;
    }

    .cal-body .day.space {
        background-color: #fff;
        border: 1px solid #fff;
    }

    .cal-body .day.inactive {
        color: #ccc;
        text-decoration: line-through;
    }

    .col.inner-content {
        margin: auto;
        max-width: 1175px;
    }

    .col.inner-content .row {
        display: block;
    }

    .col.col.inner-content .row .col-md-6 {
        margin-bottom: 1.5rem;
        position: relative;
        top: 0;
        float: left;
    }

    .col-md-6 .card {
        margin: auto;
        width: 100%;
        border-radius: 2px;
        font-size: 13px;
    }

    .card .card-header {
        display: flex;
        align-items: center;
        background-color: inherit;
        border-bottom: none;
    }

    .card .card-header i {
        padding-right: 5px;
        font-size: 16px;
        color: #c7cdcf;
    }

    .owl-carousel.owl-theme#HeaderCarousel .item {
        background-size: cover!important;
    }

    .owl-carousel.owl-theme#HeaderCarousel .item .item-overlay {
        height: 100%;
        background-color: rgba(50, 50, 50, .6);
        -webkit-transition: .3s;
        -moz-transition: .3s;
        transition: .3s;
        cursor: pointer;
    }

    .owl-carousel#HeaderCarousel .item:hover .item-overlay {
        background: transparent;
    }

    .row.listing-content { background-color: #fafafa; }

    .col-12.listing-header {
        margin-bottom: 3rem;
        padding: 1em 0;
        border-bottom: 1px solid rgba(0,0,0,.125);
        background-color: #fff;
    }

    .col-12.listing-header .header-inner {
        display: flex;
        margin: auto;
        width: 84%;
        font-size: 12px;
    }

    .col-12.listing-header .header-inner h5 {
        font-weight: 300;
    }

    .col-12.listing-header .header-inner p {
        margin: 0;
        padding: 0;
        font-size: 13px;
        font-weight: 400;
        color: #7e7e89;
    }

    .btn,
    .btn.btn-primary.score {
        padding: .75em;
        border-radius: 2px;
        font-size: 1.15em;
    }

    .btn sup {
        top: -.45em;
        font-size: .55em;
        text-transform: uppercase;
    }

    .btn.btn-default,
    .btn.btn-outline-light {
        margin: 10px;
    }

    .btn.btn-outline-light {
        margin: 5px;
        padding: .95em;
        font-weight: 300;
        font-size: 1em;
    }

    .btn.btn-outline-light i {
        padding-right: 5px;
    }

    .btn.btn-outline-light:hover {
        background-color: inherit;
        color: inherit;
    }

    .btn.btn-default {
        background-color: #fff;
        color: #21bfc3;
    }

    .btn.btn-primary {
        background-color: #21bfc3;
        border-color: #21bfc3;
        font-size: 1.05em;
    }

    .btn.btn-primary:hover {
        background-color: #f1c634;
        border-color: #f1c634;
    }

    .btn.btn-primary.score {
        padding: .6em .95em;
        font-size: 1.25em;
    }

    .btn.btn-primary.score:hover {
        background-color: #21bfc3;
        border-color: #21bfc3;
    }

    .btn.btn-primary.back {
        background-color: #f1c634;
        border-color: #f1c634;
    }

    .carousel-overlay {
        display: block;
        position: absolute;
        bottom: 20px;
        z-index: 20;
        width: 100%;
    }

    .overlay-inner {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin: auto;
        width: 80%;
        color: #fff;
        font-size: 13px;
    }

    .overlay-inner .address {
        margin: 15px;
    }

    .term-label,
    .term-dates {
        display: block;
        margin: 0;
        padding: 0;
        text-align: center;
        color: rgba(0,0,0,.45)
    }

    .term-dates {
        font-size: 1.5em;
        color: #666;
    }

    #Map {
        margin: auto;
        width: 100%;
        height: 300px;
    }

    #PaymentModal .modal-dialog .modal-content {
        transition: .5s;
    }

    #PaymentModal h4,
    #PaymentModal h5,
    #PaymentModal h6 {
        text-align: center;
        font-weight: 600;
        color: #111;
    }

    #PaymentModal .terms {
        font-size: .65em;
    }

    #PaymentModal #ChildSelect .children-inner .child {
        margin-bottom: .15em;
        padding: 1em .5em;
        position: relative;
        border: 1px solid #000;
        text-align: right;
        transition: .4s;
        cursor: pointer;
    }

    #ChildSelect { display: block; }

    #ChildSelect select[name=child] {
        padding: 8px 7px;
        width: 100%;
        border: 1px solid #ccc;
        font-weight: 600;
        font-family: inherit;
        -webkit-appearance: none;
        -moz-appearance: none;
    }

    #ChildSelect .children-inner {
        margin: .25em 0;
    }

    .children-inner .child:hover {
        background-color: rgba(33, 191, 195, .25);
    }

    .children-inner .child.active {
        background-color: rgba(33, 191, 195, .85);
    }

    .panel {
        display: none;
        margin-bottom: 1em;
        text-align: center;
    }

    #PaymentProgress i,
    #PaymentSuccess i {
        margin-bottom: .5em;
        font-size: 5em;
    }

    #PaymentProgress div,
    #PaymentSuccess div {
        margin: 1em auto;
        text-align: center;
        font-size: .75em;
    }

    #ReviewBooking span {
        color: #ccc;
        text-decoration: underline;
    }

    #CartSummary .cart {
        margin: auto;
        margin-bottom: .5em;
        /* width: 80%; */
    }

    #CartSummary .fee {
        display: flex;
        justify-content: space-between;
        font-weight: 900;
        color: #ccc;
        font-size: 1.25em;
    }

    #CartSummary .fee.header {
        margin: 1em 0;
    }

    #CartSummary .fee.small {
        font-size: .95em;
    }

    #CartSummary .fee.footer {
        margin: 1em 0;
        border-top: 1px solid #aaa;
    }

    #CartSummary .fee.footer .total {
        color: #bbb;
    }
</style>
@endsection

@section('content')
<div class="modal fade" role="dialog" id="PaymentModal">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div id="ChildSelect" class="panel">
                    <div>
                        <img src="/storage/images/family.jpg">
                    </div>
                    <h5>Choose a child to register!</h5>
                @guest
                @else
                    <div class="children-inner">
                        <select name="child">
                        @foreach($children as $child)
                            <option value="{{$child->id}}">
                                {{$child->name}}
                            </option>
                        @endforeach
                        </select>
                    </div>
                @endguest
                    <div class="form-group">
                        <button class="btn btn-primary btn-block next">Continue</button>
                    </div>
                </div>
                <div id="ReviewBooking" class="panel">
                    <h5>Review your registration!</h5>
                    <p style="margin-top: .5em; font-weight: 600; text-align: left;">You're registering <span id="Child" class=""></span> for <span class="">{{ $activity->name }}</span></p>
                    <div style="margin: 1em 0; text-align: left;">
                        @php
                            $date = DateTime::createFromFormat('Y-m-d H:i:s', $activity->terms->start);
                            $dFormatted = $date->format("D M j, Y");
                        @endphp
                        <p style="margin: 0; font-weight: 600;">Term starts {{$dFormatted}}</p>
                        @php
                            $date = DateTime::createFromFormat('Y-m-d H:i:s', $activity->terms->end);
                            $dFormatted = $date->format("D M j, Y");
                        @endphp
                        <p style="margin: 0; font-weight: 600;">Term ends {{$dFormatted}}</p>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block back">Back</button>
                        <button class="btn btn-primary btn-block next">Continue</button>
                    </div>
                </div>
                <div id="CartSummary" class="panel">
                    <h5>You're all set, one last step!</h5>
                    <div class="cart">
                        <div class="fee header">
                            <span>Term Fee</span>
                            <span>${{$activity->price}}</span>
                        </div>
                        <div class="fee small">
                            <span>ForAfter4 Fee</span>
                            <span>${{$fa4Fee}}</span>
                        </div>
                        <div class="fee small">
                            <span>Tax</span>
                            <span>${{$taxes}}</span>
                        </div>
                        <div class="fee footer">
                            <span>Total</span>
                            <span class="total">${{$total}}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block back">Back</button>
                            <button class="btn btn-primary btn-block next">Pay Now</button>
                        </div>
                    </div>
                </div>
                <form class="form panel" id="PaymentForm" style="display: none;">
                    <h5>Pay & finish registration!</h5>
                    <div class="row" style="margin-top: .85em;">
                        <div class="form-group col-12">
                            <div id="CardNumber"></div>
                        </div>
                        <div class="form-group col-9">
                            <div id="CardExpiry"></div>
                        </div>
                        <div class="form-group col-3">
                            <div id="CardCVV"></div>
                        </div>
                        <div class="form-group col-12">
                            <div id="CardErrors" role="alert"></div>
                        </div>
                        <div class="payment-options col-12" style="margin-bottom: .5em; text-align: center;">
                            <i class="fab fa-cc-visa fa-2x"></i>
                            <i class="fab fa-cc-mastercard fa-2x"></i>
                            <i class="fab fa-cc-amex fa-2x"></i>
                        </div>
                        <div class="form-group col-12">
                            <button class="btn btn-primary btn-block back">Back</button>
                            <button class="btn btn-primary btn-block">Pay Now</button>
                        </div>
                    </div>
                    <div class="terms">
                        <p>By booking this session or term, you agree to our <a href="#">terms of service.</a></p>
                    </div>
                </form>
                <div id="PaymentProgress" style="display: none; color: #21bfc3;" class="panel">
                    <i class="fas fa-spinner fa-pulse"></i>
                    <div>Processing your payment</div>
                </div>
                <div id="PaymentSuccess" class="panel">
                    <i class="far fa-check-circle"></i>
                    <div>Booking successful!</div>
                </div>
                <div id="PaymentFailed" class="panel"></div>
            </div>
        </div>
    </div>
</div>
{{-- Message Modal --}}
<div class="modal fade" id="ContactModal">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Contact giver</h5>
            </div>
            <div class="modal-body">
                <form class="form" method="post">
                    <div class="form-group">
                        <input type="hidden" name="activity_id" value="{{$activity->id}}">
                        <textarea class="form-control" name="message" placeholder="What do you want to ask this giver?"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" id="SendMessage">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- No Child Alert --}}
<div class="modal fade" id="NoChild">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Whoops...</h5>
            </div>
            <div class="modal-body">
                <p>Please add your children to your profile before trying to book an activity.</p>
            </div>
            <div class="modal-footer">
                <a href="/hub/my-children" class="btn btn-primary btn-block">Add children</a>
            </div>
        </div>
    </div>
</div>
<div class="row listing-content">
    <div class="col-12" style="padding: 0;">
        <div class="owl-carousel owl-theme" id="HeaderCarousel">
            @if(count($media) > 0)
                @foreach($media as $item)
                    <div class="item" style="height: 380px; background: 50% no-repeat; background-image: url('/storage/{{ $item->img_url }}');">
                        <div class="item-overlay"></div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="carousel-overlay">
            <div class="overlay-inner">
                <div class="address">
                    <i class="fas fa-map-marker-alt" style="margin-right: 8px;"></i>
                    {{ $activity->location }}
                </div>
                <button class="btn btn-default">
                    ${{ $activity->price }} <sup>{{ $activity->term }}</sup>
                </button>
                <button class="btn btn-primary score">
                    9<sup>/10</sup>
                </button>
                <button class="btn btn-outline-light" style="margin-left: 10px;"><i class="far fa-comment-alt"></i> Add review</button>
                <button class="btn btn-outline-light"><i class="fas fa-binoculars"></i> Watch</button>
            </div>
        </div>
    </div>
    <div class="col-12 listing-header">
        <div class="header-inner">
            <div class="header-info">
                <h5>{{ $activity->name }}</h5>
                <p>{{ $activity->tagline }}</p>
            </div>
        </div>
    </div>
    <div class="col inner-content">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="owl-carousel owl-theme" id="InnerCarousel">
                    @if(count($media) > 0)
                        @foreach($media as $item)
                            <div class="item">
                                <img src="/storage/{{ $item->img_url }}">
                            </div>
                        @endforeach
                    @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><i class="fas fa-calendar-alt"></i> Book</div>
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        @if($activity->term == "term")
                        <div class="form-group">
                            <label class="term-label">Term Starts:</label>
                            <div class="term-dates">
                            @php
                                $date = DateTime::createFromFormat('Y-m-d H:i:s', $activity->terms->start);
                                echo $date->format("D M j, Y");
                            @endphp
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="term-label">Term End:</label>
                            <div class="term-dates">
                            @php
                                $date = DateTime::createFromFormat('Y-m-d H:i:s', $activity->terms->end);
                                echo $date->format("D M j, Y");
                            @endphp
                            </div>
                        </div>
                        <div class="form-group">
                            @guest
                            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#LoginModal">Book now</button>
                            @else
                            @if(count($children) > 0)
                            <button class="btn btn-primary btn-block" id="BookTerm" data-toggle="modal" data-target="#PaymentModal">Book now</button>
                            @else
                            <button class="btn btn-primary btn-block" id="BookTerm" data-toggle="modal" data-target="#NoChild">Book now</button>
                            @endif
                            @endguest
                        </div>
                        @else
                        <div class="form-group">
                            <label for="date">Session Date</label>
                            <input class="form-control" name="date">
                            <div class="calendar">
                                <div class="cal-header">
                                    <button class="btn btn-outline-dark cal-prev"><i class="fas fa-long-arrow-alt-left"></i></button>
                                    <span class="cal-month"></span>
                                    <button class="btn btn-outline-dark cal-next"><i class="fas fa-long-arrow-alt-right"></i></button>
                                </div>
                                <div class="cal-days">
                                    <div>Su</div>
                                    <div>Mo</div>
                                    <div>Tu</div>
                                    <div>We</div>
                                    <div>Th</div>
                                    <div>Fr</div>
                                    <div>Sa</div>
                                </div>
                                <div class="cal-body"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="time">Session Time</label>
                            <select class="form-control" name="time">
                                <option>11:00am - 12:30pm</option>
                                <option>12:30pm - 2:00pm</option>
                                <option>2:00pm - 3:30pm</option>
                            </select>
                        </div>
                        <div class="form-group">
                            @guest
                            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#LoginModal">Book now</button>
                            @else
                            <button class="btn btn-primary btn-block">Book now</button>
                            @endguest
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><i class="fas fa-info-circle"></i> Activity description</div>
                    <div class="card-body">
                        {{ $activity->description }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><i class="fas fa-info-circle"></i> Giver Bio</div>
                    <div class="card-body">
                        This giver has not provided their bio yet
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><i class="fas fa-grip-horizontal"></i> Category</div>
                    <div class="card-body">
                        <div class="category-wrapper">
                            <div class="category-icon"></div>
                            <div class="category-text">Sports</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><i class="fas fa-map"></i> Location</div>
                    <div class="card-body">
                        <div id="Map"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><i class="fas fa-envelope"></i> Contact</div>
                    <div class="card-body">
                        @guest
                        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#LoginModal">Contact giver</button>
                        @else
                        <button class="btn btn-primary btn-block" id="ContactGiver" data-toggle="modal" data-target="#ContactModal">Contact giver</button>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_scripts')
<script>
    /* Carousel/Image sliders */
    $('#HeaderCarousel').owlCarousel({
        loop: false,
        nav: false,
        dots: false
    });

    $("#InnerCarousel").owlCarousel({
        loop: false,
        items: 1,
        nav: false,
        dots: false
    });

    /* Calendar */

    var cal = document.querySelector(".calendar");

    var date = new Date();
    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    
    function getDays(month, year) {
        return new Date(year, month, 0).getDate();
    }

    function getOffset(month, year) {
        return new Date(year, month, 1).getDay();
    }

    $("input[name=date]").on('focus', function(){
        if(!$(".calendar").hasClass("active"))
            $(".calendar").addClass("active");
    });

    function populateCalendar(month, year, day) {
        cal.querySelector(".cal-body").innerHTML = "";
        var days = getDays(month - 1, year);
        var offset = getOffset(month, year);
        cal.querySelector(".cal-month").innerHTML = months[month] + " " + date.getFullYear();

        for(var i = 0; i < offset; i++) {
            var block = document.createElement("div");
            block.className = "day space";
            block.style.width = "14.285%";
            cal.querySelector(".cal-body").appendChild(block);
            block.style.height = "60px";
        }

        for(var i = 0; i < days; i++) {
            var block = document.createElement("div");
            var d = i + 1;
            var m = month + 1;

            if((d < day && month <= date.getMonth()) || month < date.getMonth())
                block.className = "day inactive";
            else {
                block.className = "day active";
                block.setAttribute("data-date", d + "-" + m + "-" + year);
                block.addEventListener("click", function() {
                    $("input[name=date]").val(this.getAttribute("data-date"));
                    $(".calendar").removeClass("active");
                });
            }
            
            block.innerHTML = d;
            block.style.width = "14.285%";
            cal.querySelector(".cal-body").appendChild(block);
            block.style.height = "60px";
        }
    }

    var currentMonth = date.getMonth();
    var currentYear = date.getFullYear();
    if(cal)
        populateCalendar(currentMonth, currentYear, date.getDate());

    $('.cal-prev').on('click', function(){
        currentMonth--;
        if(currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        populateCalendar(currentMonth, currentYear, date.getDate());
    });

    $('.cal-next').on('click', function(){
        currentMonth++;
        if(currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        populateCalendar(currentMonth, currentYear, date.getDate());
    });

    console.log(getDays(5, date.getFullYear()));
    console.log(getOffset(6, date.getFullYear()));

    /* Google Maps */
    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('Map'), {
          center: {lat: 49.8815153, lng: -97.1262439},
          zoom: 17,
          zoomControl: true,
          mapTypeControl: false,
          scaleControl: true,
          streetViewControl: false,
          rotateControl: false,
          styles: [
                {
                    "featureType": "administrative",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#a7a7a7"
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#737373"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#efefef"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#dadada"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "labels",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#696969"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#b3b3b3"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#d6d6d6"
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#ffffff"
                        },
                        {
                            "weight": 1.8
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#d7d7d7"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#808080"
                        },
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#bddbd1"
                        }
                    ]
                }
            ],
        });
    }

    /* Header */
    var header = document.querySelector('.listing-header');
    var headerOffset = header.offsetTop
    var innerContent = document.querySelector('.inner-content');

    window.addEventListener('scroll', function(){
        if(headerOffset <= document.documentElement.scrollTop) {
            header.style.position = "fixed";
            header.style.top = 0;
            header.style.zIndex = 100;
            innerContent.style.paddingTop = "8em";
        }
        else {
            header.style.position = "unset";
            innerContent.style.paddingTop = "unset";
        }
    });

    var currentPanel = 0;
    var panels = document.querySelectorAll('.panel');

    var child = $('select[name=child] option:selected').html();
    $("#Child").html(child);

    $('select[name=child]').on('change', function() {
        child = this.options[this.selectedIndex].innerHTML;
        $("#Child").html(child);
    });

    // Next Panel
    $('.next').on('click', function(e) {
        e.preventDefault();
        $('#' + panels[currentPanel].id).fadeOut(600, function() {
            currentPanel++;
            $('#' + panels[currentPanel].id).fadeIn(600);
        });
    });

    // Previous Panel
    $('.back').on('click', function(e) {
        e.preventDefault();
        $('#' + panels[currentPanel].id).fadeOut(600, function() {
            currentPanel--;
            $('#' + panels[currentPanel].id).fadeIn(600);
        });
    });

    /* Stripe */
    var stripe = Stripe('pk_test_meGdS4hKUSGozq5oZUHjNO8S');
    var elements = stripe.elements();

    var classes = {
        base: '.form-control'
    };

    var card = elements.create('cardNumber', {classes: classes});
    card.mount("#CardNumber");

    var expiry = elements.create('cardExpiry', {classes: classes});
    expiry.mount("#CardExpiry");

    var cvc = elements.create('cardCvc', {classes: classes});
    cvc.mount("#CardCVV");

    var form = document.querySelector("#PaymentForm");
    form.addEventListener('submit', function(e){
        e.preventDefault();
        
        $("#PaymentForm").fadeOut("600", function() {
            $("#PaymentProgress").fadeIn("600", async function() {    
                await stripe.createToken(card).then(async function(result) {
                    // if(result.error)
                    stripeTokenHandler(result.token);
                });
            });
        });
    });

    function stripeTokenHandler(token) {
        var sToken = token.id;
        var activityID = {{$activity->id}};

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.post('/book', {token: sToken, id: activityID})
            .done(function(data){
                console.log(data);
                // $("#PaymentProgress").fadeOut("600", function() {
                //     $("#PaymentSuccess").fadeIn("600");
                // });
            });
    };

    $("#PaymentModal").on('hidden.bs.modal', function() {
        $(".panel").css("display", "none");
        $("#ChildSelect").css("display", "block");
        currentPanel = 0;
    })

    /* Contact Giver */
    $('#SendMessage').on('click', function(e){
        e.preventDefault();
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var message = $('textarea[name=message]').val();

        $.post('/contact', { message: message })
            .done(function(data) {
                console.log(data);
            });
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWiHuicU8IMxIh9doxd-_-0Oh0I4MzGhc&callback=initMap"
async defer></script>
@endsection