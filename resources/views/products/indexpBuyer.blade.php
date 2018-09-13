@extends('layoutsBuyer')

@section('content')
    <table class="table table-condensed table-striped table-hover table-bordered">
        <tr>
            <th>#</th>
            <th>Category</th>
            <th>Product Name</th>
            <th>Product Features</th>
            <th>Product description</th>
            <th>Product Price</th>
            <th>Created On</th>
            <th colspan="1">Action</th>
        </tr>
        
        @if(count($products))
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->category['category_name'] }}</td>
                <td>{{ $product->product_name }}</td>
                <td>
                    @foreach($product->features as $feature)
                        <ol>
                            <li>{{ $feature->feature_name}}</li>
                        </ol>
                    @endforeach
                </td>             
                <td>{{ $product->product_description }}</td>
                <td>{{ $product->product_price }}</td>
                <td>{{ $product->created_at->diffForHumans() }}</td>
                <td>
                    <a href="/orders/create/{{ $product->id }}" class="btn btn-outline-success my-2 my-sm-0">Order</a>
                </td>
            </tr>
            @endforeach
        @endif       
       
    
    </table>

@endsection
