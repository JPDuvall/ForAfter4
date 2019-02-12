<ul class="nav nav-pills flex-column">
    <li class="nav-item">
        <a class="nav-link{{ Route::currentRouteName() == "account-settings" ? " active" : "" }}" href="{{ config('app.url') }}hub">Account Settings</a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ Route::currentRouteName() == "edit-profile" ? " active" : "" }}" href="{{ config('app.url') }}hub/edit-profile">Profile</a>
    </li>
    @if(Auth::user()->giver_approved)
    <li class="nav-item">
        <a class="nav-link{{ Route::currentRouteName() == "my-listings" ? " active" : "" }}" href="{{ config('app.url') }}hub/my-listings">My Listings</a>
    </li>
    @endif
    <li class="nav-item">
        <a class="nav-link{{ Route::currentRouteName() == "my-children" ? " active" : "" }}" href="{{ config('app.url') }}hub/my-children">My Children</a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ Route::currentRouteName() == "watch-list" ? " active" : "" }}" href="{{ config('app.url') }}hub/watch-list">My Watchlist</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">My Bookings</a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="#">Family Feed</a>
    </li> --}}
</ul>