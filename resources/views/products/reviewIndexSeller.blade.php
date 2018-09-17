@extends('layoutsSeller')

@section('content')
    <table class="table table-condensed table-striped table-hover table-bordered">
        <tr>
            <th>Category</th>
            <th>Product Name</th>
            <th>From</th>
            <th>Review</th>
        </tr>
        
        @if(count($reviews))
            @foreach($reviews as $review)
            <tr>
                <td>{{ $review->id }}</td>
                <td>{{ $review->product->product_name }}</td>
                <td>{{ Auth::user()->find($review->user_id)->name }}</td>
                <td>{{ $review->review }}</td>
            </tr>
            @endforeach
        @endif       
       
    
    </table>

@endsection

