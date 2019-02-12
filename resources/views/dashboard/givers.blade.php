@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/dashboard/users">Users</a>
        </li>
        <li class="breadcrumb-item active">Givers</li>
    </ol>
    <div class="row">
        <div class="col-12">
            <h1>Givers</h1>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 300px;">Name</th>
                            <th style="width: 200px;">UserName</th>
                            <th>Email</th>
                            <th style="width: 50px;">Approved</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            @if($user->giver_approved)
                            <td>Yes</td>
                            @else
                            <td>No</td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid-->
<!-- /.content-wrapper-->
@endsection