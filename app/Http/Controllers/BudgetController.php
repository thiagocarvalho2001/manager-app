<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     * Esta página deve listar os orçamentos para gerenciamento (editar/excluir).
     */
    public function index(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);
        $month = $request->input('month', Carbon::now()->month);
        $user = auth()->user();

        $budgets = $user->budgets()
            ->where('year', $year)
            ->where('month', $month)
            ->get();

        $spendingByCategory = $user->transactions()
            ->where('type', 'expense')
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->groupBy('category_id')
            ->select('category_id', DB::raw('SUM(amount) as total_spent'))
            ->pluck('total_spent', 'category_id');

        $budgetDetails = $budgets->map(function ($budget) use ($spendingByCategory) {
            $spent = $spendingByCategory->get($budget->category_id, 0);
            $percentage = ($budget->amount > 0) ? ($spent / $budget->amount) * 100 : 0;

            return (object) [
                'id' => $budget->id,
                'category_name' => $budget->category->name ?? 'No category',
                'budgeted' => $budget->amount,
                'spent' => $spent,
                'percentage' => round($percentage),
            ];
        });

        return view('budgets.index', [
            'budgetDetails' => $budgetDetails,
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
        return view('budgets.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
                Rule::unique('budgets')->where(function ($query) use ($request) {
                    return $query->where('user_id', auth()->id())
                        ->where('month', $request->month)
                        ->where('year', $request->year);
                }),
            ],
            'amount' => 'required|numeric|min:0.01',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2000',
        ], [
            'category_id.unique' => 'You already have a budget for this category in the specified period.'
        ]);

        auth()->user()->budgets()->create($request->all());

        return redirect()->route('budgets.index')->with('success', 'budget created!');
    }

    /**
     * Display the specified resource.
     * (Não precisamos de uma página individual, então redirecionamos para a lista)
     */
    public function show(Budget $budget)
    {
        return redirect()->route('budgets.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Budget $budget)
    {
        abort_if(auth()->id() !== $budget->user_id, 403, 'Acess denied');

        $categories = auth()->user()->categories;
        return view('budgets.edit', compact('budget', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Budget $budget)
    {
        abort_if(auth()->id() !== $budget->user_id, 403, 'Acess denied');

        $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
                Rule::unique('budgets')->where(function ($query) use ($request) {
                    return $query->where('user_id', auth()->id())
                        ->where('month', $request->month)
                        ->where('year', $request->year);
                })->ignore($budget->id),
            ],
            'amount' => 'required|numeric|min:0.01',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2000',
        ], [
            'category_id.unique' => 'You already have a budget for this category in the specified period.'
        ]);

        $budget->update($request->all());

        return redirect()->route('budgets.index')->with('success', 'budget updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Budget $budget)
    {
        abort_if(auth()->id() !== $budget->user_id, 403, 'Acess denied');

        $budget->delete();

        return redirect()->route('budgets.index')->with('success', 'Budget deleted with sucessfull!');
    }
}
