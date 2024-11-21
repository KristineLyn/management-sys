<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Income;

class IncomeController extends Controller
{
    /**
     * Store income in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0'
        ]);

        Income::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount
        ]);

        return redirect()->back()->with('success', 'Income added successfully!');
    }

    /**
     * Get income data for charts or summaries.
     */
    public function getIncomeSummary()
    {
        $userId = Auth::id();
        $incomeData = Income::where('user_id', $userId)
            ->selectRaw('SUM(amount) as total_income')
            ->first();

        return response()->json([
            'total_income' => $incomeData->total_income ?? 0
        ]);
    }
}
