<?php

namespace App\Http\Controllers;

use App\Items;
use Illuminate\Http\Request;
use App\Http\Requests\ItemStoreRequest;
use App\Http\Requests\ItemUpdateRequest;
use Illuminate\Support\Facades\Response;

class ItemsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = Items::all();

        return view('item.index', compact('items'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('item.create');
    }

    /**
     * @param \App\Http\Requests\ItemsStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemStoreRequest $request)
    {
        $item = Items::create($request->validated());

        $request->session()->flash('item.id', $item->id);

        return redirect()->route('items.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\item $item
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Items $item)
    {
        return view('item.show', compact('item'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\item $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Items $item)
    {
        return view('item.edit', compact('item'));
    }

    /**
     * @param \App\Http\Requests\ItemsUpdateRequest $request
     * @param \App\item $item
     * @return \Illuminate\Http\Response
     */
    public function update(ItemUpdateRequest $request, Items $item)
    {
        $item->update($request->validated());

        $request->session()->flash('item.id', $item->id);

        return redirect()->route('items.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\item $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Items $item)
    {
        $item->delete();

        return redirect()->route('items.index');
    }

    public function getItemPrice($id)
    {
        $item = Items::find($id);
        return Response::json($item, 200);
    }
}
