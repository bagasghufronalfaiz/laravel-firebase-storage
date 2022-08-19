@extends('layout.app')

@section('title' , $product->product_name)

@section('content')
<main class="mb-5">

    <div class="bg-white">
        <section class="text-center container ">
            <div class="row py-lg-4">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Product : {{$product->product_name}}</h1>
                </div>
            </div>
        </section>
    </div>

    <div class="py-5 album bg-light">
        <div class="container">
            <div class="row row-cols-1 g-3">
                <div class="col">
                    <div class="card shadow-sm">

                        <div class="card-body">
                            <div class="d-flex flex-column">
                                <p class="card-text">
                                    <small class="text-muted"><b>Name : </b>{{ $product->product_name }}</small>
                                </p>
                                <p class="card-text">
                                    <small class="text-muted"><b>Slug : </b>{{ $product->product_slug }}</small>
                                </p>
                                <p class="card-text">
                                    <small class="text-muted"><b>Price : </b>{{ $product->price }}</small>
                                </p>
                                <p class="card-text">
                                    <small class="text-muted"><b>Description : </b>{{ $product->description }}</small>
                                </p>
                                <p class="card-text">
                                    <small class="text-muted"><b>Created At : </b>{{ $product->created_at }}</small>
                                </p>
                                <p class="card-text">
                                    <small class="text-muted"><b>Updated At : </b>{{ $product->updated_at }}</small>
                                </p>
                                <p class="card-text">
                                    <small class="text-muted"><b>Assets : </b></small>
                                </p>
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                                    @foreach($product->assets as $asset)
                                    <div class="col">
                                        <div class="card shadow-sm">
                                            <img src="{{ $asset->path }}" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex flex-column">
                                                        <p class="card-text h3 fw-bolder mb-0">
                                                            {{ $asset->name }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="d-flex justify-content-end">
                                    <form action="{{route('product.delete', ['id' => $product->id])}}" method="post" class="m-0" style="display:inline-block;">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-outline-danger" data-toggle="tooltip" title="Delete Asset">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')

@endsection