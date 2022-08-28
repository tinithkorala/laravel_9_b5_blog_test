@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Category Manage') }}</div>

                <div class="card-body">

                    <table id="data-table" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->c_name }}</td>
                                    <td style="text-align: center">
                                        <p class="fw-bold @if ($category->is_active) text-green @else text-red @endif">@if ($category->is_active) Active @else Inactive @endif</p>
                                    </td>
                                    <td>{{ $category->created_at }}</td>
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
