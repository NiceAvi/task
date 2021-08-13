<?php

namespace Tests\Feature\Http\Controllers;

use App\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ItemsController
 */
class ItemsControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $items = factory(Items::class, 3)->create();

        $response = $this->get(route('item.index'));

        $response->assertOk();
        $response->assertViewIs('item.index');
        $response->assertViewHas('items');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('item.create'));

        $response->assertOk();
        $response->assertViewIs('item.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ItemsController::class,
            'store',
            \App\Http\Requests\ItemsStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $response = $this->post(route('item.store'));

        $response->assertRedirect(route('item.index'));
        $response->assertSessionHas('item.id', $item->id);

        $this->assertDatabaseHas(items, [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $item = factory(Items::class)->create();

        $response = $this->get(route('item.show', $item));

        $response->assertOk();
        $response->assertViewIs('item.show');
        $response->assertViewHas('item');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $item = factory(Items::class)->create();

        $response = $this->get(route('item.edit', $item));

        $response->assertOk();
        $response->assertViewIs('item.edit');
        $response->assertViewHas('item');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ItemsController::class,
            'update',
            \App\Http\Requests\ItemsUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $item = factory(Items::class)->create();

        $response = $this->put(route('item.update', $item));

        $item->refresh();

        $response->assertRedirect(route('item.index'));
        $response->assertSessionHas('item.id', $item->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $item = factory(Items::class)->create();
        $item = factory(Item::class)->create();

        $response = $this->delete(route('item.destroy', $item));

        $response->assertRedirect(route('item.index'));

        $this->assertDeleted($item);
    }
}
