<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\CustomerFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreCustomerRequest;
use App\Http\Requests\V1\UpdateCustomerRequest;
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request): CustomerCollection
    {
        $filter = new CustomerFilter();
        $filterItems = $filter->transform($request);

        $includeInvoices = $request->query('includeInvoices');
        $customer = Customer::where($filterItems);

        if ($includeInvoices) {
            $customer = $customer->with('invoices');
        }

        return new CustomerCollection($customer->paginate()->appends($request->query()));
    }


    public function store(StoreCustomerRequest $request)
    {
        return new CustomerResource(Customer::create($request->all()));
    }


    public function show(Customer $customer): CustomerResource
    {
        $includeInvoices = request()->query('includeInvoices');

        if ($includeInvoices) {
            return new CustomerResource($customer->loadMissing('invoices'));
        }
        return new CustomerResource($customer);
    }


    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());
    }


    public function destroy(Customer $customer)
    {
        //
    }
}
