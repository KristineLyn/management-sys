<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Notification;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $categories = ['Primary', 'Health', 'Education', 'Entertainment', 'Investment', 'Debt', 'Donation', 'Other'];

        $transactions = Transaction::where('user_id', $user->id)
            ->when($request->category, 
            fn($query) => 
            $query->where('category', $request->category))
            ->when(
                $request->start_date && $request->end_date, 
                fn($query) => 
                $query->whereBetween('transaction_date', [$request->start_date, $request->end_date])
            )
            ->orderBy('transaction_date', 'desc')
            ->get();

        return view('transactions.index', compact('transactions', 'categories'));
    }

    public function create()
    {
        $categories = ['Primary', 'Health', 'Education', 'Entertainment', 'Investment', 'Debt', 'Donation', 'Other'];
        return view('transactions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:Primary,Health,Education,Entertainment,Investment,Debt,Donation,Other',
            'amount' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
        ]);

        Transaction::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'category' => $request->category,
            'amount' => $request->amount,
            'transaction_date' => $request->transaction_date,
        ]);
    
        // Generate notifications for the user
        NotificationService::generateForUser(Auth::id());

        return redirect()->route('transactions.index')->with('success', 'Transaction added successfully.');
    }

    public function home()
    {
        $userId = Auth::id();
        $currentMonth = now()->startOfMonth();

        // Fetch transactions grouped by category (optional for progress bar)
        $transactionData = Transaction::where('user_id', $userId)
        ->where('transaction_date','>=', $currentMonth)
        ->selectRaw('category, SUM(amount) as total_amount')
        ->groupBy('category')
        ->get();

        // Calculate total monthly income
        $monthlyIncome = Income::where('user_id', $userId)
            ->where('created_at', '>=',$currentMonth)
            ->sum('amount');

        // Calculate total monthly transactions
        $monthlyTransactions = Transaction::where('user_id', $userId)
            ->where('transaction_date', $currentMonth)
            ->sum('amount');

        // Fetch transactions grouped by category
        $transactionData = Transaction::where('user_id', $userId)
            ->where('transaction_date', '>=', $currentMonth)
            ->selectRaw('category, SUM(amount) as total_amount')
            ->groupBy('category')
            ->get();

        // Fetch total income
        $totalIncome = Income::where('user_id', $userId)
            ->where('created_at', '>=', $currentMonth)
            ->sum('amount');
        
        // Fetch transaction data per category
        $progressData = $transactionData->map(function ($item) use ($totalIncome) {
            $item->percentage = $totalIncome > 0 ? ($item->total_amount / $totalIncome) * 100 : 0;
            return $item;
        });

        $recentTransactions = Transaction::where('user_id', Auth::id())
            ->orderBy('transaction_date', 'desc')
            ->take(3)
            ->get(['transaction_date', 'title', 'amount']);
        
        $recentNotifications = Notification::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get(['created_at', 'message']);


        return view('home', compact(
            'recentTransactions',
            'recentNotifications',
            'transactionData',
            'totalIncome',
            'progressData',
            'monthlyIncome',
            'monthlyTransactions'));
    }
}
