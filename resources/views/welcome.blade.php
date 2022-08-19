@extends('layout.app')

@section('title' , 'Product')

@section('style')

@endsection

@section('content')
<main>
    <div class="bg-white">
        <section class="text-center container ">
            <div class="row py-lg-4">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Product</h1>
                    <p>
                        <a href="{{ route('product.add') }}" class="btn btn-primary my-2">Add New Product</a>
                    </p>
                </div>
            </div>
        </section>
    </div>

    <div class="py-5 album bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')

@endsection