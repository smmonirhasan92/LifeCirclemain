@extends('layouts.app')

@section('content')
<main class="flex-grow pt-32 pb-20 px-6">
    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
        <!-- Left Side -->
        <div class="lg:col-span-5 flex flex-col gap-8">
            <div class="inline-flex px-4 py-1.5 bg-primary-container text-primary rounded-full text-sm font-semibold tracking-wide w-fit animate-fade-in-up">
                ধাপ: অ্যাপয়েন্টমেন্ট বুকিং
            </div>
            <h1 class="text-5xl md:text-6xl font-extrabold text-on-surface leading-[1.3] -tracking-[0.02em] animate-fade-in-up font-bengali">
                একজন বিশেষজ্ঞের সাথে <span class="text-secondary italic">সেশন</span> বুক করুন।
            </h1>
            <p class="text-on-surface-variant leading-relaxed max-w-md animate-fade-in-up font-bengali">
                আপনার সুবিধাজনক সময় এবং সেবার ধরণ অনুযায়ী অ্যাপয়েন্টমেন্ট বুক করুন। আমরা আপনার তথ্যাবলি নিরাপদ রাখবো।
            </p>

            <!-- Payment Instructions Card -->
            <div class="bg-white p-6 rounded-2xl whisper-shadow border-l-4 border-secondary animate-fade-in-up">
                <h4 class="font-bold text-secondary mb-3 flex items-center gap-2">
                    <span class="material-symbols-outlined">payments</span> পেমেন্ট নির্দেশিকা
                </h4>
                <div class="space-y-3 text-sm text-on-surface-variant">
                    <p>অ্যাপয়েন্টমেন্ট নিশ্চিত করতে নিচের নম্বরে ফি পাঠিয়ে ট্রানজেকশন আইডি প্রদান করুন:</p>
                    <div class="flex flex-col gap-2">
                        <div class="flex justify-between items-center bg-surface-container-low p-3 rounded-lg">
                            <span class="font-bold">বিকাশ (Personal):</span>
                            <span class="text-primary font-manrope">01716437859</span>
                        </div>
                    </div>
                    <p class="text-xs italic">*ফি প্রদানের পর ট্রানজেকশন আইডিটি ফর্মে লিখুন।</p>
                </div>
            </div>
        </div>

        <!-- Right Side: Booking Form -->
        <div class="lg:col-span-7 bg-white rounded-xl p-8 md:p-12 shadow-[0_20px_40px_rgba(47,52,46,0.06)] overflow-hidden">
            <form action="{{ route('appointment.store') }}" method="POST" class="space-y-8" id="appointmentForm">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="field-container flex flex-col gap-2 form-field-group">
                        <label class="text-xs font-bold uppercase tracking-widest text-outline ml-1">পূর্ণ নাম (Full Name)</label>
                        <input name="full_name" value="{{ old('full_name') }}" class="bg-surface-container-high border-none rounded-sm px-4 py-3 focus:ring-0 focus:bg-white focus:border-b-2 focus:border-primary transition-all input-focus-effect @error('full_name') border-red-500 @enderror" placeholder="আব্দুল্লাহ আল মামুন" type="text" required>
                        @error('full_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="field-container flex flex-col gap-2 form-field-group">
                        <label class="text-xs font-bold uppercase tracking-widest text-outline ml-1">ইমেইল (Email)</label>
                        <input name="email" value="{{ old('email') }}" class="bg-surface-container-high border-none rounded-sm px-4 py-3 focus:ring-0 focus:bg-white focus:border-b-2 focus:border-primary transition-all input-focus-effect @error('email') border-red-500 @enderror" placeholder="example@mail.com" type="email" required>
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="field-container flex flex-col gap-2 form-field-group">
                        <label class="text-xs font-bold uppercase tracking-widest text-outline ml-1">হোয়াটসঅ্যাপ নম্বর</label>
                        <input name="whatsapp" value="{{ old('whatsapp') }}" class="w-full bg-surface-container-high border-none rounded-sm px-4 py-3 focus:ring-0 focus:bg-white focus:border-b-2 focus:border-primary transition-all input-focus-effect @error('whatsapp') border-red-500 @enderror" placeholder="017XXXXXXXX" type="tel" required>
                        @error('whatsapp') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="field-container flex flex-col gap-2 form-field-group">
                        <label class="text-xs font-bold uppercase tracking-widest text-outline ml-1">সেবার ধরণ (Service)</label>
                        <select name="service_type" class="bg-surface-container-high border-none rounded-sm px-4 py-3 focus:ring-0 focus:bg-white focus:border-b-2 focus:border-primary transition-all appearance-none input-focus-effect @error('service_type') border-red-500 @enderror" required>
                            <option value="">নির্বাচন করুন</option>
                            <option value="Parenting Guidance" {{ old('service_type') == 'Parenting Guidance' ? 'selected' : '' }}>Parenting Guidance</option>
                            <option value="Developmental Assessment" {{ old('service_type') == 'Developmental Assessment' ? 'selected' : '' }}>Developmental Assessment</option>
                            <option value="Relationship & Family" {{ old('service_type') == 'Relationship & Family' ? 'selected' : '' }}>Relationship & Family</option>
                        </select>
                        @error('service_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="field-container flex flex-col gap-2 form-field-group">
                        <label class="text-xs font-bold uppercase tracking-widest text-outline ml-1">অ্যাপয়েন্টমেন্ট তারিখ</label>
                        <input name="appointment_date" value="{{ old('appointment_date') }}" class="bg-surface-container-high border-none rounded-sm px-4 py-3 focus:ring-0 focus:bg-white focus:border-b-2 focus:border-primary transition-all input-focus-effect @error('appointment_date') border-red-500 @enderror" type="date" required>
                        @error('appointment_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="field-container flex flex-col gap-2 form-field-group">
                        <label class="text-xs font-bold uppercase tracking-widest text-outline ml-1">পছন্দনীয় সময় (ঐচ্ছিক)</label>
                        <input name="appointment_time" value="{{ old('appointment_time') }}" class="bg-surface-container-high border-none rounded-sm px-4 py-3 focus:ring-0 focus:bg-white focus:border-b-2 focus:border-primary transition-all input-focus-effect" placeholder="যেমন: বিকেল ৪টা" type="text">
                    </div>
                </div>

                <div class="field-container flex flex-col gap-2 form-field-group">
                    <label class="text-xs font-bold uppercase tracking-widest text-outline ml-1">ট্রানজেকশন আইডি</label>
                    <input name="transaction_id" value="{{ old('transaction_id') }}" class="bg-surface-container-high border-none rounded-sm px-4 py-3 focus:ring-0 focus:bg-white focus:border-b-2 focus:border-primary transition-all input-focus-effect @error('transaction_id') border-red-500 @enderror" placeholder="TRN123456" type="text" required>
                    @error('transaction_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="field-container flex flex-col gap-2 form-field-group">
                    <label class="text-xs font-bold uppercase tracking-widest text-outline ml-1">অতিরিক্ত বার্তা (ঐচ্ছিক)</label>
                    <textarea name="message" class="bg-surface-container-high border-none rounded-sm px-4 py-3 focus:ring-0 focus:bg-white focus:border-b-2 focus:border-primary transition-all input-focus-effect" rows="3">{{ old('message') }}</textarea>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-secondary text-white py-3 md:py-4 px-6 md:px-8 rounded-full text-base md:text-lg font-bold shadow-lg shadow-secondary/20 hover:-translate-y-1 transition-all duration-300">
                        সেশন বুক করুন 🗓️
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

@push('styles')
<style>
    .form-field-group { opacity: 0; animation: fadeInUp 0.6s ease-out forwards; }
    .input-focus-effect:focus { background-color: white; box-shadow: 0 4px 12px rgba(64, 104, 67, 0.08); transform: translateY(-2px); }
</style>
@endpush
