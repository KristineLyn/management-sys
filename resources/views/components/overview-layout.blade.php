<h3 class="text-xl font-bold text-blue-900 text-center">Overview</h3>
<p class="text-gray-600 mt-2 text-center">Your monthly financial summary.</p>
<p class="text-lg text-center mt-4 mb-4">Total Income: Rp. {{ number_format($totalIncome) }}</p>
<!-- Charts Section -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
    <!-- Pie Chart -->
    <div class="p-6">
        <div class="h-40 md:h-96 mx-auto">
            <canvas id="incomeVsTransactionsChart" class="max-w-full max-h-full rounded-lg" style="background-color: #E0F2F1;"></canvas>
        </div>
    </div>
    <div class="m-4">
        @foreach($progressData as $data)
        <p>{{ $data->category }}: {{ round($data->percentage, 2) }}%</p>
        <div class="w-full bg-gray-200 rounded-full h-4">
            <div class="bg-blue-600 h-4 rounded-full" style="width: {{ round($data->percentage ?? 0, 2) }}% ;"></div>
        </div>
        @endforeach
    </div>
</div>
<div class="flex justify-center items-center">
    <form action="{{ route('incomes.store') }}" method="POST" class="p-6 w-96 space-y-4 ">
        <h4 class="text-lg font-semibold text-center">Add Income</h4>
        @csrf
        <div>
            <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
            <input type="number" name="amount" id="amount" required
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        </div>
        <button type="submit" class="w-full text-blue-800 rounded-lg py-2 px-4 hover:bg-blue-200 shadow-lg">Add Income</button>
    </form>
</div>