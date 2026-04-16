@extends('layouts.app')

@section('content')
<!-- Hero Section: Capturing the Heart of Life Circle -->
<section class="relative min-h-[85vh] flex items-center overflow-hidden">
    <div class="container mx-auto px-8 lg:px-16 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center py-20 relative z-10">
        <div class="animate-[fadeInUp_1s_ease-out_forwards]">
            <div class="inline-flex items-center gap-2 px-3 md:px-4 py-1.5 rounded-full bg-secondary-container/30 text-secondary font-bold text-[10px] md:text-sm mb-4 md:mb-6">
                <span class="material-symbols-outlined text-xs md:text-sm">verified</span>
                Non-Medical Counselling Service
            </div>
            <h1 class="text-4xl md:text-7xl font-extrabold text-primary leading-[1.3] mb-6 tracking-tight font-manrope">
                LIFE CIRCLE
                <span class="block text-2xl md:text-4xl text-secondary font-medium mt-2">Center for Developmental Excellence</span>
            </h1>
            <p class="text-on-surface-variant text-lg leading-relaxed mb-8 max-w-xl animate-[fadeInUp_1.2s_ease-out_forwards]">
                With 15 years of experience in the Disability Sector and 10 years in the Counseling Sector, we provide a compassionate sanctuary for children and families. Our holistic approach focuses on nurturing the whole child through evidence-based developmental guidance.
            </p>
            <div class="flex flex-wrap gap-2 md:gap-4 mb-8 md:mb-12 animate-[fadeInUp_1.4s_ease-out_forwards]">
                <a href="{{ route('enroll') }}" class="btn-interact bg-primary text-on-primary px-4 md:px-8 py-2 md:py-4 rounded-full font-bold text-[11px] md:text-lg whisper-shadow hover:brightness-110 transition-all">Enroll <span class="hidden md:inline">Now</span> (সদস্য হোন)</a>
                <a href="{{ route('appointment') }}" class="btn-interact bg-secondary text-white px-4 md:px-8 py-2 md:py-4 rounded-full font-bold text-[11px] md:text-lg whisper-shadow hover:brightness-110 transition-all">Book <span class="hidden md:inline">Appointment</span> (সেশন বুকিং)</a>
            </div>
        </div>
        <div class="relative animate-[fadeInRight_1.2s_ease-out_forwards] flex justify-center">
            <div class="absolute -top-10 -right-10 w-96 h-96 bg-secondary-container/20 rounded-full blur-3xl animate-[float_6s_infinite_ease-in-out]"></div>
            <div class="relative w-full max-w-md bg-white p-4 rounded-[2.5rem] whisper-shadow transform rotate-2 hover:rotate-0 transition-transform duration-700">
                <div class="rounded-[2rem] overflow-hidden aspect-[4/5] bg-surface-container">
                    <img alt="Lead Counselor" class="w-full h-full object-cover" src="{{ asset('Sharmin Mujahid1.png') }}">
                </div>
            </div>
            <div class="absolute -bottom-4 -left-4 md:-bottom-6 md:-left-6 bg-primary p-4 md:p-6 rounded-2xl whisper-shadow max-w-[240px] md:max-w-xs text-white animate-[float_5s_infinite_ease-in-out_1s]">
                <div class="flex items-center gap-3 md:gap-4">
                    <span class="material-symbols-outlined text-secondary-container text-2xl md:text-4xl" style="font-variation-settings: 'FILL' 1;">eco</span>
                    <p class="text-[10px] md:text-sm font-medium leading-tight text-white/90">15 years in the Disability Sector and 10 years in the Counseling Sector.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section: Architecture for Specialized Care -->
<section class="py-32 bg-primary reveal" id="services">
    <div class="container mx-auto px-8 lg:px-16">
        <div class="text-center mb-20">
            <span class="text-secondary-container font-bold tracking-[0.2em] uppercase text-sm">Comprehensive Care</span>
            <h2 class="text-4xl md:text-5xl font-extrabold text-white mt-4 mb-6">Our Services</h2>
            <p class="text-secondary-container/70 max-w-2xl mx-auto text-lg">Providing a specialized spectrum of support for developmental, emotional, and behavioral well-being.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Dynamic Service Cards -->
            <div class="bg-white/5 border border-white/10 p-8 rounded-3xl hover:bg-white/10 transition-all group reveal">
                <span class="material-symbols-outlined text-secondary-container text-4xl mb-4">family_restroom</span>
                <h3 class="text-xl font-bold text-white mb-2">Parenting Guidance</h3>
                <p class="text-white/60 text-sm">Expert strategies to navigate the complexities of modern parenting and child development.</p>
            </div>
            <div class="bg-white/5 border border-white/10 p-8 rounded-3xl hover:bg-white/10 transition-all group reveal">
                <span class="material-symbols-outlined text-secondary-container text-4xl mb-4">accessibility_new</span>
                <h3 class="text-xl font-bold text-white mb-2">Disability Consultancy</h3>
                <p class="text-white/60 text-sm">Specialized advocacy and structural support for individuals with diverse abilities.</p>
            </div>
            <div class="bg-white/5 border border-white/10 p-8 rounded-3xl hover:bg-white/10 transition-all group reveal">
                <span class="material-symbols-outlined text-secondary-container text-4xl mb-4">fact_check</span>
                <h3 class="text-xl font-bold text-white mb-2">Developmental Assessment</h3>
                <p class="text-white/60 text-sm">Comprehensive evaluation and personalized growth roadmaps for each child.</p>
            </div>
            <div class="bg-white/5 border border-white/10 p-8 rounded-3xl hover:bg-white/10 transition-all group reveal">
                <span class="material-symbols-outlined text-secondary-container text-4xl mb-4">psychology_alt</span>
                <h3 class="text-xl font-bold text-white mb-2">Child & Adolescent Counselling</h3>
                <p class="text-white/60 text-sm">Tailored therapeutic support for the unique challenges of young minds.</p>
            </div>
            <div class="bg-white/5 border border-white/10 p-8 rounded-3xl hover:bg-white/10 transition-all group reveal">
                <span class="material-symbols-outlined text-secondary-container text-4xl mb-4">group</span>
                <h3 class="text-xl font-bold text-white mb-2">Relationship & Family</h3>
                <p class="text-white/60 text-sm">Strengthening family bonds through empathetic communication and mediation.</p>
            </div>
            <div class="bg-white/5 border border-white/10 p-8 rounded-3xl hover:bg-white/10 transition-all group reveal">
                <span class="material-symbols-outlined text-secondary-container text-4xl mb-4">school</span>
                <h3 class="text-xl font-bold text-white mb-2">Teachers & Parents Training</h3>
                <p class="text-white/60 text-sm">Workshops and sessions designed to empower the primary caregivers and educators.</p>
            </div>
        </div>
    </div>
