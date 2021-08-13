<?php

namespace Tests\Feature\Http\Controllers;

use App\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CustomerController
 */
class CustomerControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $customers = factory(Customer::class, 3)->create();

        $response = $this->get(route('customer.index'));

        $response->assertOk();
        $response->assertViewIs('customer.index');
        $response->assertViewHas('customers');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('customer.create'));

        $response->assertOk();
        $response->assertViewIs('customer.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CustomerController::class,
            'store',
            \App\Http\Requests\CustomerStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $address = $this->faker->word;

        $response = $this->post(route('customer.store'), [
            'name' => $name,
            'address' => $address,
        ]);

        $customers = Customer::query()
            ->where('name', $name)
            ->where('address', $address)
            ->get();
        $this->assertCount(1, $customers);
        $customer = $customers->first();

        $response->assertRedirect(route('customer.index'));
        $response->assertSessionHas('customer.id', $customer->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $customer = factory(Customer::class)->create();

        $response = $this->get(route('customer.show', $customer));

        $response->assertOk();
        $response->assertViewIs('customer.show');
        $response->assertViewHas('customer');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $customer = factory(Customer::class)->create();

        $response = $this->get(route('customer.edit', $customer));

        $response->assertOk();
        $response->assertViewIs('customer.edit');
        $response->assertViewHas('customer');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CustomerController::class,
            'update',
            \App\Http\Requests\CustomerUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $customer = factory(Customer::class)->create();
        $name = $this->faker->name;
        $address = $this->faker->word;

        $response = $this->put(route('customer.update', $customer), [
            'name' => $name,
            'address' => $address,
        ]);

        $customer->refresh();

        $response->assertRedirect(route('customer.index'));
        $response->assertSessionHas('customer.id', $customer->id);

        $this->assertEquals($name, $customer->name);
        $this->assertEquals($address, $customer->address);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $customer = factory(Customer::class)->create();

        $response = $this->delete(route('customer.destroy', $customer));

        $response->assertRedirect(route('customer.index'));

        $this->assertSoftDeleted($customer);
    }
}
