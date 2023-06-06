@extends('product.main')

@section('content')





<!-- form style -->
<style>
   #x_form {
      box-shadow: 1px 2px 8px 0px;
   }

   #x_form:hover {
      box-shadow: 2px 2px 8px 0px;
   }
</style>
<!-- form style end -->

<div class="mx-auto col-md-10 p-5">
   <form action="{{route('editProduct')}}" enctype="multipart/form-data" method="post" id="x_form" class="p-5">

      @csrf


      <input type="hidden" name="id" value="{{$product->id}}">

      <div class="mb-5 row">
         <h4 class="text-center">Edit Product</h4>
      </div>

      <div class="mb-3 row">
         <label for="inputname" class="col-sm-2 col-form-label"> <b> Name </b></label>
         <div class="col-sm-10">
            <input type="text" class="form-control" name="name" id="inputname" value="{{$product->name}}" placeholder="">
         </div>
      </div>

      <div class="mb-3 row">
         <label for="inputprice" class="col-sm-2 col-form-label"> <b> Price </b></label>
         <div class="col-sm-10">
            <input type="text" class="form-control" name="price" id="inputprice" value="{{$product->price}}" placeholder="">
         </div>
      </div>




      <div class="mb-3 row">
         <label for="inputsku" class="col-sm-2 col-form-label"> <b>SKU </b></label>
         <div class="col-sm-10">
            <input type="text" class="form-control" name="SKU" id="inputsku" value="{{$product->SKU}}" placeholder="">
         </div>
      </div>


      <!-- <div class="mb-3 row">
         <label for="inputsku" class="col-sm-2 col-form-label"> <b>SKU </b></label>

         if ($product->image != '' && $product->image != null)
         <img src="{{asset('product_images').'/'.$product->image}}" height="100" width="100" alt="">

         endif
         <div class="col-sm-10">
            <input type="text" class="form-control" name="SKU" id="inputsku" value="{{$product->SKU}}" placeholder="">
         </div>
      </div> -->


      <div class="mb-3 row">
         <label for="inputStatus" class="col-sm-2 col-form-label"> <b> status </b></label>


         <div class="col-sm-10">
            <input type="file" id="user_photo" name="file">
         </div>
      </div>



      <div class="mb-3 row">
         <label for="inputStatus" class="col-sm-2 col-form-label"> <b> status </b></label>
         <div class="col-sm-10">
            <input type="text" class="form-control" name="status" id="inputStatus" value="{{$product->status}}" placeholder="">
         </div>
      </div>




      @if ($errors->any())
      <div class="alert alert-danger">
         <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      @endif



      <div class="mt-5 text-center">
         <input type="submit" value="submit" class="btn btn-primary ">
      </div>
   </form>
</div>






@endsection