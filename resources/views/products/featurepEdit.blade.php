@extends('layoutsSeller')

@section('content')
    <form action="/productfeatures/update/{{$productfeature->id}}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        {{  method_field('PATCH') }}
        <input type="hidden" class="form-control" value="{{ $productfeature->id }}" name="product_id">
        <a href="/features/create" class="btn btn-warning">Add Feature</a>
        <div class="form-control">
            <select name="feature_id">
                <option value="{{$features['id']}}">{{$features['feature_name']}}</option>
                
                   
                    @foreach($featuresall as $featureall){
                        <option value="{{$featureall->id}}">{{$featureall->feature_name}}</option>
                    @endforeach
                      
            </select>
            <input type="hidden" name="user_id" value="{{ $user['id'] }}">
        </div>
        <div class="form-control">
            <button type="submit" class="btn btn-primary">Edit Feature</button>
           
        </div>
    
    </form>

@endsection