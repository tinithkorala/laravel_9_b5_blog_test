@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">

            <a href="{{ URL::previous() }}" class="btn btn-warning">Go Back</a>

            <div class="card mt-3">
                <div class="card-header">{{ __('Category Create') }}</div>

                <div class="card-body">
                    
                    @if (session('success'))
                        <x-alert type="success" :message="session('success')"/>
                    @endif
                    @if (session('error'))
                        <x-alert type="danger" :message="session('error')"/>
                    @endif 

                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" aria-describedby="emailHelp">
                            @error('category_name')
                                <div id="emailHelp" class="form-text fw-bold text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
    
</div>
@endsection
