<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);
        $month = $request->input('month', Carbon::now()->month);

        $user = auth()->user();

        $transactionsQuery = $user->transactions()->with('category');

        $transactionsQuery->whereYear('date', $year)->whereMonth('date', $month);

        $transactions = $transactionsQuery->latest()->get();

        return view('transactions.index', [
            'transactions' => $transactions,
            'selectedYear' => $year,
            'selectedMonth' => $month,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = auth()->user()->categories;
        return view('transactions.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'type' => 'required|in:revenue,expense',
            'category_id' => 'nullable|exists:categories,id',
            'date' => 'required|date',
        ]);

        auth()->user()->transactions()->create(
            $request->only(['description', 'amount', 'type', 'category_id', 'date'])
        );

        return redirect()->route('transactions.index')->with('success', 'Transaction created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('transactions.index');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        abort_if($transaction->user_id !== auth()->id(), 403);

        $categories = auth()->user()->categories;
        return view('transactions.edit', compact('transaction', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        abort_if($transaction->user_id !== auth()->id(), 403, 'Acess Denied');

        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'type' => 'required|in:revenue,expense',
            'category_id' => 'nullable|exists:categories,id',
            'date' => 'required|date',
        ]);

        $transaction->update($request->all());

        return redirect()->route('transactions.index')->with('success', 'Transaction Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        abort_if($transaction->user_id !== auth()->id(), 403);

        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted!');
    }
}
