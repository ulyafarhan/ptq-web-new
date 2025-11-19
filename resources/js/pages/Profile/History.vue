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

// Data Dummy Sejarah (Bisa diganti nanti)
const milestones = [
    { year: '2010', title: 'Awal Pendirian', desc: 'UKM PTQ didirikan oleh sekelompok mahasiswa yang memiliki keresahan akan minimnya wadah pengembangan tilawah di kampus.' },
    { year: '2013', title: 'Pengakuan Resmi', desc: 'Resmi disahkan sebagai Unit Kegiatan Mahasiswa (UKM) tingkat universitas oleh Rektorat Universitas Malikussaleh.' },
    { year: '2018', title: 'Tuan Rumah MTQMN', desc: 'Dipercaya menjadi tuan rumah seleksi MTQ Mahasiswa Nasional tingkat regional, membawa nama baik kampus di kancah nasional.' },
    { year: '2024', title: 'Transformasi Digital', desc: 'Meluncurkan platform digital terintegrasi untuk memperluas jangkauan dakwah dan manajemen organisasi.' },
];

const missions = [
    'Menyelenggarakan pembinaan rutin tahsin dan tilawah Al-Qur\'an.',
    'Mencetak kader-kader Qur\'ani yang berprestasi dan berakhlakul karimah.',
    'Mensyiarkan nilai-nilai Al-Qur\'an di lingkungan civitas akademika.',
    'Menjalin ukhuwah Islamiyah antar mahasiswa dan lembaga dakwah lainnya.'
];
</script>

<template>
    <Head title="Sejarah & Visi Misi" />

    <PublicLayout>
        <div class="min-h-screen bg-slate-50/50 py-12 px-4 sm:px-6 lg:px-8 font-sans">
            
            <div class="max-w-5xl mx-auto mb-12">
                <Breadcrumb>
                    <BreadcrumbList>
                        <BreadcrumbItem><BreadcrumbLink :href="route('home')">Beranda</BreadcrumbLink></BreadcrumbItem>
                        <BreadcrumbSeparator />
                        <BreadcrumbItem><BreadcrumbPage>Sejarah & Visi Misi</BreadcrumbPage></BreadcrumbItem>
                    </BreadcrumbList>
                </Breadcrumb>
            </div>

            <div class="max-w-4xl mx-auto text-center mb-20 animate-in fade-in slide-in-from-bottom-4 duration-700">
                <Badge variant="outline" class="mb-4 border-emerald-200 text-emerald-800 bg-emerald-50 px-4 py-1 text-xs font-bold tracking-widest uppercase">
                    Tentang Kami
                </Badge>
                <h1 class="text-4xl md:text-5xl font-bold text-emerald-950 font-serif mb-6 leading-tight">
                    Perjalanan Dakwah & <br> Cita-Cita Luhur
                </h1>
                <p class="text-slate-500 text-lg leading-relaxed max-w-2xl mx-auto">
                    Mengenal lebih dalam akar sejarah berdirinya UKM PTQ dan arah tujuan kami melangkah ke depan.
                </p>
            </div>

            <section class="max-w-6xl mx-auto mb-24">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
                    
                    <Card class="border-none shadow-xl bg-gradient-to-br from-emerald-900 to-emerald-800 text-white overflow-hidden relative group">
                        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')]"></div>
                        
                        <CardHeader class="relative z-10 pt-10 pb-2">
                            <div class="w-12 h-1 bg-amber-400 mb-6 rounded-full"></div>
                            <h2 class="text-3xl font-bold font-serif tracking-wide mb-2">Visi Organisasi</h2>
                        </CardHeader>
                        <CardContent class="relative z-10 pb-10">
                            <p class="text-xl md:text-2xl font-light leading-relaxed text-emerald-50 italic font-serif">
                                "Terwujudnya Generasi Mahasiswa yang Qur'ani, Berprestasi, dan Berakhlakul Karimah di Universitas Malikussaleh."
                            </p>
                        </CardContent>
                        <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-emerald-500/20 rounded-full blur-3xl group-hover:bg-emerald-400/30 transition-all duration-700"></div>
                    </Card>

                    <Card class="border-slate-200 shadow-md hover:shadow-lg transition-shadow bg-white">
                        <CardHeader class="pb-4 pt-8 px-8">
                            <h2 class="text-2xl font-bold text-slate-800 font-serif flex items-center gap-3">
                                <span class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 text-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                </span>
                                Misi Kami
                            </h2>
                        </CardHeader>
                        <CardContent class="px-8 pb-8">
                            <ul class="space-y-4">
                                <li v-for="(misi, index) in missions" :key="index" class="flex gap-4 group">
                                    <span class="flex-shrink-0 w-6 h-6 rounded-full bg-slate-100 text-slate-500 font-bold text-xs flex items-center justify-center mt-0.5 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                                        {{ index + 1 }}
                                    </span>
                                    <span class="text-slate-600 group-hover:text-slate-900 transition-colors leading-relaxed">
                                        {{ misi }}
                                    </span>
                                </li>
                            </ul>
                        </CardContent>
                    </Card>

                </div>
            </section>

            <section class="max-w-4xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-2xl font-bold text-emerald-900 font-serif mb-2">Jejak Langkah</h2>
                    <Separator class="w-20 h-1 bg-amber-400 mx-auto rounded-full" />
                </div>

                <div class="relative border-l-2 border-emerald-100 ml-4 md:ml-10 space-y-12 pl-8 md:pl-12 py-4">
                    <div v-for="(item, index) in milestones" :key="index" class="relative group">
                        <div class="absolute -left-[41px] md:-left-[59px] top-1 w-5 h-5 rounded-full border-4 border-white bg-emerald-300 group-hover:bg-emerald-600 group-hover:scale-125 transition-all duration-300 shadow-sm"></div>
                        
                        <div class="flex flex-col sm:flex-row sm:items-baseline gap-2 sm:gap-6">
                            <span class="text-3xl font-bold text-emerald-900/20 font-serif group-hover:text-emerald-600/40 transition-colors">
                                {{ item.year }}
                            </span>
                            <div>
                                <h3 class="text-xl font-bold text-slate-800 mb-2 group-hover:text-emerald-700 transition-colors">
                                    {{ item.title }}
                                </h3>
                                <p class="text-slate-500 leading-relaxed">
                                    {{ item.desc }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </PublicLayout>
</template>