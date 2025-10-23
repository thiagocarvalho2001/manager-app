<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function monthlyExpenses(Request $request)
    {
        $user = auth()->user();

        $year = $request->input('year', Carbon::now()->year);
        $month = $request->input('month', Carbon::now()->month);

        $expensesByCategory = $user->transactions()
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->where('transactions.type', 'expense')
            ->whereYear('transactions.date', $year)
            ->whereMonth('transactions.date', $month)
            ->select('categories.name as category_name', DB::raw('SUM(transactions.amount) as total_amount'))
            ->groupBy('categories.name')
            ->orderBy('total_amount', 'desc')
            ->get();

        return response()->json($expensesByCategory);
    }
}
