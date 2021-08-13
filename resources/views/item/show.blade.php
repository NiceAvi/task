@extends('layout.main')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1> --}}
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary float-left">Show Item</h6>
                <a href="{{ route('items.index', []) }}" class="btn btn-success float-right">Back</a>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-2">Name</dt>
                    <dd class="col-sm-10">{{$item->name}}</dd>
                    <dt class="col-sm-2 text-truncate">Price</dt>
                    <dd class="col-sm-10">{{$item->price}}</dd>
                </dl>
            </div>
        </div>

    </div>
@endsection
