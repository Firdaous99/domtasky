<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
        return response()->json($invoices, 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tenant_id' => 'required|exists:tenants,id',
            'client_name' => 'required|string|max:255',
            'status' => 'required|in:Draft,Sent,Paid',
            'total_amount' => 'required|numeric',
            'invoice_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $invoice = Invoice::create([
            'tenant_id' => $request->tenant_id,
            'client_name' => $request->client_name,
            'status' => $request->status,
            'total_amount' => $request->total_amount,
            'invoice_date' => $request->invoice_date,
        ]);

        return response()->json($invoice, 201);
    }

    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->update($request->all());

        return response()->json($invoice, 200);
    }

    public function delete($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return response()->json(null, 204);
    }
}
