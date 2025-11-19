<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';

// Import Shadcn Components
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';

// Props dari Backend
defineProps({
    latestPosts: Array,
    siteConfig: Object, 
});

const features = [
    {
        title: 'Pembinaan Intensif',
        desc: 'Kurikulum tahsin dan tilawah yang terstruktur dibimbing oleh mentor berpengalaman.',
        icon: 'book'
    },
    {
        title: 'Komunitas Positif',
        desc: 'Lingkungan pertemanan yang saling mendukung dalam kebaikan dan prestasi.',
        icon: 'users'
    },
    {
        title: 'Prestasi Nasional',
        desc: 'Dukungan penuh untuk delegasi lomba MTQ tingkat regional hingga nasional.',
        icon: 'trophy'
    }
];
</script>

<template>
    <Head title="Beranda" />

    <PublicLayout>
        
        <section class="relative pt-10 pb-20 lg:pt-20 lg:pb-32 overflow-hidden bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="grid lg:grid-cols-2 gap-12 lg:gap-8 items-center">
                    
                    <div class="max-w-2xl animate-in slide-in-from-left-6 duration-700 fade-in">
                        <Badge variant="secondary" class="mb-6 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 px-4 py-1.5 text-sm font-medium rounded-full border border-emerald-100">
                            UKM Terbaik Universitas Malikussaleh
                        </Badge>
                        
                        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-heading font-bold text-slate-900 leading-[1.1] tracking-tight mb-6">
                            {{ siteConfig?.hero_title || "Wadah Generasi Qur'ani Berprestasi" }}
                        </h1>
                        
                        <p class="text-lg text-slate-600 mb-8 leading-relaxed max-w-lg font-sans">
                            {{ siteConfig?.hero_desc || "Bergabunglah bersama kami mengembangkan potensi tilawah, tahsin, dan karakter islami di lingkungan kampus." }}
                        </p>
                        
                        <div class="flex flex-wrap gap-4">
                            <a v-if="siteConfig?.register_url" :href="siteConfig.register_url" target="_blank">
                                <Button size="lg" class="h-12 px-8 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white font-heading font-semibold shadow-lg shadow-emerald-200 hover:shadow-xl transition-all hover:-translate-y-1">
                                    Daftar Sekarang
                                </Button>
                            </a>
                            <Link v-else href="/register">
                                <Button size="lg" class="h-12 px-8 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white font-heading font-semibold shadow-lg shadow-emerald-200 hover:shadow-xl transition-all hover:-translate-y-1">
                                    Gabung Anggota
                                </Button>
                            </Link>

                            <Button as-child size="lg" variant="outline" class="h-12 px-8 rounded-full border-slate-300 text-slate-700 hover:bg-slate-50 font-heading font-semibold">
                                <Link href="/program-kerja">Lihat Program</Link>
                            </Button>
                        </div>

                        <div class="mt-10 flex items-center gap-4 text-sm text-slate-500 font-medium">
                            <div class="flex -space-x-3">
                                <div v-for="i in 4" :key="i" class="w-10 h-10 rounded-full border-2 border-white bg-slate-200 overflow-hidden">
                                    <img :src="`https://i.pravatar.cc/100?img=${i + 10}`" alt="Member" class="w-full h-full object-cover">
                                </div>
                            </div>
                            <p>Bergabung dengan <span class="text-slate-900 font-bold">500+</span> Mahasiswa</p>
                        </div>
                    </div>

                    <div class="relative lg:h-[600px] w-full flex items-center justify-center animate-in slide-in-from-right-6 duration-1000 fade-in">
                        <div class="absolute inset-0 bg-emerald-100 rounded-full blur-3xl opacity-30 animate-pulse"></div>
                        
                        <div class="relative grid grid-cols-2 gap-4 w-full max-w-lg transform rotate-[-6deg] hover:rotate-0 transition-transform duration-700 ease-out">
                            <div class="space-y-4 mt-12">
                                <div class="rounded-2xl overflow-hidden shadow-2xl h-48 bg-slate-200">
                                    <img src="https://images.unsplash.com/photo-1609599006353-e629aaabfeae?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover hover:scale-110 transition-transform duration-700">
                                </div>
                                <div class="rounded-2xl overflow-hidden shadow-2xl h-64 bg-slate-200">
                                    <img src="https://images.unsplash.com/photo-1519834785169-98be25ec3f84?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover hover:scale-110 transition-transform duration-700">
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="rounded-2xl overflow-hidden shadow-2xl h-64 bg-slate-200">
                                    <img src="https://images.unsplash.com/photo-1529070538774-1843cb3265df?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover hover:scale-110 transition-transform duration-700">
                                </div>
                                <div class="rounded-2xl overflow-hidden shadow-2xl h-48 bg-slate-200">
                                    <img src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover hover:scale-110 transition-transform duration-700">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="py-24 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <h2 class="text-3xl md:text-4xl font-heading font-bold text-slate-900 mb-4">Mengapa Harus PTQ?</h2>
                    <p class="text-slate-600 text-lg">Fokus pengembangan soft-skill dan spiritualitas dalam satu wadah.</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div v-for="(feature, i) in features" :key="i" class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600 mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                            <svg v-if="feature.icon === 'book'" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            <svg v-if="feature.icon === 'users'" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            <svg v-if="feature.icon === 'trophy'" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                        </div>
                        <h3 class="text-xl font-heading font-bold text-slate-900 mb-3">{{ feature.title }}</h3>
                        <p class="text-slate-500 leading-relaxed">{{ feature.desc }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-end mb-12">
                    <div>
                        <h2 class="text-3xl font-heading font-bold text-slate-900">Kabar Terbaru</h2>
                        <p class="text-slate-500 mt-2 text-lg">Update kegiatan dan informasi seputar kampus.</p>
                    </div>
                    <Link :href="route('posts.index')" class="hidden md:flex items-center text-emerald-600 font-semibold hover:text-emerald-700">
                        Lihat Semua <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </Link>
                </div>

                <div v-if="latestPosts.length > 0" class="grid md:grid-cols-3 gap-8">
                    <div v-for="post in latestPosts" :key="post.id" class="group flex flex-col h-full bg-white rounded-3xl border border-slate-100 overflow-hidden hover:shadow-2xl hover:shadow-emerald-100 transition-all duration-300 hover:-translate-y-1">
                        <div class="h-56 bg-slate-100 relative overflow-hidden">
                            <img v-if="post.cover" :src="post.cover" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div v-else class="w-full h-full flex items-center justify-center bg-emerald-50 text-emerald-200">
                                <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-5-7l-3 3.72L9 13l-3 4h12l-4-5z"/></svg>
                            </div>
                            <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-slate-800 shadow-sm">
                                {{ post.published_at }}
                            </div>
                        </div>

                        <div class="p-8 flex flex-col flex-grow">
                            <h3 class="text-xl font-heading font-bold text-slate-900 mb-3 line-clamp-2 group-hover:text-emerald-600 transition-colors">
                                <Link :href="route('post.show', post.slug)">{{ post.title }}</Link>
                            </h3>
                            <p class="text-slate-500 text-sm leading-relaxed line-clamp-3 mb-6 flex-grow">
                                {{ post.excerpt }}
                            </p>
                            <Link :href="route('post.show', post.slug)" class="inline-flex items-center text-sm font-bold text-emerald-600 group-hover:underline">
                                Baca Selengkapnya
                            </Link>
                        </div>
                    </div>
                </div>
                
                <div v-else class="text-center py-16 bg-slate-50 rounded-3xl border border-dashed border-slate-200">
                    <p class="text-slate-400 font-medium">Belum ada berita dipublikasikan.</p>
                </div>

                <div class="mt-8 text-center md:hidden">
                    <Button variant="outline" class="w-full rounded-full border-slate-300" as-child>
                        <Link :href="route('posts.index')">Lihat Semua Berita</Link>
                    </Button>
                </div>
            </div>
        </section>

        <section class="py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="relative rounded-[2.5rem] overflow-hidden bg-emerald-900 px-6 py-16 md:px-16 md:py-20 text-center shadow-2xl shadow-emerald-900/20">
                    <div class="absolute top-0 left-0 w-full h-full opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
                    <div class="absolute -top-24 -right-24 w-64 h-64 bg-emerald-500 rounded-full blur-3xl opacity-20"></div>
                    <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-amber-400 rounded-full blur-3xl opacity-20"></div>

                    <div class="relative z-10 max-w-3xl mx-auto">
                        <h2 class="text-3xl md:text-5xl font-heading font-bold text-white mb-6 tracking-tight">
                            Mulai Perjalanan Hijrahmu Di Sini
                        </h2>
                        <p class="text-emerald-100 text-lg md:text-xl mb-10 font-light">
                            Temukan sahabat, ilmu, dan pengalaman baru dalam suasana kekeluargaan yang islami.
                        </p>
                        
                        <div class="flex flex-col sm:flex-row justify-center gap-4 relative z-10">
                            <Button as-child size="lg" class="bg-white text-emerald-900 hover:bg-emerald-50 font-heading font-bold h-14 px-10 rounded-full shadow-xl cursor-pointer">
                                <Link :href="route('profile.programs')">
                                    Lihat Program
                                </Link>
                            </Button>

                            <Button as-child size="lg" variant="outline" class="bg-transparent border-emerald-500 text-emerald-100 hover:bg-emerald-800 hover:text-white hover:border-transparent h-14 px-10 rounded-full cursor-pointer">
                                <a v-if="siteConfig?.register_url" :href="siteConfig.register_url" target="_blank">
                                    Daftar Sekarang
                                </a>
                            </Button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </PublicLayout>
</template>

<style scoped>
.font-heading {
    font-family: 'Outfit', sans-serif;
}
.font-sans {
    font-family: 'Inter', sans-serif;
}
</style>