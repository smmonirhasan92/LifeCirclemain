@extends('layouts.app')

@section('content')
<main class="flex-grow pt-32 pb-20 px-6">
    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
        <!-- Left Side: Humanized Editorial Content -->
        <div class="lg:col-span-5 flex flex-col gap-8">
            <div class="inline-flex px-4 py-1.5 bg-secondary-container text-secondary rounded-full text-sm font-semibold tracking-wide w-fit animate-fade-in-up">
                ধাপ: শুরু করুন আপনার যাত্রা
            </div>
            <h1 class="text-5xl md:text-6xl font-extrabold text-on-surface leading-[1.1] -tracking-[0.02em] animate-fade-in-up">
                আপনার পরিবারের জন্য <span class="text-primary italic">সঠিক</span> পথ খুঁজে নিন।
            </h1>
            <p class="text-on-surface-variant leading-relaxed max-w-md animate-fade-in-up">
                শারমিন মুজাহিদ ম্যামের সাথে আপনার সেশনের জন্য নিচের ফর্মটি পূরণ করুন। আমরা আপনার তথ্যগুলো গুরুত্বের সাথে বিশ্লেষণ করব।
            </p>

            <!-- Payment Instructions Card -->
            <div class="bg-white p-6 rounded-2xl whisper-shadow border-l-4 border-primary animate-fade-in-up">
                <h4 class="font-bold text-primary mb-3 flex items-center gap-2">
                    <span class="material-symbols-outlined">payments</span> পেমেন্ট নির্দেশিকা
                </h4>
                <div class="space-y-3 text-sm text-on-surface-variant">
                    <p>সেশন বুকিং নিশ্চিত করতে নিচের নম্বরে টাকা পাঠিয়ে ট্রানজেকশন আইডি প্রদান করুন:</p>
                    <div class="flex flex-col gap-2">
                        <div class="flex justify-between items-center bg-surface-container-low p-3 rounded-lg">
                            <span class="font-bold">বিকাশ (Personal):</span>
                            <span class="text-primary font-manrope">01716437859</span>
                        </div>
                        <div class="flex justify-between items-center bg-surface-container-low p-3 rounded-lg">
                            <span class="font-bold">নগদ (Personal):</span>
                            <span class="text-primary font-manrope">01716437859</span>
                        </div>
                    </div>
                    <p class="text-xs italic">*পেমেন্ট করার পর ট্রানজেকশন আইডিটি ফর্মে লিখুন।</p>
                </div>
            </div>

            <div class="space-y-6 mt-4">
                <div class="flex items-center gap-4 group animate-fade-in-up">
                    <div class="w-12 h-12 rounded-full bg-primary-container flex items-center justify-center text-primary group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined">chat</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-on-surface">হোয়াটসঅ্যাপ ইন্টিগ্রেশন</h4>
                        <p class="text-sm text-outline">সরাসরি ম্যামের সাথে যোগাযোগ করুন।</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Enrollment Form -->
        <div class="lg:col-span-7 bg-white rounded-xl p-8 md:p-12 shadow-[0_20px_40px_rgba(47,52,46,0.06)] overflow-hidden">
            <form action="{{ route('enroll.store') }}" method="POST" class="space-y-8" id="enrollmentForm">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="field-container flex flex-col gap-2 form-field-group">
                        <label class="text-xs font-bold uppercase tracking-widest text-outline ml-1">পূর্ণ নাম (Full Name)</label>
                        <input name="full_name" class="bg-surface-container-high border-none rounded-sm px-4 py-3 focus:ring-0 focus:bg-white focus:border-b-2 focus:border-primary transition-all input-focus-effect" placeholder="যেমন: আব্দুল্লাহ আল মামুন" type="text" required>
                    </div>
                    <div class="field-container flex flex-col gap-2 form-field-group">
                        <label class="text-xs font-bold uppercase tracking-widest text-outline ml-1">ইমেইল (Email Address)</label>
                        <input name="email" class="bg-surface-container-high border-none rounded-sm px-4 py-3 focus:ring-0 focus:bg-white focus:border-b-2 focus:border-primary transition-all input-focus-effect" placeholder="example@mail.com" type="email" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="field-container flex flex-col gap-2 form-field-group">
                        <label class="text-xs font-bold uppercase tracking-widest text-outline ml-1">হোয়াটসঅ্যাপ নম্বর</label>
                        <div class="relative">
                            <input name="whatsapp" class="w-full bg-surface-container-high border-none rounded-sm pl-12 pr-4 py-3 focus:ring-0 focus:bg-white focus:border-b-2 focus:border-primary transition-all input-focus-effect" placeholder="017XXXXXXXX" type="tel" required>
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-primary">
                                <span class="material-symbols-outlined text-lg">call</span>
                            </div>
                        </div>
                    </div>
                    <div class="field-container flex flex-col gap-2 form-field-group">
                        <label class="text-xs font-bold uppercase tracking-widest text-outline ml-1">সেবার ধরণ (Service Type)</label>
                        <select name="service_type" class="bg-surface-container-high border-none rounded-sm px-4 py-3 focus:ring-0 focus:bg-white focus:border-b-2 focus:border-primary transition-all appearance-none input-focus-effect" required>
                            <option value="">নির্বাচন করুন</option>
                            <option>Pediatric Consultation</option>
                            <option>Growth Milestones</option>
                            <option>Parental Coaching</option>
                            <option>Nutrition Advocacy</option>
                        </select>
                    </div>
                </div>

                <!-- Transaction ID Field (Requested Upgrade) -->
                <div class="field-container flex flex-col gap-2 form-field-group">
                    <label class="text-xs font-bold uppercase tracking-widest text-outline ml-1">ট্রানজেকশন আইডি (bKash/Nagad Transaction ID)</label>
                    <input name="transaction_id" class="bg-surface-container-high border-none rounded-sm px-4 py-3 focus:ring-0 focus:bg-white focus:border-b-2 focus:border-primary transition-all input-focus-effect" placeholder="যেমন: TRN918237" type="text" required>
                </div>

                <div class="field-container flex flex-col gap-2 form-field-group">
                    <label class="text-xs font-bold uppercase tracking-widest text-outline ml-1">অতিরিক্ত বার্তা (ঐচ্ছিক)</label>
                    <textarea name="message" class="bg-surface-container-high border-none rounded-sm px-4 py-3 focus:ring-0 focus:bg-white focus:border-b-2 focus:border-primary transition-all input-focus-effect" placeholder="আপনার সমস্যা বা লক্ষ্য সম্পর্কে কিছু বলুন..." rows="4"></textarea>
                </div>

                <div class="flex items-start gap-3 py-2 form-field-group">
                    <div class="flex items-center h-5">
                        <input name="disclaimer" id="disclaimer" class="w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary/20 bg-surface-container-high cursor-pointer transition-transform hover:scale-110" type="checkbox" required>
                    </div>
                    <label class="text-sm text-on-surface-variant leading-tight cursor-pointer" for="disclaimer">
                        আমি বুঝতে পারছি এটি সরাসরি চিকিৎসা নয়। লাইফ সার্কেল একটি সাহায্যকারী উন্নয়নমূলক নির্দেশনা প্রদান করে।
                    </label>
                </div>

                <div class="pt-4 flex flex-col gap-6 form-field-group">
                    <button type="submit" class="group relative bg-primary text-on-primary py-4 px-8 rounded-full text-lg font-bold shadow-lg shadow-primary/20 hover:shadow-primary/40 hover:-translate-y-1 active:scale-95 transition-all duration-300 flex items-center justify-center gap-3 overflow-hidden" id="submitBtn">
                        <span class="relative z-10">আপনার সেশন বুক করুন 🚀</span>
                        <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </button>
                    <div class="flex items-center justify-center gap-4 text-sm text-outline">
                        <div class="h-[1px] flex-grow bg-outline-variant/20"></div>
                        <span class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                            সুরক্ষিত ও গোপনীয়
                        </span>
                        <div class="h-[1px] flex-grow bg-outline-variant/20"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

@push('styles')
<style>
    .form-field-group {
        opacity: 0;
        animation: fadeInUp 0.6s ease-out forwards;
    }
    .input-focus-effect:focus {
        background-color: white;
        box-shadow: 0 4px 12px rgba(64, 104, 67, 0.08);
        transform: translateY(-2px);
    }
</style>
@endpush
