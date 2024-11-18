@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-semibold mb-4">Edit Profile</h2>
    
    <div class="space-y-6">
        <!-- Update Profile Information -->
        @include('profile.partials.update-profile-information-form')
        
        <!-- Update Password -->
        @include('profile.partials.update-password-form')
        
        <!-- Delete User Form -->
        @include('profile.partials.delete-user-form')
    </div>
</div>
@endsection