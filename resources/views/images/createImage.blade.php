@extends('layoutsSeller')

@section('content')
    <form action="/productimages" method="POST" enctype="multipart/form-data">
    @csrf
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div> 
            @endif
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="form-group">
                <label>Product name</label>
                <input type="text" class="form-control" placeholder="Type the product name" name="product_name">
            </div>
            <div class="input-group control-group increment" >
            <input type="file" name="image_name[]" class="form-control" accept="image/*"
>
            <div class="input-group-btn"> 
                <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
            </div>
            </div>
            <div class="clone hide">
            <div class="control-group input-group" style="margin-top:10px">
                <input type="file" name="image_name[]" class="form-control">
                <div class="input-group-btn"> 
                <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                </div>
            </div>
            </div>

            <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button
    
    </form>
    <script type="text/javascript">

    $(document).ready(function() {

      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });

    });

</script>


@endsection