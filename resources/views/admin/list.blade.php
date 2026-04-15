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
            <a class="flex items-center gap-3 bg-primary/5 text-primary rounded-lg mx-2 px-4 py-3 border-r-4 border-primary" href="#">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="font-bold">Dashboard</span>
            </a>
            <a class="flex items-center gap-3 text-outline px-4 py-3 mx-2 hover:bg-surface-container-low transition-all" href="#">
                <span class="material-symbols-outlined">group</span>
                <span>Enrollments</span>
            </a>
        </div>
        <div class="px-4 mt-auto">
            <div class="flex items-center gap-3 px-2 py-4 border-t border-outline-variant/10">
                <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center text-primary font-bold">A</div>
                <div>
                    <p class="text-xs font-bold">Admin User</p>
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
                <p class="text-on-surface-variant mt-1">রিয়েল-টাইম ডাটাবেস মনিটর করুন।</p>
            </div>
            <div class="bg-white px-4 py-2 rounded-lg shadow-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">calendar_today</span>
                <span class="text-xs font-bold">{{ date('M d, Y') }}</span>
            </div>
        </header>

        <!-- Stats Grid -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-xl whisper-shadow border border-outline-variant/10">
                <p class="text-outline text-sm font-medium">মোট সদস্য (Total)</p>
                <h3 class="text-4xl font-bold mt-1 text-primary">{{ $enrollments->count() ?? 0 }}</h3>
            </div>
            <div class="bg-white p-6 rounded-xl whisper-shadow border border-outline-variant/10">
                <p class="text-outline text-sm font-medium">পেন্ডিং পেমেন্ট (Pending)</p>
                <h3 class="text-4xl font-bold mt-1 text-secondary">0</h3>
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
                                <a href="https://wa.me/{{ preg_replace('/\D/', '', $enrollment->whatsapp) }}" target="_blank" class="flex items-center gap-2 px-3 py-1.5 bg-emerald-600 text-white rounded-lg text-xs font-bold">
                                    <span class="material-symbols-outlined text-sm">chat</span>
                                    WhatsApp
                                </a>
                            </td>
                            <td class="px-6 py-5">
                                <span class="text-xs font-bold text-primary capitalize">{{ $enrollment->status }}</span>
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
