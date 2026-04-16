@extends('layouts.app')

@php
    $title = 'Manage Appointments | Life Circle';
@endphp

@section('content')
<div class="flex min-h-screen bg-surface pt-20">
    <!-- Sidebar -->
    <nav class="w-64 bg-white border-r border-outline-variant/10 flex flex-col py-8 fixed h-full">
        <div class="px-6 mb-10">
            <h1 class="text-lg font-bold text-primary">Admin Portal</h1>
            <p class="text-xs text-outline font-normal">Management View</p>
        </div>
        <div class="flex-1 space-y-1">
            <a class="flex items-center gap-3 text-outline rounded-lg mx-2 px-4 py-3 hover:bg-surface-container-low transition-all" href="{{ route('admin.list') }}">
                <span class="material-symbols-outlined">group</span>
                <span>Enrollments</span>
            </a>
            <a class="flex items-center gap-3 bg-primary/5 text-primary rounded-lg mx-2 px-4 py-3 border-r-4 border-primary" href="{{ route('admin.appointments') }}">
                <span class="material-symbols-outlined">calendar_month</span>
                <span class="font-bold">Appointments</span>
            </a>

            <div class="pt-6">
                <a class="flex items-center gap-3 text-red-500 px-4 py-3 mx-2 hover:bg-red-50 rounded-lg transition-all cursor-pointer font-bold" onclick="document.getElementById('logout-form').submit();">
                    <span class="material-symbols-outlined">logout</span>
                    <span>লগআউট (Logout)</span>
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
        <div class="px-4 mt-auto">
            <div class="flex items-center gap-3 px-2 py-4 border-t border-outline-variant/10">
                <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center text-primary font-bold">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div>
                    <p class="text-xs font-bold">{{ auth()->user()->name ?? 'Admin User' }}</p>
                    <p class="text-[10px] text-outline">Super Admin</p>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="ml-64 flex-1 p-10">
        <header class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl font-extrabold text-primary tracking-tight">অ্যাপয়েন্টমেন্ট তালিকা (Appointments)</h2>
                <p class="text-on-surface-variant mt-1">সরাসরি সেশন বুকিংগুলো ম্যানেজ করুন।</p>
            </div>
            <div class="bg-white px-4 py-2 rounded-lg shadow-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">calendar_today</span>
                <span class="text-xs font-bold">{{ date('M d, Y') }}</span>
            </div>
        </header>

        @if (session('success'))
            <div class="mb-6 bg-emerald-100 text-emerald-800 p-4 rounded-lg flex items-center gap-2 animate-fade-in-up">
                <span class="material-symbols-outlined">check_circle</span>
                <span class="font-bold text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Stats Grid -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-xl whisper-shadow border border-outline-variant/10">
                <p class="text-outline text-xs font-medium uppercase tracking-wider">মোট (Total)</p>
                <h3 class="text-3xl font-bold mt-1 text-primary">{{ $total_count }}</h3>
            </div>
            <div class="bg-white p-6 rounded-xl whisper-shadow border border-outline-variant/10">
                <p class="text-outline text-xs font-medium uppercase tracking-wider">পেন্ডিং (Pending)</p>
                <h3 class="text-3xl font-bold mt-1 text-secondary">{{ $pending_count }}</h3>
            </div>
            <div class="bg-white p-6 rounded-xl whisper-shadow border border-outline-variant/10">
                <p class="text-outline text-xs font-medium uppercase tracking-wider">নিশ্চিত (Confirmed)</p>
                <h3 class="text-3xl font-bold mt-1 text-emerald-600">{{ $confirmed_count }}</h3>
            </div>
        </section>

        <!-- Table Section -->
        <section class="bg-white rounded-xl whisper-shadow overflow-hidden">
            <div class="p-6 border-b border-surface-container-high flex justify-between items-center">
                <h3 class="text-xl font-bold">বুকিং তালিকা (Booking List)</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-surface-container-low/50">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold uppercase text-outline">নাম ও ইমেইল</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase text-outline">তারিখ ও সময়</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase text-outline">সার্ভিস ও ট্রানজেকশন</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase text-outline">হোয়াটসঅ্যাপ</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase text-outline">স্টেটাস</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container-low">
                        @forelse($appointments as $appointment)
                        <tr class="hover:bg-surface-container-low/30 transition-colors">
                            <td class="px-6 py-5">
                                <p class="font-bold text-sm">{{ $appointment->full_name }}</p>
                                <p class="text-xs text-outline">{{ $appointment->email }}</p>
                            </td>
                            <td class="px-6 py-5">
                                <p class="text-sm font-bold text-primary">{{ $appointment->appointment_date }}</p>
                                <p class="text-xs text-outline">{{ $appointment->appointment_time ?? 'N/A' }}</p>
                            </td>
                            <td class="px-6 py-5">
                                <p class="text-xs font-bold text-secondary mb-1">{{ $appointment->service_type }}</p>
                                <p class="text-[10px] font-manrope font-bold text-outline">TXID: {{ $appointment->transaction_id }}</p>
                            </td>
                            <td class="px-6 py-5">
                                <a href="https://wa.me/{{ $appointment->whatsapp_number }}" target="_blank" class="flex items-center gap-2 px-3 py-1.5 w-max bg-emerald-600 text-white rounded-lg text-xs font-bold hover:bg-emerald-700 transition">
                                    <span class="material-symbols-outlined text-sm">chat</span>
                                    WhatsApp
                                </a>
                            </td>
                            <td class="px-6 py-5">
                                <form action="{{ route('admin.appointments.update', $appointment->id) }}" method="POST" class="flex flex-col gap-2 relative">
                                    @csrf
                                    <div class="flex items-center gap-2">
                                        <select name="status" class="bg-surface-container-high text-[11px] font-bold rounded-md px-2 py-1.5 border-none focus:ring-1 focus:ring-primary w-24">
                                            <option value="pending" {{ $appointment->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="confirmed" {{ $appointment->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="completed" {{ $appointment->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $appointment->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                        <input type="number" name="payment_amount" value="{{ $appointment->payment_amount }}" placeholder="Amount (৳)" class="bg-surface-container text-[11px] font-bold rounded-md px-2 py-1.5 border-none focus:ring-1 focus:ring-primary w-20" step="0.01">
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <label class="flex items-center gap-1 text-[10px] font-bold text-outline cursor-pointer hover:text-primary transition-colors">
                                            <input type="checkbox" name="is_paid" value="1" {{ $appointment->is_paid ? 'checked' : '' }} class="rounded text-primary focus:ring-primary border-outline-variant/30 w-3 h-3"> Paid
                                        </label>
                                        <button type="submit" class="bg-primary hover:bg-primary-dark text-white rounded text-[10px] px-2 py-1 font-bold transition-colors">Save</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="px-6 py-10 text-center text-outline">কোন অ্যাপয়েন্টমেন্ট পাওয়া যায়নি।</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-surface-container-high bg-white">
                {{ $appointments->links() }}
            </div>
        </section>
    </main>
</div>
@endsection
