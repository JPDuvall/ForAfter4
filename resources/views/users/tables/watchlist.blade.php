@if(count($watchlist) > 0)
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Activity</th>
                <th>Location</th>
                <th style="width: 40px;">Remove</th>
            </tr>
        </thead>
        <tbody>
        @foreach($watchlist as $item)
            <tr>
                <td><a href="{{config('app.url')}}activity/{{$item->activity->id}}" target="_blank">{{$item->activity->name}}</a></td>
                <td>{{$item->activity->location}}</td>
                <td><button class="remove" data-id="{{$item->activity->id}}"><i class="fas fa-times"></i></button></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@else
<h5>You aren't watching any activities yet.</h5>
@endif