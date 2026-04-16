@extends('layouts.app')

@php
    $title = 'Clients Directory | Admin | Life Circle';
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
            <a class="flex items-center gap-3 bg-primary/5 text-primary rounded-lg mx-2 px-4 py-3 border-r-4 border-primary" href="{{ route('admin.clients') }}">
                <span class="material-symbols-outlined">contacts</span>
                <span class="font-bold">Clients Directory</span>
            </a>
            <a class="flex items-center gap-3 text-outline hover:bg-surface-container-low px-4 py-3 mx-2 rounded-lg transition-all" href="{{ route('admin.reports') }}">
                <span class="material-symbols-outlined">analytics</span>
                <span>Reports & Accounts</span>
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
                <h2 class="text-3xl font-extrabold text-primary tracking-tight">ক্লায়েন্ট ডিরেক্টরি (Clients)</h2>
                <p class="text-on-surface-variant mt-1">ট্র্যাক করুন আপনার ক্লায়েন্টদের সেশন হিস্ট্রি।</p>
            </div>
            <div class="bg-white px-4 py-2 rounded-lg shadow-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">groups</span>
                <span class="text-xs font-bold">Total: {{ count($clients) }} Clients</span>
            </div>
        </header>

        <!-- Table Section -->
        <section class="bg-white rounded-xl whisper-shadow overflow-hidden">
            <div class="p-6 border-b border-surface-container-high flex justify-between items-center">
                <h3 class="text-xl font-bold">সকল ক্লায়েন্ট (All Clients)</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-surface-container-low/50">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-outline">নাম ও ইমেইল</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-outline">হোয়াটসঅ্যাপ</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-outline">মোট বুকিং</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-outline text-emerald-600">সম্পন্ন সেশন (Completed)</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-outline">সর্বশেষ সেশন</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container-low">
                        @forelse($clients as $client)
                        <tr class="hover:bg-surface-container-low/30 transition-colors">
                            <td class="px-6 py-5">
                                <p class="font-bold text-sm">{{ $client->full_name }}</p>
                                <p class="text-xs text-outline">{{ $client->email }}</p>
                            </td>
                            <td class="px-6 py-5">
                                <a href="https://wa.me/{{ preg_replace('/\D/', '', $client->whatsapp_number) }}" target="_blank" class="flex items-center gap-2 bg-emerald-50 text-emerald-700 px-3 py-1.5 rounded-lg w-max hover:bg-emerald-100 transition">
                                    <span class="material-symbols-outlined text-sm">chat</span> {{ $client->whatsapp_number }}
                                </a>
                            </td>
                            <td class="px-6 py-5">
                                <span class="bg-surface-container-high px-3 py-1 rounded-full text-xs font-bold text-secondary-dark">
                                    {{ $client->total_appointments }} 
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <span class="bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full text-xs font-black">
                                    {{ $client->completed_sessions }} সেশন
                                </span>
                            </td>
                            <td class="px-6 py-5 text-sm font-semibold text-outline">
                                {{ \Carbon\Carbon::parse($client->last_appointment)->format('M d, Y') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-outline">কোন ক্লায়েন্ট ডাটা পাওয়া যায়নি।</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>
@endsection

@push('styles')
<style>
    #topNav { background-color: white !important; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
</style>
@endpush
