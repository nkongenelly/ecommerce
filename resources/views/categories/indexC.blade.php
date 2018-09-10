@extends('layoutsAdmin')

@section('content')
    <a href="/categories/create" class="btn btn-warning">Add Category</a>
    <table class="table table-condensed table-striped table-hover table-bordered">
        <tr>
            <th>#</th>
            <th>Category Parent</th>
            <th>Category Name</th>
            <th>Created On</th>
            <th colspan="2">Action</th>
        </tr>
        <tr>
        @if(count($categories))
            @foreach($categories as $category)
                <td>{{ $category->id }}</td>
                <td>{{ $category->category_parent }}</td>
                <td>{{ $category->category_name }}</td>
                <td>{{ $category->created_at->toFormattedDateString() }}</td>
                <td>
                    <a href="/categories/edit" class="btn btn-warning">Edit</a>
                </td>
                <td>
                    <a href="/categories/delete" class="btn btn-danger">Delete</a>
                </td>

            @endforeach
        @endif
            
        </tr>
    
    </table>

@endsection

