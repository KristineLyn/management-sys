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
        <div class="bg-white shadow-lg rounded-lg p-6 text-center hover:shadow-xl transition-shadow">
            <h3 class="text-xl font-bold text-blue-900">Data Management</h3>
            <p class="text-gray-600 mt-2">Analyze and manage your data with ease.</p>
        </div>
    </div>
</div>
@endsection