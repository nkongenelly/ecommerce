@extends('layoutsBuyer')

@section('content')
<a href="/productsbuyer" class="btn btn-warning">Back</a>
    <table class="table table-condensed table-striped table-hover table-bordered">
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Product description</th>
            <th>Product Price</th>
            <th>Action</th>
            <th>Placed Order</th>
        </tr>
        @if(array($orders))
            @foreach($orders as $order)
                @foreach($productss as $product)
                        <tr>
                            <td>{{ $product['id'] }}</td>
                            <td>{{ $product['product_name'] }}</td>
                                
                            <td>{{ $product['product_description'] }}</td>
                            <td>{{ $product['product_price'] }}</td>
                            <td>
                                <a href="/orders/create/{{ $product['id'] }}" class="btn btn-outline-success my-2 my-sm-0">Place Orders</a>
                            </td>
                            <td>
                                @foreach($orders as $order)
                                    @if($order = 1)
                                        <strong>Yes</strong>
                                    @else
                                        <strong>No</strong>
                                    @endif
                                @endforeach
                            </td>  
                           
                        </tr>
                @endforeach
            @endforeach
        @endif
           
    
    </table>
    

@endsection

