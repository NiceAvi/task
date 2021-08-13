<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;

class CustomerController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Customer::all();

        return view('customer.index', compact('customers'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('customer.create');
    }

    /**
     * @param \App\Http\Requests\CustomerStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerStoreRequest $request)
    {
        $customer = Customer::create($request->validated());

        $request->session()->flash('customer.id', $customer->id);

        return redirect()->route('customer.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Customer $customer)
    {
        return view('customer.show', compact('customer'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Customer $customer)
    {
        return view('customer.edit', compact('customer'));
    }

    /**
     * @param \App\Http\Requests\CustomerUpdateRequest $request
     * @param \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $customer->update($request->validated());

        $request->session()->flash('customer.id', $customer->id);

        return redirect()->route('customer.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customer.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function getcustomer($id)
    {
        $customer = Customer::find($id);
        return Response::json($customer, 200);
    }
}
