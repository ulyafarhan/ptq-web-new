<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';

// Import Shadcn Components
import { Badge } from '@/components/ui/badge';
import { Separator } from '@/components/ui/separator';
import { Card, CardHeader, CardTitle, CardContent } from '@/components/ui/card';
import {
  Breadcrumb,
  BreadcrumbItem,
  BreadcrumbLink,
  BreadcrumbList,
  BreadcrumbPage,
  BreadcrumbSeparator,
} from '@/components/ui/breadcrumb';

// Props dari Controller
defineProps({
    milestones: Array,
});

// Data Statis Visi Misi (Bisa dipindah ke DB nanti jika mau)
const missions = [
    'Menyelenggarakan pembinaan rutin tahsin dan tilawah Al-Qur\'an yang berkualitas.',
    'Mencetak kader-kader mahasiswa yang berprestasi dalam MTQ Nasional.',
    'Mensyiarkan nilai-nilai Al-Qur\'an di lingkungan civitas akademika Unimal.',
    'Menjalin ukhuwah Islamiyah yang erat antar lembaga dakwah kampus.'
];
</script>

<template>
    <Head title="Sejarah & Visi Misi" />

    <PublicLayout>
        <div class="min-h-screen bg-slate-50/50 py-12 px-4 sm:px-6 lg:px-8 font-sans">
            
            <div class="max-w-5xl mx-auto mb-16">
                <Breadcrumb class="mb-8 justify-center md:justify-start">
                    <BreadcrumbList>
                        <BreadcrumbItem><BreadcrumbLink :href="route('home')">Beranda</BreadcrumbLink></BreadcrumbItem>
                        <BreadcrumbSeparator />
                        <BreadcrumbItem><BreadcrumbPage>Sejarah & Visi Misi</BreadcrumbPage></BreadcrumbItem>
                    </BreadcrumbList>
                </Breadcrumb>

                <div class="text-center max-w-4xl mx-auto animate-in fade-in slide-in-from-bottom-4 duration-700">
                    <Badge variant="outline" class="mb-4 border-emerald-200 text-emerald-700 bg-emerald-50 px-4 py-1 text-xs font-bold tracking-widest uppercase">
                        Tentang Kami
                    </Badge>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold text-emerald-950 mb-6 tracking-tight leading-tight">
                        Perjalanan Dakwah & <br> Cita-Cita Luhur
                    </h1>
                    <p class="text-slate-500 text-lg md:text-xl font-light leading-relaxed max-w-2xl mx-auto">
                        Mengenal lebih dalam akar sejarah berdirinya UKM PTQ dan arah tujuan kami melangkah ke depan.
                    </p>
                </div>
            </div>

            <section class="max-w-6xl mx-auto mb-24">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
                    
                    <Card class="border-none shadow-2xl bg-gradient-to-br from-emerald-900 to-emerald-800 text-white overflow-hidden relative group rounded-3xl">
                        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
                        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full blur-3xl -mr-16 -mt-16"></div>
                        
                        <CardHeader class="relative z-10 pt-10 pb-2 px-8">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="p-2 bg-white/10 rounded-lg backdrop-blur-sm">
                                    <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </div>
                                <span class="text-emerald-200 font-bold tracking-widest text-sm uppercase">Visi Organisasi</span>
                            </div>
                            <h2 class="text-3xl font-heading font-bold text-white">Tujuan Besar Kami</h2>
                        </CardHeader>
                        
                        <CardContent class="relative z-10 px-8 pb-12">
                            <blockquote class="text-xl md:text-2xl font-heading font-medium leading-relaxed text-emerald-50 mt-4 border-l-4 border-amber-400 pl-6">
                                "Terwujudnya Generasi Mahasiswa yang Qur'ani, Berprestasi, dan Berakhlakul Karimah di Universitas Malikussaleh."
                            </blockquote>
                        </CardContent>
                    </Card>

                    <Card class="border-slate-200 shadow-lg hover:shadow-xl transition-all duration-300 bg-white rounded-3xl flex flex-col justify-center">
                        <CardHeader class="pb-2 pt-8 px-8">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="p-2 bg-emerald-50 rounded-lg">
                                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                                </div>
                                <span class="text-slate-400 font-bold tracking-widest text-sm uppercase">Misi Kami</span>
                            </div>
                            <h2 class="text-3xl font-heading font-bold text-slate-900">Langkah Nyata</h2>
                        </CardHeader>
                        <CardContent class="px-8 pb-8">
                            <ul class="space-y-4 mt-4">
                                <li v-for="(misi, index) in missions" :key="index" class="flex gap-4 group">
                                    <span class="flex-shrink-0 w-8 h-8 rounded-full bg-slate-100 text-slate-500 font-bold font-heading text-sm flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
                                        {{ index + 1 }}
                                    </span>
                                    <span class="text-slate-600 text-lg leading-relaxed group-hover:text-slate-900 transition-colors">
                                        {{ misi }}
                                    </span>
                                </li>
                            </ul>
                        </CardContent>
                    </Card>

                </div>
            </section>

            <section class="max-w-4xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-heading font-bold text-emerald-950 mb-4">Jejak Langkah</h2>
                    <div class="w-24 h-1.5 bg-amber-400 mx-auto rounded-full"></div>
                </div>

                <div v-if="milestones.length > 0" class="relative border-l-2 border-slate-200 ml-4 md:ml-12 space-y-12 pb-12">
                    <div v-for="(item, index) in milestones" :key="index" class="relative pl-8 md:pl-12 group">
                        
                        <div class="absolute -left-[9px] top-2 w-4 h-4 rounded-full bg-white border-4 border-slate-300 group-hover:border-emerald-500 group-hover:scale-125 transition-all duration-300 z-10"></div>
                        
                        <div class="flex flex-col md:flex-row md:items-start gap-4 md:gap-8 p-6 rounded-2xl hover:bg-white hover:shadow-lg transition-all duration-300 border border-transparent hover:border-slate-100">
                            <span class="text-4xl md:text-5xl font-heading font-bold text-emerald-600 group-hover:text-emerald-600/20 transition-colors md:w-32 flex-shrink-0 leading-none">
                                {{ item.year }}
                            </span>
                            
                            <div>
                                <h3 class="text-xl md:text-2xl font-heading font-bold text-slate-800 mb-3 group-hover:text-emerald-700 transition-colors">
                                    {{ item.title }}
                                </h3>
                                <p class="text-slate-500 leading-relaxed text-base">
                                    {{ item.desc }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-else class="text-center py-16 bg-white rounded-3xl border border-dashed border-slate-200">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-50 mb-4">
                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-slate-400 font-medium">Belum ada data sejarah yang ditambahkan.</p>
                </div>

            </section>

        </div>
    </PublicLayout>
</template>