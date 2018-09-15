@extends('layoutsAdmin')

@section('content')
    <form action="/categories/update/{{$category->id}}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-control">
            <select name="category_parent">
               
                <option value="{{$parent}}">{{$categoryname}}</option>
                @foreach($categories as $categorys)
                    <option value="{{ $categorys->category_parent }}">{{ $categorys->category_name }}</option>
                @endforeach
              
            </select>
            <div class="form-group">
                <label>Category name</label>
                <input type="text" class="form-control" value="{{$category->category_name}}" name="category_name">
            </div>
            <a href="/categories" class="btn btn-warning">Back</a>
            <button type="submit" class="btn btn-primary">Edit</button>

           
        </div>
    
    </form>

@endsection