@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12">
    <!-- Overview Section -->
    <div class="bg-white shadow-lg rounded-lg p-6 mb-6 hover:shadow-xl transition-shadow">
        <h3 class="text-xl font-bold text-blue-900 text-center">Overview</h3>
        <p class="text-gray-600 mt-2 text-center">A summary of key insights and activities.</p>
    </div>

    <!-- Grid Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <!-- Real-Time Notifications -->
        <div class="bg-white shadow-lg rounded-lg p-6 text-center hover:shadow-xl transition-shadow">
            <h3 class="text-xl font-bold text-blue-900">Real-Time Notifications</h3>
            <p class="text-gray-600 mt-2">Stay updated with instant notifications and alerts.</p>
        </div>

        <!-- Data Management -->
        <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition-shadow">
            <h3 class="text-xl font-bold text-blue-900 text-center">Data Management</h3>
            <p class="text-gray-600 mt-2 text-center">Analyze and manage your data with ease.</p>

            <!-- Recent Transactions -->
            <div class="mt-4">
                <table class="table-auto w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="p-4">Date</th>
                            <th class="p-4">Title</th>
                            <th class="p-4">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentTransactions as $transaction)
                            <tr>
                                <td class="p-4">{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') }}</td>
                                <td class="p-4">{{ $transaction->title }}</td>
                                <td class="p-4">${{ number_format($transaction->amount, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="p-4 text-center text-gray-500">No recent transactions available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Button to Transactions Page -->
            <div class="mt-4 text-center">
                <a href="{{ route('transactions.index') }}" class="text-blue-800 rounded-lg py-2 px-4 hover:bg-blue-800 shadow-lg">
                    View All Transactions
                </a>
            </div>
        </div>
    </div>
</div>
@endsection