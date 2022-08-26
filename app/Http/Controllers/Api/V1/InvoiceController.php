<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\InvoiceFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\BulkStoreInvoiceRequest;
use App\Http\Requests\V1\StoreInvoiceRequest;
use App\Http\Requests\V1\UpdateInvoiceRequest;
use App\Http\Resources\V1\InvoiceCollection;
use App\Http\Resources\V1\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class InvoiceController extends Controller
{
    public function index(Request $request): InvoiceCollection
    {
        $filter = new InvoiceFilter();
        $queryItems = $filter->transform($request);

        if (count($queryItems) === 0) {
            return new InvoiceCollection(Invoice::paginate());
        } else {
            $invoice = Invoice::where($queryItems)->paginate();

            return new InvoiceCollection($invoice->appends($request->query()));
        }
    }


    public function create()
    {
        //
    }


    public function store(StoreInvoiceRequest $request)
    {
        //
    }

    public function bulkStore(BulkStoreInvoiceRequest $request)
    {
        $bulk = collect($request->all())->map(function ($arr, $key) {
           return Arr::except($arr, ['customerId', 'billedDate', 'paidDate']);
        });

        Invoice::insert($bulk->toArray());
    }


    public function show(Invoice $invoice): InvoiceResource
    {
        return new InvoiceResource($invoice);
    }


    public function edit(Invoice $invoice)
    {
        //
    }


    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }


    public function destroy(Invoice $invoice)
    {
        //
    }
}
