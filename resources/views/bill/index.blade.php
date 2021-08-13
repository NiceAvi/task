@extends('layout.main')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1> --}}
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Bills List</h6>
                <a href="{{ route('bills.create', []) }}" class="btn btn-success float-right">Create</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Bill No.</th>
                                <th>Customer Name</th>
                                <th>Date</th>
                                <th>City</th>
                                <th>Total Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <th>#</th>
                            <th>Bill No.</th>
                            <th>Customer Name</th>
                            <th>Date</th>
                            <th>City</th>
                            <th>Total Amount</th>
                            <th width="300">Action</th>
                        </tfoot>
                        <tbody>
                            @foreach ($bills as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->bill_no }}</td>
                                    <td>{{ $item->customer->name }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->customer->city }}</td>
                                    <td>{{ $item->total_amount }}</td>
                                    <td>
                                        <a href="{{ route('bills.show', [$item->id]) }}"
                                            class="btn btn-success">Show</a>
                                        <a href="{{ route('bills.edit', [$item->id]) }}"
                                            class="btn btn-warning">Edit</a>
                                        <form class="align-form-button" onclick="return confirm('Are you sure you want to delete this item')" style="display: inline;" action="{{ route('bills.destroy', [$item->id]) }}" method="post">
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
