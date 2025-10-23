<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $year = $request->input('year', Carbon::now()->year);
        $month = $request->input('month', Carbon::now()->month);

        $totalExpenses = $user->transactions()
            ->where('type', 'expense')
            ->whereYear('date', $year)
            ->whereMonth('date', 'month')
            ->sum('amount');

        $topSpendingCategories = $user->transactions()
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->where('transactions.type', 'expense')
            ->whereYear('transactions.date', $year)
            ->whereMonth('transactions.date', $month)
            ->select('categories.name as category_name', DB::raw('SUM(transactions.amount) as total'))
            ->groupBy('categories.name')
            ->orderBy('total', 'desc')
            ->get();

        $largestExpenses = $user->transactions()
            ->where('type', 'expense')
            ->whereYear('date', $year)
            ->whereMonth('date', 'month')
            ->orderBy('amount', 'desc')
            ->limit(5)
            ->get();

        return view('reports.index', [
            'topSpendingCategories' => $topSpendingCategories,
            'largestExpenses' => $largestExpenses,
            'totalExpenses' => $totalExpenses,
            'selectedYear' => $year,
            'selectedMonth' => $month,
        ]);
    }
}
