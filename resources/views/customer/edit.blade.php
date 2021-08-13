@extends('layout.main')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1> --}}
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary float-left">Update Customer</h6>
                <a href="{{ route('customer.index', []) }}" class="btn btn-success float-right">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('customer.update', [$customer->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                      <label for="name" class="col-2 col-form-label">Name</label>
                      <div class="col-8">
                        <input id="name" name="name" type="text" class="form-control" value="{{ isset($customer->name) ? $customer->name : old('name') }}" required="required">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="city" class="col-2 col-form-label">City</label>
                      <div class="col-8">
                        <input id="city" name="city" type="text" value="{{ isset($customer->city) ? $customer->city : old('city') }}" class="form-control" required="required">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="address" class="col-2 col-form-label">Address</label>
                      <div class="col-8">
                        <textarea id="address" name="address" cols="40" rows="5" class="form-control" required="required">{{ isset($customer->address) ? $customer->address : old('address') }}</textarea>
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
