@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h3 class="text-xl font-bold text-blue-900 text-center">Add Transaction</h3>
        <form method="POST" action="{{ route('transactions.store') }}" class="mt-6">
            @csrf
            <div class="grid grid-cols-1 gap-4">
                <input type="text" name="title" class="border rounded-lg p-2" placeholder="Title" required>
                <select name="category" class="border rounded-lg p-2">
                    @foreach ($categories as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>
                <input type="number" step="0.01" name="amount" class="border rounded-lg p-2" placeholder="Amount" required>
                <input type="date" name="transaction_date" class="border rounded-lg p-2" required>
            </div>
            <button type="submit" class="text-blue-900 rounded-lg py-2 px-4 mt-4 shadow:lg">Save Transaction</button>
        </form>
    </div>
</div>
@endsection