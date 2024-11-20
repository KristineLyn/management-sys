@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h3 class="text-xl font-bold text-blue-900 text-center">Real-Time Notifications</h3>
        <div class="mt-6">
            <table class="table-auto w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <!-- <th class="p-4">Type</th> -->
                        <th class="p-4">Message</th>
                        <th class="p-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($notifications as $notification)
                        <tr>
                            <!-- <td class="p-4">{{ ucfirst($notification->type) }}</td> -->
                            <td class="p-4">{{ $notification->message }}</td>
                            <td class="p-4">
                                @if (!$notification->is_read)
                                    <form method="POST" action="{{ route('notifications.read', $notification->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-blue-800 hover:underline">Mark as Read</button>
                                    </form>
                                @else
                                    <span class="text-gray-500">Read</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-4 text-center text-gray-500">No notifications available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
