<!-- Humanized Navigation: Clear, Emotional, and Professional -->
<nav class="fixed top-0 w-full z-50 transition-all duration-500 organic-easing h-20 md:h-24 flex justify-between items-center px-4 md:px-8 lg:px-16 max-w-full" id="topNav">
    <div class="flex items-center gap-2 md:gap-3">
        <img alt="Life Circle Logo" class="h-8 w-8 md:h-12 md:w-12 object-contain" src="https://lh3.googleusercontent.com/aida/ADBb0ujwCsowv4h4kuMrzOQjnJdTHOaSFmBI-sUnyxT00fWnSF2rpqr3K4KBzzonJ0SZTDEL3sQ0XDruZxBGFK9r_uZIL5M9-oYHWAzCRO_0UQSJi4SPeHwaAtbs2KmuT6P9ocuklLj1gsbQit2T-8jsOyhIXVRLzFO_qcyU2QlGAhxMo-S5KIRCCFxIZu4uO4XfuZ1d2Az5ZTI8Tf0qxylYsQn-56V37iKH5P4RY_mMIIKUh6MgRLh7-KkBFyyRCfV3NouHrBBrhk3jDQ">
        <div class="flex flex-col">
            <span class="text-lg md:text-xl font-extrabold text-primary font-manrope leading-tight uppercase tracking-tight">Life Circle</span>
            <span class="text-[8px] md:text-[10px] text-secondary font-bold tracking-tighter uppercase">Counseling Services</span>
        </div>
    </div>
    <div class="hidden md:flex items-center gap-10 font-manrope font-bold tracking-tight">
        <a class="text-on-surface-variant hover:text-primary transition-colors" href="{{ route('home') }}#about">About</a>
        <a class="text-on-surface-variant hover:text-primary transition-colors" href="{{ route('home') }}#services">Services</a>
        <a class="text-on-surface-variant hover:text-primary transition-colors" href="{{ route('home') }}#contact">Contact</a>
    </div>
    <a href="{{ route('enroll') }}" class="btn-interact bg-primary text-on-primary px-4 md:px-6 py-2 md:py-2.5 rounded-full font-manrope font-bold hover:brightness-110 shadow-lg text-xs md:text-base whitespace-nowrap">
        Book Appointment
    </a>
</nav>

<style>
    nav.scrolled {
        height: 4.5rem;
        background-color: rgba(253, 250, 245, 0.9);
        backdrop-filter: blur(12px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    }
    .btn-interact {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .btn-interact:active {
        transform: scale(0.95);
    }
</style>

<script>
    const topNav = document.getElementById('topNav');
    const handleNavScroll = () => {
        if (window.scrollY > 80) {
            topNav.classList.add('scrolled');
        } else {
            topNav.classList.remove('scrolled');
        }
    };
    window.addEventListener('scroll', handleNavScroll);
    window.addEventListener('load', handleNavScroll);
</script>
