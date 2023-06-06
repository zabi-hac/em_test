@extends('product.main')

@section('content')





<div class="row">
   <h1>Products</h1>

   <div class="">
      <a href="{{route('createProductview')}}" class="btn btn-success  pull-right" style="float: right;margin-right:30px;">Add Product</a>
   </div>

   <style>
      a {
         text-decoration: none !important;
         color: #000;
      }

      .hovered-card:hover {
         box-shadow: 1px 1px 7px 1px;
      }
   </style>

   @foreach($products as $product)




   <div class="hovered-card card col-4 mx-2 mt-4" title="click to edit" style="width: 18rem;">


      @if ($product->image != '' or $product->image != null)
      <img src="{{asset('product_images').'/'.$product->image}}" class="card-img-top" height="200" width="100" alt="">
      @endif

      <a href="{{url('edit-product')}}?id={{$product->id}}" target="_blank">
         <div class="card-body">



            <h5 class="card-title">{{$product->name}}</h5>


            <table>
               <tbody>
                  <tr>
                     <td>SKU</td>
                     <td>{{$product->SKU}}</td>
                  </tr>
                  <tr>
                     <td>Price</td>
                     <td>{{$product->price}}</td>
                  </tr>
                  <tr>
                     <td>Image</td>
                     <td>{{$product->Image}}</td>
                  </tr>
                  <tr>
                     <td>Status</td>
                     <td>
                        @if($product->status)
                        <span class="badge bg-success">Available</span>
                        @else
                        <span class="badge bg-danger">Not Available</span>
                        @endif

                     </td>
                  </tr>
                  <tr>
                     <td>
                        <a href="{{url('delete-product')}}?id={{$product->id}}" class="btn btn-sm  btn-danger"> <i class="fa fa-trash"></i></a>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </a>

   </div>


   @endforeach
</div>






@endsection