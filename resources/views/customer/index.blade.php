@extends('layout.main')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1> --}}
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary float-left">Customer List</h6>
                <a href="{{ route('customer.create', []) }}" class="btn btn-success float-right">Create</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>City</th>
                                <th>Address</th>
                                <th width="300">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <th>#</th>
                            <th>Name</th>
                            <th>City</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tfoot>
                        <tbody>
                            @foreach ($customers as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->city}}</td>
                                    <td>{{$item->address}}</td>
                                    <td>

                                        <a href="{{ route('customer.show', [$item->id]) }}"
                                            class="btn btn-success">Show</a>
                                        <a href="{{ route('customer.edit', [$item->id]) }}"
                                            class="btn btn-warning">Edit</a>
                                        <form class="align-form-button" onclick="return confirm('Are you sure you want to delete this item')" style="display: inline;" action="{{ route('customer.destroy', [$item->id]) }}" method="post">
                                            <input class="btn btn-danger" type="submit" value="Delete" />
                                            @method('delete')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
