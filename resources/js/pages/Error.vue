<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    status: Number,
});

// STATE
const isLoaded = ref(false);
const retryCountdown = ref(0);
let countdownInterval = null;

// LOGIKA UTAMA
const errorConfig = computed(() => {
    const map = {
        404: {
            code: '404',
            label: 'Halaman Hilang',
            desc: 'Jalur yang Anda tuju tidak ditemukan dalam peta sistem kami.',
            action: 'home',
            btnText: 'Kembali ke Markas',
            icon: 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'
        },
        403: {
            code: '403',
            label: 'Akses Ditolak',
            desc: 'Area terbatas. Izin keamanan diperlukan untuk melangkah lebih jauh.',
            action: 'home',
            btnText: 'Mundur Teratur',
            icon: 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z'
        },
        500: {
            code: '500',
            label: 'Gangguan Server',
            desc: 'Mesin utama mengalami kendala teknis. Tim IT sedang melakukan diagnosa.',
            action: 'reload',
            btnText: 'Muat Ulang Sistem',
            icon: 'M13 10V3L4 14h7v7l9-11h-7z'
        },
        503: {
            code: '503',
            label: 'Sedang Perbaikan',
            desc: 'Sistem sedang menjalani perawatan rutin untuk performa lebih baik.',
            action: 'reload',
            btnText: 'Cek Status Lagi',
            icon: 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'
        }
    };
    
    return map[props.status] || {
        code: props.status,
        label: 'Error Tidak Dikenal',
        desc: 'Terjadi anomali tak terduga. Silakan kembali.',
        action: 'home',
        btnText: 'Restart Navigasi',
        icon: 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'
    };
});

// LIFECYCLE
onMounted(() => {
    setTimeout(() => isLoaded.value = true, 100);
    
    // Auto Retry Logic untuk Error Server
    if (['reload'].includes(errorConfig.value.action)) {
        retryCountdown.value = 15;
        countdownInterval = setInterval(() => {
            retryCountdown.value--;
            if (retryCountdown.value <= 0) reloadPage();
        }, 1000);
    }
});

onUnmounted(() => clearInterval(countdownInterval));

const reloadPage = () => window.location.reload();
</script>

<template>
    <Head :title="`${errorConfig.code} - ${errorConfig.label}`" />

    <div class="relative h-screen w-screen overflow-hidden bg-slate-50 flex items-center justify-center font-sans text-slate-800 selection:bg-emerald-500 selection:text-white">
        
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute inset-0 opacity-[0.03]" style="background-image: linear-gradient(#059669 1px, transparent 1px), linear-gradient(90deg, #059669 1px, transparent 1px); background-size: 40px 40px;"></div>
            
            <div class="absolute -top-[20%] -right-[10%] w-[60vh] h-[60vh] bg-emerald-100/40 rounded-full blur-[80px]"></div>
            <div class="absolute -bottom-[20%] -left-[10%] w-[50vh] h-[50vh] bg-teal-100/40 rounded-full blur-[80px]"></div>
        </div>

        <div 
            class="relative z-10 w-full max-w-lg px-8 transition-all duration-700 ease-out transform"
            :class="isLoaded ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'"
        >
            
            <div class="bg-white/80 backdrop-blur-xl border border-white/50 shadow-2xl shadow-slate-200/60 rounded-3xl p-8 md:p-12 text-center relative overflow-hidden group">
                
                <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-emerald-500 to-teal-500"></div>

                <div class="relative inline-flex items-center justify-center w-20 h-20 mb-6 rounded-2xl bg-emerald-50 text-emerald-600 shadow-inner ring-1 ring-emerald-100">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path :d="errorConfig.icon"></path>
                    </svg>
                    <span v-if="errorConfig.action === 'reload'" class="absolute top-0 right-0 -mr-1 -mt-1 flex h-3 w-3">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                    </span>
                </div>

                <h1 class="font-heading font-bold text-5xl md:text-6xl text-slate-900 mb-2 tracking-tight">
                    {{ errorConfig.code }}
                </h1>
                
                <h2 class="text-lg font-semibold text-emerald-700 uppercase tracking-widest mb-4">
                    {{ errorConfig.label }}
                </h2>

                <p class="text-slate-500 leading-relaxed mb-8 text-sm md:text-base px-2">
                    {{ errorConfig.desc }}
                </p>

                <div class="flex flex-col gap-3 items-center">
                    
                    <component 
                        :is="errorConfig.action === 'home' ? Link : 'button'"
                        :href="errorConfig.action === 'home' ? '/' : null"
                        @click="errorConfig.action === 'reload' ? reloadPage() : null"
                        class="w-full h-12 inline-flex items-center justify-center gap-2 bg-slate-900 hover:bg-slate-800 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300"
                    >
                        <svg v-if="errorConfig.action === 'home'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        <svg v-else class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        
                        {{ errorConfig.btnText }} 
                        <span v-if="retryCountdown > 0" class="ml-1 opacity-80">({{ retryCountdown }}s)</span>
                    </component>

                </div>

            </div>

            <div class="mt-8 text-center">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/40 border border-white/20 backdrop-blur-sm">
                    <img src="/images/logo-ptq.svg" alt="Logo PTQ" class="h-4 w-auto grayscale opacity-60">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider border-l border-slate-300 pl-2 ml-2">
                        System Guard • {{ new Date().getFullYear() }}
                    </span>
                </div>
            </div>

        </div>
    </div>
</template>