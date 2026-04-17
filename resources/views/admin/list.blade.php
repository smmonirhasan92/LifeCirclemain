@extends('layouts.app')

@php
    $title = 'Admin Dashboard | Life Circle';
@endphp

@section('content')
<!-- Admin Sidebar & Main Content Layout -->
<div class="flex min-h-screen bg-surface pt-20">
    <!-- SideNavBar (Humanized & Clean) -->
    <nav class="w-64 bg-white border-r border-outline-variant/10 flex flex-col py-8 fixed h-full">
        <div class="px-6 mb-10">
            <h1 class="text-lg font-bold text-primary">Admin Portal</h1>
            <p class="text-xs text-outline font-normal">Management View</p>
        </div>
        <div class="flex-1 space-y-1">
            <a class="flex items-center gap-3 bg-primary/5 text-primary rounded-lg mx-2 px-4 py-3 border-r-4 border-primary" href="{{ route('admin.list') }}">
                <span class="material-symbols-outlined">group</span>
                <span class="font-bold">Enrollments</span>
            </a>
            <a class="flex items-center gap-3 text-outline px-4 py-3 mx-2 hover:bg-surface-container-low transition-all" href="{{ route('admin.appointments') }}">
                <span class="material-symbols-outlined">calendar_month</span>
                <span>Appointments</span>
            </a>

            <div class="pt-6 space-y-2">
                <a class="flex items-center gap-3 text-amber-600 px-4 py-3 mx-2 hover:bg-amber-50 rounded-lg transition-all font-bold" href="{{ route('admin.clear-cache') }}">
                    <span class="material-symbols-outlined">cleaning_services</span>
                    <span>Clear Visual Cache</span>
                </a>
                
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

    <!-- Main Content Canvas -->
    <main class="ml-64 flex-1 p-10">
        <header class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl font-extrabold text-primary tracking-tight">সদস্যভুক্তি তালিকা (Enrollments)</h2>
                <p class="text-on-surface-variant mt-1">রিয়ে-টাইম ডাটাবেস মনিটর করুন।</p>
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
        <section class="grid grid-cols-2 md:grid-cols-5 gap-6 mb-10">
            <div class="bg-white p-5 rounded-xl whisper-shadow border border-outline-variant/10">
                <p class="text-outline text-xs font-medium uppercase tracking-wider">মোট (Total)</p>
                <h3 class="text-3xl font-bold mt-1 text-primary">{{ $stats->total }}</h3>
            </div>
            <div class="bg-white p-5 rounded-xl whisper-shadow border border-outline-variant/10">
                <p class="text-outline text-xs font-medium uppercase tracking-wider">পেন্ডিং (Pending)</p>
                <h3 class="text-3xl font-bold mt-1 text-secondary">{{ $stats->pending }}</h3>
            </div>
            <div class="bg-white p-5 rounded-xl whisper-shadow border border-outline-variant/10">
                <p class="text-outline text-xs font-medium uppercase tracking-wider">যোগাযোগ (Contacted)</p>
                <h3 class="text-3xl font-bold mt-1 text-blue-600">{{ $stats->contacted }}</h3>
            </div>
            <div class="bg-white p-5 rounded-xl whisper-shadow border border-outline-variant/10">
                <p class="text-outline text-xs font-medium uppercase tracking-wider">এনরোলড (Enrolled)</p>
                <h3 class="text-3xl font-bold mt-1 text-emerald-600">{{ $stats->enrolled }}</h3>
            </div>
            <div class="bg-white p-5 rounded-xl whisper-shadow border border-outline-variant/10">
                <p class="text-outline text-xs font-medium uppercase tracking-wider">সম্পন্ন (Completed)</p>
                <h3 class="text-3xl font-bold mt-1 text-gray-800">{{ $stats->completed }}</h3>
            </div>
        </section>

        <!-- Table Section -->
        <section class="bg-white rounded-xl whisper-shadow overflow-hidden">
            <div class="p-6 border-b border-surface-container-high flex justify-between items-center">
                <h3 class="text-xl font-bold">সাম্প্রতিক তালিকা (Recent List)</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-surface-container-low/50">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-outline">নাম ও ইমেইল</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-outline">সার্ভিস</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-outline">ট্রানজেকশন আইডি</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-outline">হোয়াটসঅ্যাপ</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-outline">স্টেটাস</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container-low">
                        @forelse($enrollments ?? [] as $enrollment)
                        <tr class="hover:bg-surface-container-low/30 transition-colors">
                            <td class="px-6 py-5">
                                <p class="font-bold text-sm">{{ $enrollment->full_name }}</p>
                                <p class="text-xs text-outline">{{ $enrollment->email }}</p>
                            </td>
                            <td class="px-6 py-5">
                                <span class="bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full text-[10px] font-bold">
                                    {{ $enrollment->service_type }}
                                </span>
                            </td>
                            <td class="px-6 py-5 font-manrope text-sm font-bold text-primary">
                                {{ $enrollment->transaction_id }}
                            </td>
                            <td class="px-6 py-5">
                                <a href="https://wa.me/{{ preg_replace('/\D/', '', $enrollment->whatsapp_number) }}" target="_blank" class="flex items-center gap-2 px-3 py-1.5 w-max bg-emerald-600 text-white rounded-lg text-xs font-bold hover:bg-emerald-700 transition">
                                    <span class="material-symbols-outlined text-sm">chat</span>
                                    WhatsApp
                                </a>
                            </td>
                            <td class="px-6 py-5">
                                <form action="{{ route('admin.status.update', $enrollment->id) }}" method="POST" class="flex flex-col gap-2 relative">
                                    @csrf
                                    <div class="flex items-center gap-2">
                                        <select name="status" class="bg-surface-container-high text-[11px] font-bold rounded-md px-2 py-1.5 border-none focus:ring-1 focus:ring-primary w-24">
                                            <option value="pending" {{ $enrollment->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="contacted" {{ $enrollment->status === 'contacted' ? 'selected' : '' }}>Contacted</option>
                                            <option value="enrolled" {{ $enrollment->status === 'enrolled' ? 'selected' : '' }}>Enrolled</option>
                                            <option value="completed" {{ $enrollment->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                        </select>
                                        <input type="number" name="payment_amount" value="{{ $enrollment->payment_amount }}" placeholder="Amount (৳)" class="bg-surface-container text-[11px] font-bold rounded-md px-2 py-1.5 border-none focus:ring-1 focus:ring-primary w-20" step="0.01">
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <label class="flex items-center gap-1 text-[10px] font-bold text-outline cursor-pointer hover:text-primary transition-colors">
                                            <input type="checkbox" name="is_paid" value="1" {{ $enrollment->is_paid ? 'checked' : '' }} class="rounded text-primary focus:ring-primary border-outline-variant/30 w-3 h-3"> Paid
                                        </label>
                                        <button type="submit" class="bg-primary hover:bg-primary-dark text-white rounded text-[10px] px-2 py-1 font-bold transition-colors">Save</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-outline">কোন ডাটা পাওয়া যায়নি।</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-surface-container-high bg-white">
                {{ $enrollments->links() }}
            </div>
        </section>
    </main>
</div>
@endsection

@push('styles')
<style>
    /* Hide top nav for admin view if needed, or adjust padding */
    #topNav {
        background-color: white !important;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
</style>
@endpush
