@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">

            <a href="{{ route('categories.create') }}" class="btn btn-warning">Create</a>

            <div class="card mt-3">
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
                                    <td class="d-flex">
                                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning mx-2">Edit</a>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger mx-2" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                        <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#view_data">View</button>
                                    </td>
                                </tr>    
                            @endforeach
                        </tbody>
                    </table>    

                </div>

            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="view_data" tabindex="-1" aria-labelledby="view_dataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="view_dataLabel">Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="category_status" class="form-label">Category Status</label>
                        <input type="checkbox" class="" id="category_status" name="category_status" readonly onclick="return false;"/>
                    </div>    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
