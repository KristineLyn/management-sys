<!-- Real-Time Notifications -->
<div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition-shadow">
    <h3 class="text-xl font-bold text-blue-900 text-center">Recent Notifications</h3>
    <p class="text-gray-600 mt-2 text-center">Stay updated with the latest notifications.</p>

    <div class="mt-4">
        <table class="table-auto w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-4">Date</th>
                <th class="p-4">Message</th>
                <!-- <th class="p-4">Type</th> -->
            </tr>
        </thead>
        <tbody>
            @forelse ($recentNotifications as $notification)
                <tr>
                    <td class="p-4">{{ \Carbon\Carbon::parse($notification->created_at)->format('d M Y') }}</td>
                    <td class="p-4">{{ $notification->message }}</td>
                    <!-- <td class="p-4">{{ ucfirst($notification->type) }}</td> -->
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="p-4 text-center text-gray-500">No recent notifications available.</td>
                </tr>
            @endforelse
        </tbody>
        </table>
    </div>
    <!-- Button to Notifications Page -->
    <div class="mt-4 text-center">
        <a href="{{ route('notifications.index') }}" class="text-blue-800 rounded-lg py-2 px-4 hover:bg-blue-800 shadow-lg">
            View All Notifications
        </a>
    </div>
</div>