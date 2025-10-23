<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
public function index(Request $request)
{
    $year = $request->input('year', now()->year);
    $month = $request->input('month', now()->month);
    $user = auth()->user();

    $totalRevenues = $user->transactions()
        ->where('type', 'revenue')
        ->whereYear('date', $year)
        ->whereMonth('date', $month)
        ->sum('amount');

    $totalExpenses = $user->transactions()
        ->where('type', 'expense')
        ->whereYear('date', $year)
        ->whereMonth('date', $month)
        ->sum('amount');

    $balance = $totalRevenues - $totalExpenses;

    $budgets = DB::table('budgets')
        ->join('categories', 'budgets.category_id', '=', 'categories.id')
        ->leftJoin('transactions', function ($join) use ($user, $year, $month) {
            $join->on('transactions.category_id', '=', 'budgets.category_id')
                ->where('transactions.user_id', '=', $user->id)
                ->whereYear('transactions.date', $year)
                ->whereMonth('transactions.date', $month);
        })
        ->where('budgets.user_id', $user->id)
        ->where('budgets.year', $year)
        ->where('budgets.month', $month)
        ->select(
            'categories.name as category_name',
            'budgets.amount as budgeted',
            DB::raw('COALESCE(SUM(transactions.amount), 0) as spent')
        )
        ->groupBy('categories.name', 'budgets.amount')
        ->get();

    foreach ($budgets as $budget) {
        $budget->percentage = $budget->budgeted > 0
            ? ($budget->spent / $budget->budgeted) * 100
            : 0;
    }

    return view('dashboard', [
        'totalRevenues' => $totalRevenues,
        'totalExpenses' => $totalExpenses,
        'balance' => $balance,
        'selectedYear' => $year,
        'selectedMonth' => $month,
        'budgets' => $budgets,
    ]);
}

}
