@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    

                </div>
            </div>
        </div>
    </div>

    <div class="col-12 pt-5">
        <div class="card" style="width: 18rem;">
            <a href="{{ route('users.index') }}" class="btn btn-primary">
                <div class="card-body">
                    <h5 class="card-title">User</h5>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
