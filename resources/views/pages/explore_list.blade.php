@if(count($activities) > 0)
    <div class="row">
    @foreach($activities as $activity)
        <div class="col-md-4">
            <div class="card activity-card">
                <div class="card-body">
                    <div class="acard-header">
                        <a href="{{ config('app.url') }}activities/{{ $activity->id }}">
                            <div class="overlay"></div>
                            <div class="owl-carousel owl-theme acard-slider">
                                @foreach($activity->media as $image)
                                <div class="item">
                                    <div class="acard-image" style="background-image: url('{{ config('app.url') }}/storage/{{ $image->img_url }}');"></div>
                                </div>
                                @endforeach
                            </div>
                            <a class="btn btn-outline-primary">${{ $activity->price }} <sup>{{ $activity->term }}</sup></a>
                            <div class="item-info">
                                <h4 class="item-title">{{ $activity->name }}</h4>
                            </div>
                        </a>
                    </div>
                    <div class="acard-footer">
                        <ul class="acard-list">
                            <li>Local</li>
                            <li>Teen friendly</li>
                        </ul>
                        <div class="acard-buttons">
                        @guest
                        <button class="acard-button" data-id="{{$activity->id}}" data-toggle="tooltip" data-placement="top" title="Watch"><i class="fas fa-binoculars"></i></button>
                        @else
                            <button class="acard-button watch" data-id="{{$activity->id}}" data-toggle="tooltip" data-placement="top" title="Watch"><i class="fas fa-binoculars"></i></button>
                        @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
@else
    <h3>No activities to be found!</h3>
@endif