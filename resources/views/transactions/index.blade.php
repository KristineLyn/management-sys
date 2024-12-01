@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12">
    <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
        <h3 class="text-xl font-bold text-blue-900 text-center">Transaction Details</h3>

        <form method="GET" action="{{ route('transactions.index') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
            <select name="category" class="border rounded-lg p-2">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                @endforeach
            </select>
            <input type="date" name="start_date" value="{{ request('start_date') }}" class="border rounded-lg p-2" placeholder="Start Date">
            <input type="date" name="end_date" value="{{ request('end_date') }}" class="border rounded-lg p-2" placeholder="End Date">
            <button type="submit" class="col-span-3 text-center text-blue-900 rounded-lg py-2 px-4 shadow-lg ">Filter</button>
        </form>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-6">
        <table class="table-auto w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-4">Title</th>
                    <th class="p-4">Category</th>
                    <th class="p-4">Amount</th>
                    <th class="p-4">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $transaction)
                    <tr>
                        <td class="p-4">{{ $transaction->title }}</td>
                        <td class="p-4">{{ $transaction->category }}</td>
                        <td class="p-4">Rp. {{ number_format($transaction->amount, 2) }}</td>
                        <td class="p-4">{{ $transaction->transaction_date->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-500">No transactions found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <a href="{{ route('transactions.create') }}" class="text-blue-900 rounded-lg py-2 px-4 shadow-lg">
            Add Transaction
        </a>
    </div>
</div>
@endsection