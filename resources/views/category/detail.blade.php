@extends('layout.app')

@section('content')
<main class="mb-5">

    <div class="bg-white">
        <section class="text-center container ">
            <div class="row py-lg-4">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Category : {{$category->category_name}}</h1>
                </div>
            </div>
        </section>
    </div>

    <div class="py-5 album bg-light">
        <div class="container">
            <div class="row row-cols-1 g-3">
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="{{ $category->asset->path }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <div class="d-flex flex-column">
                                <!-- category
- id
- category_name
- category_slug
- asset_id
- created_at
- updated_at -->
                                <p class="card-text">
                                    <small class="text-muted"><b>Name : </b>{{ $category->category_name }}</small>
                                </p>
                                <p class="card-text">
                                    <small class="text-muted"><b>Asset Name : </b>{{ $category->asset->name }}</small>
                                </p>
                                <p class="card-text">
                                    <small class="text-muted"><b>Slug : </b>{{ $category->category_slug }}</small>
                                </p>
                                <p class="card-text">
                                    <small class="text-muted"><b>Created At : </b>{{ $category->created_at }}</small>
                                </p>
                                <p class="card-text">
                                    <small class="text-muted"><b>Updated At : </b>{{ $category->updated_at }}</small>
                                </p>
                                <div class="d-flex justify-content-end">
                                    <form action="{{route('category.delete', ['id' => $category->id])}}" method="post" class="m-0" style="display:inline-block;">
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