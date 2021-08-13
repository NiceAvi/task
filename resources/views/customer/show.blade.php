@extends('layout.main')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1> --}}
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary float-left">Show Customer</h6>
                <a href="{{ route('customer.index', []) }}" class="btn btn-success float-right">Back</a>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-2">Name</dt>
                    <dd class="col-sm-10">{{$customer->name}}</dd>
                    <dt class="col-sm-2 text-truncate">City</dt>
                    <dd class="col-sm-10">{{$customer->city}}</dd>
                    <dt class="col-sm-2">Address</dt>
                    <dd class="col-sm-10">{{$customer->address}}</dd>
                </dl>
            </div>
        </div>

    </div>
@endsection
