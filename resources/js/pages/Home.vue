<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';

// Import Komponen Shadcn
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Separator } from '@/components/ui/separator';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';

defineProps({
    latestPosts: Array,
});

// Data Statis untuk Program Unggulan
const programs = [
    {
        title: 'Seni Tilawah',
        description: 'Mengasah keindahan suara dan irama dalam melantunkan ayat suci Al-Qur\'an dengan bimbingan qori/qoriah berpengalaman.',
        icon: 'mic', 
        color: 'bg-amber-100 text-amber-700 border-amber-200'
    },
    {
        title: 'Tahsin & Tahfidz',
        description: 'Memperbaiki bacaan sesuai kaidah tajwid dan program hafalan Al-Qur\'an intensif bagi mahasiswa.',
        icon: 'book',
        color: 'bg-emerald-100 text-emerald-700 border-emerald-200'
    },
    {
        title: 'Syiar & Kajian',
        description: 'Diskusi keislaman kontemporer dan penyelenggaraan event besar untuk membumikan nilai Qur\'ani di kampus.',
        icon: 'users',
        color: 'bg-blue-100 text-blue-700 border-blue-200'
    }
];

// Data Statistik (Bisa didinamiskan nanti)
const stats = [
    { label: 'Anggota Aktif', value: '150+' },
    { label: 'Prestasi Nasional', value: '25+' },
    { label: 'Tahun Berdiri', value: '2010' },
    { label: 'Divisi Kegiatan', value: '4' },
];
</script>

