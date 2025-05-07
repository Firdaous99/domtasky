<?php

namespace App\Http\Controllers;

use App\Models\InvoiceItem;
use Illuminate\Http\Request;

class InvoiceItemController extends Controller
{
    public function index()
    {
        return InvoiceItem::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'task_id' => 'required|exists:tasks,id',
            'description' => 'required|string|max:255',
            'hours' => 'required|numeric|min:0',
            'rate' => 'required|numeric|min:0',
        ]);

        $invoiceItem = InvoiceItem::create($request->all());

        return response()->json($invoiceItem, 201);
    }

    public function show($id)
    {
        return InvoiceItem::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $invoiceItem = InvoiceItem::findOrFail($id);
        $invoiceItem->update($request->all());

        return response()->json($invoiceItem, 200);
    }

    public function destroy($id)
    {
        $invoiceItem = InvoiceItem::findOrFail($id);
        $invoiceItem->delete();

        return response()->json(null, 204);
    }
}
