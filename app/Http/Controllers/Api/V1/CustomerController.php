<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\CustomerFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Http\Resources\V1\CustomerResource;
use App\Http\Resources\V1\CustomerCollection;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request): CustomerCollection
    {
        $filter = new CustomerFilter();
        $queryItems = $filter->transform($request);

        if (count($queryItems) === 0) {
            return new CustomerCollection(Customer::paginate());
        } else {
            $customer = Customer::where($queryItems)->paginate();
            return new CustomerCollection($customer->appends($request)->query());
        }
    }


    public function create()
    {
        //
    }


    public function store(StoreCustomerRequest $request)
    {
        //
    }


    public function show(Customer $customer): CustomerResource
    {
        return new CustomerResource($customer);
    }


    public function edit(Customer $customer)
    {
        //
    }


    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }


    public function destroy(Customer $customer)
    {
        //
    }
}
