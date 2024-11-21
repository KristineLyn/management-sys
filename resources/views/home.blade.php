@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12">
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const incomeVsTransactionsCanvas = document.getElementById('incomeVsTransactionsChart');
            if (incomeVsTransactionsCanvas) {
                const monthlyIncome = @json($monthlyIncome, JSON_NUMERIC_CHECK);
                const monthlyTransactions = @json($monthlyTransactions, JSON_NUMERIC_CHECK);

                new Chart(incomeVsTransactionsCanvas.getContext('2d'), {
                    type: 'pie',
                    data: {
                        labels: ['Income', 'Transactions'],
                        datasets: [{
                            data: [monthlyIncome, monthlyTransactions],
                            backgroundColor: ['#4CAF50', '#F44336'],
                        }]
                    },
                    options: {
                        responsive: true, // Ensures responsiveness
                        maintainAspectRatio: true, // Keeps the aspect ratio
                        plugins: {
                            legend: {
                                position: 'top', // Position the legend below the chart
                            },
                        },
                    },
                });
            } else {
                console.error('Income vs Transactions chart canvas not found.');
            }
        });
    </script>
    <!-- Overview Section -->
    <div class="bg-white shadow-lg rounded-lg p-6 mb-6 hover:shadow-xl transition-shadow">
        <h3 class="text-xl font-bold text-blue-900 text-center">Overview</h3>
        <p class="text-gray-600 mt-2 text-center">Your monthly financial summary.</p>
        <p class="text-lg text-center mt-4">Total Income: ${{ $totalIncome }}</p>
        <!-- Charts Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Pie Chart -->
            <div class="p-6">
                <div class="w-56 h-56 md:w-40 md:h-40 mx-auto">
                    <canvas id="incomeVsTransactionsChart" class="max-w-full max-h-full"></canvas>
                </div>
            </div>
            @foreach($progressData as $data)
                <div class="m-4">
                    <p>{{ $data->category }}: {{ round($data->percentage, 2) }}%</p>
                    <div class="w-full bg-gray-200 rounded-full h-4">
                        <div class="bg-blue-600 h-4 rounded-full" style="width: {{ $data->percentage }}%;"></div>
                    </div>
                </div>
            @endforeach
            <form action="{{ route('incomes.store') }}" method="POST" class="p-2 space-y-1">
                <h4 class="p-2 text-lg font-semibold">Add Income</h4>
                @csrf
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                    <input type="number" name="amount" id="amount" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">Add Income</button>
            </form>
        </div>
    </div>

    <!-- Grid Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <x-notification-layout :recent-notifications="$recentNotifications" />
        <x-transaction-layout :recent-transactions="$recentTransactions" />
    </div>
</div>
@endsection