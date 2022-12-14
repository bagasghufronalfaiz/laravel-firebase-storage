@extends('layout.app')

@section('title' , 'Add New Product')

@section('style')
<style>
    .input-select-option {
        height: 200px;
        background-repeat: no-repeat;
        background-position: right;
        background-size: 200px
    }
</style>
@endsection

@section('content')
<main class="mb-5">

    <div class="bg-white">
        <section class="text-center container ">
            <div class="row py-lg-4">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Add New Product</h1>
                </div>
            </div>
        </section>
    </div>

    <div class="py-5 album bg-light">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Product Name" required>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Product Price</label>
                            <input type="number" class="form-control" name="price" id="price" placeholder="Product Price" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Product Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3" placeholder="Product Description" required></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="asset" class="form-label">Product Image</label>
                            <select class="form-select form-select-lg mb-3" id="asset" name="asset[]" multiple size="3" required>
                                @foreach ($assets as $asset)
                                <option value="{{ $asset->id }}" class="input-select-option" style="background-image:url({{$asset->path}});">{{ $asset->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')

@endsection