@extends('layoutsSeller')

@section('content')
    <a href="/productfeatures/create/{{ $product->id }}" class="btn btn-warning">Add Product Feature</a>
    <a href="/featuress/create" class="btn btn-warning" onclick="alert('okay')">Add Feature</a>
    <table class="table table-condensed table-striped table-hover table-bordered">
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Feature Name</th>
            <th colspan="2">Action</th>
        </tr>
        @if(count($product->features))
            @foreach($product->features as $feature)
                <tr>
                
                    <td>{{ $product['id'] }}</td>
                    <td>{{ $product['product_name'] }}</td>
                    <td>
                        <ol>
                            @foreach($features as $feature)
                               <ul>{{ $feature['feature_name'] }}</ul>
                            @endforeach
                        </ol>
                    </td>
                    <td>
                        <a href="/productfeatures/{{ $product['id'] }}" class="btn btn-warning">Edit</a>
                    </td>
                    <td>
                        <a href="/productfeatures/delete/{{ $product['id'] }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                    </td>
                
                </tr>
            @endforeach
        @endif

    </table>

@endsection

