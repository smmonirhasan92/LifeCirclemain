@extends('layouts.app')

@php
    $title = 'Reports & Accounts | Admin | Life Circle';
@endphp

@section('content')
<div class="flex min-h-screen bg-surface pt-20">
    <!-- SideNavBar -->
    <nav class="w-64 bg-white border-r border-outline-variant/10 flex flex-col py-8 fixed h-full">
        <div class="px-6 mb-10">
            <h1 class="text-lg font-bold text-primary">Admin Portal</h1>
            <p class="text-xs text-outline font-normal">Management View</p>
        </div>
        <div class="flex-1 space-y-1">
            <a class="flex items-center gap-3 text-outline hover:bg-surface-container-low px-4 py-3 mx-2 rounded-lg transition-all" href="{{ route('admin.list') }}">
                <span class="material-symbols-outlined">group</span>
                <span>Enrollments</span>
            </a>
            <a class="flex items-center gap-3 text-outline hover:bg-surface-container-low px-4 py-3 mx-2 rounded-lg transition-all" href="{{ route('admin.appointments') }}">
                <span class="material-symbols-outlined">calendar_month</span>
                <span>Appointments</span>
            </a>
            <a class="flex items-center gap-3 text-outline hover:bg-surface-container-low px-4 py-3 mx-2 rounded-lg transition-all" href="{{ route('admin.clients') }}">
                <span class="material-symbols-outlined">contacts</span>
                <span>Clients Directory</span>
            </a>
            <a class="flex items-center gap-3 bg-primary/5 text-primary rounded-lg mx-2 px-4 py-3 border-r-4 border-primary" href="{{ route('admin.reports') }}">
                <span class="material-symbols-outlined">analytics</span>
                <span class="font-bold">Reports & Accounts</span>
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

    <!-- Main Content Canvas -->
    <main class="ml-64 flex-1 p-10">
        <header class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl font-extrabold text-primary tracking-tight">অ্যাকাউন্টস এবং রিপোর্ট (Accounts & Reports)</h2>
                <p class="text-on-surface-variant mt-1">আর্থিক হিসাব এবং প্রজেক্টের সম্পূর্ণ অ্যানালিটিক্স।</p>
            </div>
            <div class="bg-white px-4 py-2 rounded-lg shadow-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">calendar_month</span>
                <span class="text-xs font-bold">This Month: {{ date('F Y') }}</span>
            </div>
        </header>

        <!-- KPI Metric Cards Grid -->
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <!-- Revenue Card -->
            <div class="bg-gradient-to-br from-primary to-primary-dark p-6 rounded-2xl shadow-lg relative overflow-hidden text-white">
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-white/70 text-xs font-bold uppercase tracking-wider">মোট আয় (Total Earnings)</p>
                            <h3 class="text-4xl font-black mt-2 font-manrope whitespace-nowrap">৳ {{ number_format($totalRevenue, 2) }}</h3>
                        </div>
                        <div class="bg-white/20 p-2 rounded-lg backdrop-blur-sm">
                            <span class="material-symbols-outlined">payments</span>
                        </div>
                    </div>
                    <p class="text-xs text-white/80">+{{ $recentPayments->count() }} recent transactions</p>
                </div>
                <!-- Decoration -->
                <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-white opacity-5 rounded-full blur-2xl"></div>
            </div>

            <!-- Total Sessions -->
            <div class="bg-white p-6 rounded-2xl whisper-shadow border border-outline-variant/10">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-outline text-xs font-bold uppercase tracking-wider">সম্পন্ন সেশন</p>
                        <h3 class="text-3xl font-black mt-2 text-gray-800">{{ $totalSessions }}</h3>
                    </div>
                    <div class="bg-blue-50 text-blue-600 p-2 rounded-lg">
                        <span class="material-symbols-outlined">psychology</span>
                    </div>
                </div>
                <p class="text-xs text-outline">সফলভাবে সম্পন্ন হওয়া সেশন</p>
            </div>

            <!-- Total Enrollments -->
            <div class="bg-white p-6 rounded-2xl whisper-shadow border border-outline-variant/10">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-outline text-xs font-bold uppercase tracking-wider">সদস্যভুক্তি</p>
                        <h3 class="text-3xl font-black mt-2 text-gray-800">{{ $totalEnrollments }}</h3>
                    </div>
                    <div class="bg-emerald-50 text-emerald-600 p-2 rounded-lg">
                        <span class="material-symbols-outlined">assignment_ind</span>
                    </div>
                </div>
                <p class="text-xs text-outline">সর্বমোট এনরোলমেন্ট রিকোয়েস্ট</p>
            </div>

            <!-- Active Clients -->
            <div class="bg-white p-6 rounded-2xl whisper-shadow border border-outline-variant/10">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-outline text-xs font-bold uppercase tracking-wider">অ্যাক্টিভ ক্লায়েন্ট</p>
                        <h3 class="text-3xl font-black mt-2 text-gray-800">{{ $activeClients }}</h3>
                    </div>
                    <div class="bg-purple-50 text-purple-600 p-2 rounded-lg">
                        <span class="material-symbols-outlined">diversity_1</span>
                    </div>
                </div>
                <p class="text-xs text-outline">ইউনিক ক্লায়েন্টদের সংখ্যা</p>
            </div>
        </section>

        <!-- Main Dashboard Split Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <!-- Recent Transactions Ledger -->
                <section class="bg-white rounded-xl whisper-shadow overflow-hidden h-full">
                    <div class="p-6 border-b border-surface-container-high flex justify-between items-center bg-gray-50/50">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <span class="material-symbols-outlined text-emerald-600">receipt_long</span> 
                            সাম্প্রতিক পেমেন্ট হিস্ট্রি
                        </h3>
                    </div>
                    <div class="p-0">
                        @if($recentPayments->count() > 0)
                            <table class="w-full text-left border-collapse">
                                <thead class="bg-surface-container-low/50">
                                    <tr>
                                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-outline">Date</th>
                                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-outline">Client</th>
                                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-outline">Transaction ID</th>
                                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-outline text-right">Amount</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-surface-container-low">
                                    @foreach($recentPayments as $payment)
                                    <tr class="hover:bg-surface-container-low/30 transition-colors">
                                        <td class="px-6 py-4 text-sm font-semibold text-outline">
                                            {{ \Carbon\Carbon::parse($payment->updated_at)->format('d M, h:i A') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="font-bold text-sm">{{ $payment->full_name }}</p>
                                        </td>
                                        <td class="px-6 py-4 font-mono text-xs text-primary bg-primary/5 rounded px-2 w-max inline-block mt-2">
                                            {{ $payment->transaction_id ?? 'CASH/DIRECT' }}
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <span class="font-black text-emerald-600">৳ {{ number_format($payment->payment_amount, 2) }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="p-12 flex flex-col items-center justify-center text-center">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 mb-4">
                                    <span class="material-symbols-outlined text-3xl">account_balance_wallet</span>
                                </div>
                                <h4 class="text-lg font-bold text-gray-700">No Payments Recorded Yet</h4>
                                <p class="text-sm text-gray-500 mt-2 max-w-sm">Mark an appointment as 'paid' and enter an amount to see it reflected here.</p>
                            </div>
                        @endif
                    </div>
                </section>
            </div>

            <div class="lg:col-span-1 space-y-8">
                <!-- Quick Info Box -->
                <div class="bg-primary/5 border border-primary/20 rounded-2xl p-6">
                    <h4 class="font-bold text-primary mb-2 flex items-center gap-2">
                        <span class="material-symbols-outlined">lightbulb</span> How Accounts Work
                    </h4>
                    <p class="text-sm text-secondary-dark/80 leading-relaxed">
                        The Total Earnings are automatically calculated based on the `payment_amount` field in the database where `is_paid` is true. You can export these reports through phpMyAdmin or directly view the real-time summary here.
                    </p>
                    <a href="{{ route('admin.appointments') }}" class="mt-4 inline-flex items-center justify-center w-full px-4 py-2 bg-primary text-white rounded-lg text-sm font-bold shadow-sm hover:bg-primary-dark transition-all">
                        Go to Appointments to mark Payments
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@push('styles')
<style>
    #topNav { background-color: white !important; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
</style>
@endpush
