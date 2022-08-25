@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('User Manage') }}</div>

                <div class="card-body">

                    <table id="data-table" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Logged In</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td style="text-align: center">
                                        <p class="fw-bold @if ($user->is_active) text-green @else text-red @endif">@if ($user->is_active) Active @else Inactive @endif</p>
                                    </td>
                                    <td style="text-align: center">
                                        <p class="fw-bold @if ($user->is_logged_in) text-green @else text-red @endif">●</p>
                                    </td>
                                    <td>{{ $user->created_at }}</td>
                                </tr>    
                            @endforeach
                        </tbody>
                    </table>    

                </div>

            </div>
        </div>
    </div>
    
</div>
@endsection
