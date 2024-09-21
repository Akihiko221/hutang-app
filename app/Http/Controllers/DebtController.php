<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    public function index()
    {
        $debts = Debt::all();
        $totalHutang = $debts->sum('amount');
        return view('hutang.index', compact('debts', 'totalHutang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'creditor' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255', // Validasi nama barang
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
        ]);

        Debt::create([
            'creditor' => $request->input('creditor'),
            'nama_barang' => $request->input('nama_barang'), // Simpan nama barang
            'amount' => $request->input('amount'),
            'due_date' => $request->input('due_date'),
            'user_id' => auth()->id(),
            'status' => $request->input('status', false),
        ]);

        return redirect()->route('hutang.index')->with('success', 'Hutang berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'creditor' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255', // Validasi nama barang
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'status' => 'boolean',
        ]);

        $debt = Debt::findOrFail($id);

        $debt->update([
            'creditor' => $request->input('creditor'),
            'nama_barang' => $request->input('nama_barang'), // Update nama barang
            'amount' => $request->input('amount'),
            'due_date' => $request->input('due_date'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('hutang.index')->with('success', 'Hutang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $debt = Debt::findOrFail($id);
        $debt->delete();
        return redirect()->route('hutang.index')->with('success', 'Hutang berhasil dihapus!');
    }

    public function markAsPaid($id)
    {
        $debt = Debt::findOrFail($id);
        $debt->status = true;
        $debt->save();
        return redirect()->route('hutang.index')->with('success', 'Hutang telah dilunasi!');
    }
}
