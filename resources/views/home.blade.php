@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12">
    <!-- Overview Section -->
    <div class="bg-white shadow-lg rounded-lg p-6 mb-6 hover:shadow-xl transition-shadow">
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
                                backgroundColor: ['#38B2AC', '#FB7185'],
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                            },
                            tooltip: {
                                backgroundColor: '#FFFFFF', 
                                titleColor: '#4A5568', 
                                bodyColor: '#4A5568',
                                borderColor: '#E0E0E0', 
                                borderWidth: 1,
                            },
                        },
                    });
                } else {
                    console.error('No Transactions and Income Found');
                }
            });
        </script>
        <x-overview-layout :totalIncome="$totalIncome" :progressData="$progressData"/>
    </div>

    <!-- Grid Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <x-notification-layout :recent-notifications="$recentNotifications" />
        <x-transaction-layout :recent-transactions="$recentTransactions" />
    </div>
</div>
@endsection