<template>
    <Head title="Beranda" />

    <PublicLayout>
        
        <section class="relative bg-emerald-950 overflow-hidden py-24 lg:py-32">
            <div class="absolute inset-0 opacity-20">
                <svg class="h-full w-full text-emerald-900" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path d="M0 100 C 20 0 50 0 100 100 Z"></path>
                </svg>
            </div>
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')] opacity-10 mix-blend-overlay"></div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <Badge variant="outline" class="mb-6 border-emerald-400/30 text-emerald-300 bg-emerald-900/50 backdrop-blur-sm px-4 py-1.5 text-sm uppercase tracking-wider animate-fade-in-up">
                    ✨ Unit Kegiatan Mahasiswa Terbaik
                </Badge>
                
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white font-serif tracking-tight leading-tight mb-6 drop-shadow-lg">
                    Membumikan <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-amber-400">Al-Qur'an</span> <br>
                    Di Kampus Jantong Hatee
                </h1>
                
                <p class="max-w-2xl mx-auto text-lg md:text-xl text-emerald-100/80 mb-10 leading-relaxed font-light">
                    Wadah pengembangan minat dan bakat mahasiswa Universitas Malikussaleh dalam seni, hafalan, dan pemahaman Al-Qur'an demi mewujudkan generasi berakhlakul karimah.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <Button size="lg" class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold px-8 h-12 rounded-full shadow-[0_0_20px_rgba(245,158,11,0.3)] transition-all hover:scale-105">
                        Daftar Anggota Baru
                    </Button>
                    <Button size="lg" variant="outline" as-child class="border-emerald-500/50 text-emerald-100 hover:bg-emerald-900/50 hover:text-white px-8 h-12 rounded-full backdrop-blur-sm">
                        <Link :href="route('structure')">Lihat Profil Pengurus</Link>
                    </Button>
                </div>
            </div>
        </section>

        <div class="border-b border-slate-200 bg-white relative z-10 -mt-8 mx-4 md:mx-auto max-w-6xl rounded-xl shadow-xl p-6 md:p-10 flex flex-wrap justify-around gap-8 text-center">
            <div v-for="(stat, index) in stats" :key="index" class="flex flex-col items-center">
                <span class="text-3xl md:text-4xl font-bold text-emerald-800 font-serif">{{ stat.value }}</span>
                <span class="text-xs md:text-sm text-slate-500 uppercase tracking-widest mt-1">{{ stat.label }}</span>
            </div>
        </div>

        <section class="py-24 bg-slate-50/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-slate-900 font-serif mb-4">Bidang Pengembangan</h2>
                    <Separator class="w-24 h-1 bg-emerald-500 mx-auto rounded-full" />
                    <p class="mt-4 text-slate-600 max-w-2xl mx-auto">Kami memfasilitasi mahasiswa untuk mengembangkan potensi diri melalui berbagai divisi yang terfokus.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <Card v-for="program in programs" :key="program.title" class="group hover:-translate-y-2 transition-all duration-300 border-none shadow-sm hover:shadow-xl">
                        <CardHeader>
                            <div :class="`w-14 h-14 rounded-2xl flex items-center justify-center mb-4 ${program.color}`">
                                <svg v-if="program.icon === 'mic'" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path></svg>
                                <svg v-if="program.icon === 'book'" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                <svg v-if="program.icon === 'users'" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <CardTitle class="text-xl font-bold text-slate-800 group-hover:text-emerald-700 transition-colors">{{ program.title }}</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <CardDescription class="text-base leading-relaxed">{{ program.description }}</CardDescription>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </section>

        <section class="py-20 bg-emerald-900 relative overflow-hidden text-center px-4">
             <div class="absolute inset-0 opacity-10 pattern-dots text-white"></div>
             <div class="relative z-10 max-w-4xl mx-auto">
                <svg class="w-12 h-12 mx-auto text-amber-400 mb-6 opacity-80" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 13.1216 16 12.017 16H11.983L11.983 15C11.983 13.3431 13.3261 12 14.983 12H16.017C17.6739 12 19.017 13.3431 19.017 15V21H14.017ZM5.01697 21L5.01697 18C5.01697 16.8954 4.12154 16 3.01697 16H2.98303L2.98303 15C2.98303 13.3431 4.32617 12 5.98303 12H6.98303C8.63989 12 9.98303 13.3431 9.98303 15V21H5.01697Z" /></svg>
                <blockquote class="text-2xl md:text-3xl font-serif text-emerald-50 leading-normal italic">
                    "Sebaik-baik kalian adalah orang yang mempelajari Al-Qur'an dan mengajarkannya."
                </blockquote>
                <p class="mt-6 text-emerald-300 font-medium uppercase tracking-widest text-sm">— H.R. Bukhari</p>
             </div>
        </section>

        <section class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                    <div>
                        <Badge variant="secondary" class="mb-3 text-emerald-700 bg-emerald-100 hover:bg-emerald-200">Update Kegiatan</Badge>
                        <h2 class="text-3xl md:text-4xl font-bold text-slate-900 font-serif">Warta UKM PTQ</h2>
                    </div>
                    <Button variant="outline" as-child class="hidden md:flex border-slate-300 hover:border-emerald-600 hover:text-emerald-700">
                        <Link :href="route('posts.index')">Lihat Semua Berita &rarr;</Link>
                    </Button>
                </div>

                <div v-if="latestPosts.length > 0" class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <Card v-for="post in latestPosts" :key="post.id" class="group flex flex-col h-full border-slate-200 hover:shadow-xl hover:border-emerald-100 transition-all duration-300 overflow-hidden rounded-2xl">
                        <div class="h-52 bg-slate-100 overflow-hidden relative">
                            <img v-if="post.cover" :src="post.cover" :alt="post.title" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            <div v-else class="w-full h-full flex items-center justify-center text-slate-400 bg-slate-50">
                                <svg class="w-12 h-12 opacity-20" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-5-7l-3 3.72L9 13l-3 4h12l-4-5z"/></svg>
                            </div>
                            <div class="absolute top-3 left-3">
                                <Badge class="bg-white/90 text-slate-800 hover:bg-white shadow-sm backdrop-blur-sm border-none">
                                    {{ post.published_at }}
                                </Badge>
                            </div>
                        </div>
                        
                        <CardHeader class="pb-2">
                            <CardTitle class="text-xl font-bold text-slate-900 leading-snug line-clamp-2 group-hover:text-emerald-700 transition-colors">
                                <Link :href="route('post.show', post.slug)">
                                    {{ post.title }}
                                </Link>
                            </CardTitle>
                        </CardHeader>
                        
                        <CardContent class="flex-grow">
                            <p class="text-slate-500 text-sm line-clamp-3 leading-relaxed">
                                {{ post.excerpt }}
                            </p>
                        </CardContent>

                        <div class="px-6 pb-6 pt-0">
                             <Button variant="link" as-child class="p-0 h-auto text-emerald-600 font-semibold hover:no-underline group/btn">
                                <Link :href="route('post.show', post.slug)" class="flex items-center">
                                    Baca Selengkapnya 
                                    <svg class="w-4 h-4 ml-1 transition-transform group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </Link>
                            </Button>
                        </div>
                    </Card>
                </div>

                <div v-else class="text-center py-12 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                    <p class="text-slate-400 italic">Belum ada berita terbaru yang dipublikasikan.</p>
                </div>

                <div class="mt-8 text-center md:hidden">
                    <Button variant="outline" as-child class="w-full">
                        <Link :href="route('posts.index')">Lihat Semua Berita</Link>
                    </Button>
                </div>
            </div>
        </section>

        <section class="py-20 bg-slate-900 text-center px-4">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-white font-serif mb-6">Siap Menjadi Bagian Dari Keluarga Qur'ani?</h2>
                <p class="text-slate-400 mb-10 text-lg leading-relaxed">
                    Mari bergabung bersama kami untuk mengembangkan diri, menjalin ukhuwah, dan mensyiarkan nilai-nilai Islam di lingkungan kampus.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <Button size="lg" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-full h-12 px-10">
                        Daftar Sekarang
                    </Button>
                    <Button size="lg" variant="outline" class="bg-transparent border-slate-600 text-slate-300 hover:bg-slate-800 hover:text-white rounded-full h-12 px-10">
                        Hubungi Kami
                    </Button>
                </div>
            </div>
        </section>

    </PublicLayout>
</template>

<style scoped>
/* Custom Keyframe Animation */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out forwards;
}

/* Pattern Overlay Helper */
.pattern-dots {
    background-image: radial-gradient(currentColor 1px, transparent 1px);
    background-size: 20px 20px;
}
</style>