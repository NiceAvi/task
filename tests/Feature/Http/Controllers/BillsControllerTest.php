<?php

namespace Tests\Feature\Http\Controllers;

use App\Bill;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BillsController
 */
class BillsControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $bills = factory(Bills::class, 3)->create();

        $response = $this->get(route('bill.index'));

        $response->assertOk();
        $response->assertViewIs('bill.index');
        $response->assertViewHas('bills');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('bill.create'));

        $response->assertOk();
        $response->assertViewIs('bill.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BillsController::class,
            'store',
            \App\Http\Requests\BillsStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $response = $this->post(route('bill.store'));

        $response->assertRedirect(route('bill.index'));
        $response->assertSessionHas('bill.id', $bill->id);

        $this->assertDatabaseHas(bills, [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $bill = factory(Bills::class)->create();

        $response = $this->get(route('bill.show', $bill));

        $response->assertOk();
        $response->assertViewIs('bill.show');
        $response->assertViewHas('bill');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $bill = factory(Bills::class)->create();

        $response = $this->get(route('bill.edit', $bill));

        $response->assertOk();
        $response->assertViewIs('bill.edit');
        $response->assertViewHas('bill');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BillsController::class,
            'update',
            \App\Http\Requests\BillsUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $bill = factory(Bills::class)->create();

        $response = $this->put(route('bill.update', $bill));

        $bill->refresh();

        $response->assertRedirect(route('bill.index'));
        $response->assertSessionHas('bill.id', $bill->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $bill = factory(Bills::class)->create();
        $bill = factory(Bill::class)->create();

        $response = $this->delete(route('bill.destroy', $bill));

        $response->assertRedirect(route('bill.index'));

        $this->assertDeleted($bill);
    }
}
