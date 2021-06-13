@extends('product-layout')

@section('menu')
    @include('includes/menu')
@endsection

@section('content')
    {{-- <article>
        <h2><a href="product">{{$product->product_name}} </a></h2>
        <p>{!!$product->product_desc!!}
        </p>
    </article> --}}

    <section class="small-banner section">
        <div class="container-fluid">
            <div class="row">
                <!-- Single Banner  -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-banner">
                        <img src="https://via.placeholder.com/600x370" alt="#">
                        <div class="content">
                            <h2><a href="product">{{ $product->product_name }} </a></h2>
                            <p>{!! $product->product_desc !!}
                            </p>
                            <a href="#">Shop Now</a>
                        </div>
                    </div>
                </div>
                <!-- /End Single Banner  -->
            </div>
        </div>
    </section>
@endsection
