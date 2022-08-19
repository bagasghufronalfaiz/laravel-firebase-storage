@extends('layout.app')

@section('title' , 'Asset')

@section('style')

@endsection

@section('content')
<main>
    <div class="bg-white">
        <section class="text-center container ">
            <div class="row py-lg-4">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Asset</h1>
                    <p>
                        <a href="{{ route('asset.add') }}" class="btn btn-primary my-2">Add New Asset</a>
                    </p>
                </div>
            </div>
        </section>
    </div>

    <div class="py-5 album bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach($assets as $asset)
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="{{ $asset->path }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column">
                                    <p class="card-text mb-0">
                                        <small class="text-muted"><b>Name : </b>{{ $asset->name }}</small>
                                    </p>
                                    <p class="card-text mb-0">
                                        <small class="text-muted"><b>Size : </b>{{ $asset->size }}</small>
                                    </p>
                                </div>
                                <div>
                                    <form action="{{route('asset.delete', ['id' => $asset->id])}}" method="post" class="m-0" style="display:inline-block;">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-outline-danger" data-toggle="tooltip" title="Delete Asset">Delete</button>
                                    </form>
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