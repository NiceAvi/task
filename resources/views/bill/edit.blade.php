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
                <form action="{{ route('bills.update', [$bills->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="inputFirstname">Date</label>
                            <input type="date" class="form-control" id="date" name="date"
                                value="{{ $bills->date == old('date') ? old('date') : $bills->date->format('Y-m-d') }}" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="inputLastname">Bill No.</label>
                            <input type="text" class="form-control" id="bill_no" name="bill_no"
                                value="{{ $bills->bill_no == old('bill_no') ? uniqid() : $bills->bill_no }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="inputAddressLine1">Customer Name</label>
                            <select name="customer_id" id="customer_id" class="form-control"
                                onchange="GetCustomer(this.value)" required>
                                <option value="">Select</option>
                                @foreach ($customers as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $bills->customer_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6" style="margin-top: 2rem;">
                            <a href="{{ route('customer.create', []) }}" class="btn btn-success">+</a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address"
                                value="{{ $bills->customer->address == old('address') ? old('address') : $bills->customer->address }}" required>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city"
                                value="{{ $bills->customer->city == old('city') ? old('city') : $bills->customer->city }}" required>
                        </div>

                    </div>
                    <hr>
                    <table class="table table-striped table-bordered " id="itemTable">
                        <thead class="">
                            <tr>
                                <th>Sr.No</th>
                                <th>Item</th>
                                <th>Rate</th>
                                <th>Qty</th>
                                <th>Amount</th>
                                <th><button type="button" class="btn btn-success" onclick="AddRow()">+</button></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach ($bills->billHeaderItems as $HeaderItem)
                                <tr id="row_{{$i}}">
                                    <td scope="row">{{$i}}</td>
                                    <td>
                                        <select name="item_id[]" id="item_id_{{$i}}" class="form-control"
                                            onchange="GetItemPrice(this.value,{{$i}})" required>
                                            <option value="">Select</option>
                                            @foreach ($items as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $HeaderItem->item_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="rate[]" id="rate_{{$i}}" class="form-control"
                                            value="{{ $HeaderItem->rate ?? 0 }}" readonly required></td>
                                    <td><input type="text" name="qty[]" id="qty_{{$i}}" value="{{ $HeaderItem->rate ?? 0 }}"
                                            class="form-control" onkeyup="CalculateProductAmount(this.value,{{$i}})" required></td>
                                    <td><input type="text" name="amount[]" id="amount_{{$i}}"
                                            value="{{ $HeaderItem->rate ?? 0 }}" class="form-control" required>
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <div class="form-group row">
                        <div class="offset-md-6 col-sm-6">
                            <label for="city">Total Amount</label>
                            <input type="number" id="totalamount" class="form-control" name="totalamount" value="{{$bills->total_amount == old('totalamount')? old('totalamount') : $bills->total_amount}}" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary px-4 float-right">Save</button>
                </form>
            </div>
        </div>

    </div>
@endsection
@push('script')
    <script>
        function GetCustomer(params) {
            // $.ajax({
            //     type: 'GET', //THIS NEEDS TO BE GET
            //     url: "{{ url('getcustomer', []) }}/" + params,
            //     dataType: 'json',
            //     success: function(data) {
            //         var data = $.parseJSON(result);
            //         console.log(data);
            //         $("#address").val(data.name)
            //         $("#city").val(data.city)
            //     },
            //     error: function(data) {
            //         console.log(data);
            //     }
            // });
            var url = "{{ url('getcustomer', []) }}/" + params
            $.getJSON(url, function(result) {
                $("#address").val(result.name)
                $("#city").val(result.city)
                $.each(result, function(i, field) {
                    console.log(field + " ");
                });
            });
        }

        function AddRow() {
            var countRow = $("#itemTable tbody tr").length;
            console.log(countRow);
            countRow++;
            var Row = `<tr id="row_${countRow}">
                                <td scope="row">${countRow}</td>
                                <td>
                                    <select name="item_id[]" id="item_id_${countRow}" class="form-control" onchange="GetItemPrice(this.value,${countRow})">
                                        <option value="">Select</option>
                                        @foreach ($items as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="text" name="rate[]" id="rate_${countRow}" class="form-control" readonly></td>
                                <td><input type="text" name="qty[]" id="qty_${countRow}" class="form-control" value="1" onkeyup="CalculateProductAmount(this.value,${countRow})"></td>
                                <td><input type="text" name="amount[]" id="amount_${countRow}" value="0" class="form-control"></td>
                                <td>
                                    <button type="button" class="btn btn-danger" onclick="RemoveRow(${countRow})">-</button>
                                </td>
                            </tr>`;
            $("#itemTable tbody ").append(Row);
        }

        function RemoveRow(params) {
            $("#row_" + params).remove();
            CalulateTotalAmount()
        }


        function GetItemPrice(params, num) {
            var url = "{{ url('getitemprice', []) }}/" + params
            $.getJSON(url, function(result) {
                $("#rate_" + num).val(result.price)
                CalculateProductAmount(result.price, num)
            });
            CalulateTotalAmount()
        }

        function CalculateProductAmount(params, num) {
            var price = $("#rate_" + num).val()
            var qty = $("#qty_" + num).val()
            var amount = Number(price) * Number(qty);
            $("#amount_" + num).val(amount.toFixed(2));
            CalulateTotalAmount()
        }

        function CalulateTotalAmount() {
            var TotalAmount = 0;
            var countRow = $("#itemTable tbody tr").length;
            for (let index = 1; index <= countRow; index++) {
                amount = $("#amount_" + index).val();
                TotalAmount += Number(amount);
            }
            $("#totalamount").val(TotalAmount.toFixed(2));
            console.log(TotalAmount.toFixed(2));
        }
    </script>
@endpush
