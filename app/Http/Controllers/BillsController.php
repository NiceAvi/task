<?php

namespace App\Http\Controllers;


use App\BillHeader;
use App\BillHeaderItems;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\BillStoreRequest;
use App\Http\Requests\BillsStoreRequest;
use App\Http\Requests\BillUpdateRequest;
use App\Http\Requests\BillsUpdateRequest;
use App\Items;

class BillsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bills = BillHeader::all();

        return view('bill.index', compact('bills'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $customers = Customer::all();
        $items = Items::all();
        return view('bill.create', compact('customers', 'items'));
    }

    /**
     * @param \App\Http\Requests\BillsStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BillStoreRequest $request)
    {
        // dd($request);
        $bill['date'] = $request->date;
        $bill['bill_no'] = $request->bill_no;
        $bill['customer_id'] = $request->customer_id;
        $bill['total_amount'] = $request->totalamount;
        $bill = BillHeader::create($bill);
        $count = count($request->item_id);
        for ($i = 0; $i < $count; $i++) {
            $billHeaderItem = new BillHeaderItems();
            $billHeaderItem->item_id = $request->item_id[$i];
            $billHeaderItem->rate = $request->rate[$i];
            $billHeaderItem->qty = $request->qty[$i];
            $billHeaderItem->base_amount = $request->amount[$i];
            $billHeaderItem->bill_id = $bill->id;
            $billHeaderItem->save();
        }

        $request->session()->flash('bill.id', $bill->id);

        return redirect()->route('bills.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\bill $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BillHeader $bill)
    {
        $customers = Customer::all();
        $items = Items::all();
        $bill = $bill->with('billHeaderItems')->with('customer')->first();
        return view('bill.show', compact('bill', 'customers', 'items'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\bill $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, BillHeader $bill)
    {
        $customers = Customer::all();
        $items = Items::all();
        $bills = $bill->with('billHeaderItems')->with('customer')->first();
        // dd($bills);
        return view('bill.edit', compact('bills', 'customers', 'items'));
    }

    /**
     * @param \App\Http\Requests\BillsUpdateRequest $request
     * @param \App\bill $bill
     * @return \Illuminate\Http\Response
     */
    public function update(BillUpdateRequest $request, BillHeader $bill)
    {
        $bill->date = $request->date;
        $bill->bill_no = $request->bill_no;
        $bill->customer_id = $request->customer_id;
        $bill->total_amount = $request->totalamount;
        $bill->save();

        if ($request->has('item_id')) {
            BillHeaderItems::where('bill_id',$bill->id)->delete();
            $count = count($request->item_id);
            for ($i = 0; $i < $count; $i++) {
                $billHeaderItem = new BillHeaderItems();
                $billHeaderItem->item_id = $request->item_id[$i];
                $billHeaderItem->rate = $request->rate[$i];
                $billHeaderItem->qty = $request->qty[$i];
                $billHeaderItem->base_amount = $request->amount[$i];
                $billHeaderItem->bill_id = $bill->id;
                $billHeaderItem->save();
            }
        }

        $request->session()->flash('bill.id', $bill->id);

        return redirect()->route('bills.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\bill $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, BillHeader $bill)
    {
        $bill->delete();
        BillHeaderItems::where('bill_id',$bill->id)->delete();
        return redirect()->route('bills.index');
    }
}
