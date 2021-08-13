@extends('layout.main')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1> --}}
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary float-left">Create Item</h6>
                <a href="{{ route('items.index', []) }}" class="btn btn-success float-right">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('items.store', []) }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-2 col-form-label">Name</label>
                        <div class="col-8">
                            <input id="name" name="name" type="text" value="{{ old('name') }}" class="form-control"
                                required="required">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-2 col-form-label">Price</label>
                        <div class="col-8">
                            <input id="price" name="price" type="text" value="{{ old('price') }}" class="form-control"
                                required="required">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-2 col-8">
                            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
