@extends('layout.app')

@section('title' , 'Category')

@section('style')

@endsection

@section('content')
<main>
    <div class="bg-white">
        <section class="text-center container ">
            <div class="row py-lg-4">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Category</h1>
                    <p>
                        <a href="{{ route('category.add') }}" class="btn btn-primary my-2">Add New Category</a>
                    </p>
                </div>
            </div>
        </section>
    </div>

    <div class="py-5 album bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach($categories as $category)
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="{{ $category->asset->path }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column">
                                    <p class="card-text h3 fw-bolder mb-0">
                                        {{ $category->category_name }}
                                    </p>
                                </div>
                                <div>
                                    <a href="{{ route('category.show', ['id' => $category->category_slug]) }}" class="btn btn-outline-primary mr-1">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')

@endsection