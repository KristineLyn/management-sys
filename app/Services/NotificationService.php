<?php 

namespace App\Services;

use App\Models\Notification;
use App\Models\Transaction;
use App\Models\Income;
use Illuminate\Support\Facades\Auth;

class NotificationService
{
    public static function generateForUser($userId)
    {
        $transactions = Transaction::where('user_id', $userId)->get();
        $income = Income::where('user_id', $userId)->sum('amount');
        $monthlyTransactions = $transactions->groupBy(fn($tx) => $tx->transaction_date->format('Y-m'))
            ->map(fn($txs) => $txs->sum('amount'));

        foreach ($transactions as $transaction) {
            Notification::updateOrCreate(
                ['user_id' => $userId, 'message' => "Transaction: {$transaction->title} - Amount: {$transaction->amount}"],
                ['type' => 'basic', 'is_read' => false]
            );
        }

        foreach ($monthlyTransactions as $month => $total) {
            $thresholds = [0.5, 0.75, 1.0];
            foreach ($thresholds as $threshold) {
                if ($total >= $income * $threshold) {
                    Notification::updateOrCreate(
                        ['user_id' => $userId, 'message' => "Monthly spending reached " . ($threshold * 100) . "% of income for $month."],
                        ['type' => 'alert', 'is_read' => false]
                    );
                }
            }
        }
    }
}
