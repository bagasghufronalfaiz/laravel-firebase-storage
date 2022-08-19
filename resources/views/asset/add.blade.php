@extends('layout.app')

@section('title' , 'Add New Asset')

@section('content')
<main class="mb-5">

    <div class="bg-white">
        <section class="text-center container ">
            <div class="row py-lg-4">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Add New Asset</h1>
                </div>
            </div>
        </section>
    </div>

    <div class="py-5 album bg-light">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('asset.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="asset" class="form-label">Asset</label>
                            <input class="form-control" type="file" name="asset[]" id="asset" aria-describedby="assetHelp" multiple required>
                            <div id="assetHelp" class="form-text">You may upload multiple asset.</div>
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
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