</section>

<!-- About Section: The Human Behind the Care -->
<section class="py-32 bg-surface reveal" id="about">
    <div class="container mx-auto px-8 lg:px-16 grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
        <div class="relative group">
            <div class="rounded-[3rem] overflow-hidden aspect-square whisper-shadow relative z-10 border-[12px] border-white">
                <img alt="Sharmin Mujahid professional" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000" src="{{ asset('Sharmin Mujahid2.png') }}">
            </div>
            <div class="absolute -top-12 -left-12 w-64 h-64 bg-secondary-container/20 rounded-full -z-0"></div>
            <div class="absolute -bottom-6 -right-6 md:-bottom-10 md:-right-10 px-6 py-4 md:px-8 md:py-6 bg-white rounded-3xl whisper-shadow z-20">
                <div class="text-2xl md:text-4xl font-black text-primary">15+</div>
                <div class="text-[10px] md:text-sm font-bold text-secondary uppercase tracking-widest leading-none">Years Service</div>
            </div>
        </div>
        <div class="reveal">
            <span class="text-secondary font-bold tracking-widest uppercase text-sm">Our Mission & Values</span>
            <h2 class="text-4xl font-extrabold mb-8 mt-4 text-primary">Nurturing the Whole Child</h2>
            <div class="space-y-6 text-on-surface-variant leading-relaxed text-lg font-bengali">
                <p>লাইফ সার্কেল-এ আমরা বিশ্বাস করি যে প্রতিটি মানুষের মধ্যে একটি অনন্য আলো রয়েছে। আমাদের লক্ষ্য হলো কাউন্সেলিং দক্ষতা এবং সহানুভূতির মিশ্রণে পরিবারগুলোকে উন্নয়নের পথে বাধাগুলো চিহ্নিত করতে এবং কাটিয়ে উঠতে সাহায্য করা।</p>
                <p>আমাদের প্রতিষ্ঠাতা শারমিন মুজাহিদ-এর নেতৃত্বে আমরা নন-মেডিকেল কাউন্সেলিং সেবা প্রদান করি যেখানে কাঠামোগত পরিবর্তন, আচরণগত কৌশল এবং মানসিক স্থিতিস্থাপকতার ওপর গুরুত্ব দেওয়া হয়।</p>
            </div>
            <div class="mt-10 p-8 bg-surface-container-low rounded-3xl border-l-8 border-secondary italic whisper-shadow text-primary font-medium">
                "We don't just treat symptoms; we nurture the whole child and support the whole family to create lasting, generational change."
            </div>
        </div>
    </div>
</section>

<!-- Call to Action: Start the Journey -->
<section class="py-24 bg-surface-container reveal" id="contact">
    <div class="container mx-auto px-8 lg:px-16">
        <div class="bg-primary rounded-[3rem] overflow-hidden relative p-12 lg:p-20 text-center lg:text-left">
            <div class="relative z-10 flex flex-col lg:flex-row justify-between items-center gap-12">
                <div class="text-white max-w-xl">
                    <h2 class="text-4xl font-extrabold mb-4">Start Your Healing Journey Today</h2>
                    <p class="text-white/70 text-lg mb-8">Reach out to schedule your developmental assessment or family counselling session.</p>
                    <div class="flex flex-col gap-6">
                        <div class="flex items-center gap-4 justify-center lg:justify-start">
                            <div class="w-12 h-12 rounded-full bg-secondary flex items-center justify-center">
                                <span class="material-symbols-outlined">call</span>
                            </div>
                            <div>
                                <div class="text-white/60 text-sm font-bold uppercase tracking-widest">Appointment Line</div>
                                <a class="text-2xl font-bold" href="tel:+8801716437859">+880 1716 437859</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('enroll') }}" class="bg-white text-primary font-bold py-5 px-10 rounded-full text-xl hover:bg-secondary-container hover:text-primary transition-all whisper-shadow">
                        Enroll Now
                    </a>
                    <a href="{{ route('appointment') }}" class="bg-secondary text-white font-bold py-5 px-10 rounded-full text-xl hover:brightness-110 transition-all whisper-shadow">
                        Book Appointment
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    @keyframes fadeInRight {
        from { opacity: 0; transform: translateX(30px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }
</style>
@endpush
