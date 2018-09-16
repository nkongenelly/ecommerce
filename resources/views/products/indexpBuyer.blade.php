@extends('layoutsBuyer')

@section('content')
<div class="row">
    <div class="col-sm-10">
        <table class="table table-condensed table-striped table-hover table-bordered">
            <tr>
                <th>#</th>
                <th>Category</th>
                <th>Product Name</th>
                <th>Product Features</th>
                <th>Product description</th>
                <th>Product Price</th>
                <th>Created On</th>
                <th colspan="2">Action</th>
            </tr>
            
    @if(array($products))
    
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
                                <a href="/orderbuyerview/{{ $product->id }}" class="btn btn-outline-success my-2 my-sm-0">View</a>
                            </td>
                            <td>
                                <a href="/orders/cart/{{ $product->id }}" class="btn btn-outline-success my-2 my-sm-0">Add to Cart</a>
                            </td>
                        </tr>
                    @endforeach 
        @endif       
        
        
        </table>
    </div>
    <div class="col-sm-2">
     @include('sidebar')
    </div>
</div>
    

@endsection

