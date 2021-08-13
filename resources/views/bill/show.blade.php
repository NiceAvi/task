@extends('layout.main')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1> --}}
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary float-left">Create Bill</h6>
                <a href="{{ route('bills.index', []) }}" class="btn btn-success float-right">Back</a>
            </div>
            <div class="card-body">
                <dt class="col-sm-2">Bill No.</dt>
                <dd class="col-sm-10">{{ $bill->bill_no ?? '---' }}</dd>
                <dt class="col-sm-2">Date</dt>
                <dd class="col-sm-10">{{ $bill->date ?? '---' }}</dd>
                <dt class="col-sm-2">Customer Name</dt>
                <dd class="col-sm-10">{{ $bill->customer->name ?? '---' }}</dd>
                <dt class="col-sm-2">City</dt>
                <dd class="col-sm-10">{{ $bill->customer->city ?? '---' }}</dd>
                <dt class="col-sm-2">Address</dt>
                <dd class="col-sm-10">{{ $bill->customer->address ?? '---' }}</dd>
                <dt class="col-sm-2">Total Amount</dt>
                        <dd class="col-sm-10">{{ $bill->total_amount ?? '---' }}</dd>

                <hr>
                <table class="table table-striped table-bordered " id="itemTable">
                    <thead class="">
                        <tr>
                            <th>Sr.No</th>
                            <th>Item</th>
                            <th>Rate</th>
                            <th>Qty</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bill->billHeaderItems as $HeaderItem)
                            <tr id="row_1">
                                <td scope="row">1</td>
                                <td>
                                    @foreach ($items as $item)

                                        @if ($HeaderItem->item_id == $item->id)
                                            {{ $item->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $HeaderItem->rate ?? 0 }}</td>
                                <td>{{ $HeaderItem->rate ?? 0 }}</td>
                                <td>{{ $HeaderItem->rate ?? 0 }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
