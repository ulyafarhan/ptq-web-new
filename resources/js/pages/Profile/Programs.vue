<script setup>
import { Head } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';

// Import Shadcn Components
import {
  Breadcrumb,
  BreadcrumbItem,
  BreadcrumbLink,
  BreadcrumbList,
  BreadcrumbPage,
  BreadcrumbSeparator,
} from '@/components/ui/breadcrumb';
import { Badge } from '@/components/ui/badge';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
import { Card, CardHeader, CardTitle, CardContent, CardDescription, CardFooter } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Separator } from '@/components/ui/separator';

// Data Dummy Program Kerja
const programs = {
    rutin: [
        {
            title: 'Kelas Tahsin Intensif',
            desc: 'Bimbingan perbaikan bacaan Al-Qur\'an sesuai kaidah tajwid secara privat atau kelompok kecil.',
            schedule: 'Senin - Kamis, 16.00 WIB',
            location: 'Musholla Kampus',
            icon: 'book-open',
            color: 'bg-emerald-100 text-emerald-600'
        },
        {
            title: 'Latihan Tilawah Seni',
            desc: 'Mengasah keindahan suara dan lagu (maqomat) dalam membaca Al-Qur\'an bersama pelatih profesional.',
            schedule: 'Sabtu, 09.00 WIB',
            location: 'Aula Cut Meutia',
            icon: 'mic',
            color: 'bg-amber-100 text-amber-600'
        },
        {
            title: 'Halaqah Tahfidz',
            desc: 'Setoran hafalan Al-Qur\'an dan murojaah bagi anggota yang sedang menjaga hafalan.',
            schedule: 'Jumat, 14.00 WIB',
            location: 'Sekretariat UKM',
            icon: 'brain',
            color: 'bg-blue-100 text-blue-600'
        }
    ],
    bulanan: [
        {
            title: 'Kajian Islam Bulanan',
            desc: 'Diskusi tematik membahas isu-isu kontemporer dari sudut pandang Al-Qur\'an dan Sunnah.',
            schedule: 'Pekan ke-2 Setiap Bulan',
            location: 'Masjid Kampus',
            image: 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
        },
        {
            title: 'Rihlah & Tafakkur Alam',
            desc: 'Kegiatan tadabbur alam sekaligus mempererat ukhuwah antar pengurus dan anggota baru.',
            schedule: 'Per 3 Bulan Sekali',
            location: 'Tentatif (Alam Terbuka)',
            image: 'https://images.unsplash.com/photo-1505027593521-22e36c6e58eb?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
        }
    ],
    tahunan: [
        {
            title: 'MTQ Mahasiswa (MTQM)',
            desc: 'Ajang kompetisi Musabaqah Tilawatil Qur\'an tingkat universitas untuk menyeleksi delegasi ke tingkat nasional.',
            status: 'Coming Soon',
            month: 'Oktober 2025'
        },
        {
            title: 'PTQ Fair & Expo',
            desc: 'Festival seni islami, bazar buku, pameran kaligrafi, dan seminar nasional yang terbuka untuk umum.',
            status: 'Selesai',
            month: 'Maret 2025'
        },
        {
            title: 'Daurah Marhalah',
            desc: 'Pelatihan kepemimpinan dan manajemen organisasi untuk kaderisasi pengurus baru.',
            status: 'Open Recruitment',
            month: 'Desember 2025'
        }
    ]
};
</script>

<template>
    <Head title="Program Kerja" />

    <PublicLayout>
        <div class="min-h-screen bg-slate-50/50 py-12 px-4 sm:px-6 lg:px-8 font-sans">
            
            <div class="max-w-7xl mx-auto mb-12">
                <Breadcrumb>
                    <BreadcrumbList>
                        <BreadcrumbItem><BreadcrumbLink :href="route('home')">Beranda</BreadcrumbLink></BreadcrumbItem>
                        <BreadcrumbSeparator />
                        <BreadcrumbItem><BreadcrumbPage>Program Kerja</BreadcrumbPage></BreadcrumbItem>
                    </BreadcrumbList>
                </Breadcrumb>
            </div>

            <div class="max-w-4xl mx-auto text-center mb-16 animate-in fade-in zoom-in-95 duration-700">
                <Badge variant="secondary" class="mb-4 bg-emerald-100 text-emerald-800 hover:bg-emerald-200 px-4 py-1">
                    Agenda Kegiatan
                </Badge>
                <h1 class="text-4xl md:text-5xl font-bold text-emerald-950 font-serif mb-6">
                    Wahana Aktualisasi Diri
                </h1>
                <p class="text-slate-500 text-lg max-w-2xl mx-auto leading-relaxed">
                    Beragam kegiatan positif yang dirancang untuk menyeimbangkan prestasi akademik dan kematangan spiritual mahasiswa.
                </p>
            </div>

            <div class="max-w-6xl mx-auto">
                <Tabs default-value="rutin" class="w-full">
                    
                    <div class="flex justify-center mb-12">
                        <TabsList class="grid w-full max-w-md grid-cols-3 h-12 bg-slate-200/50 p-1 rounded-full">
                            <TabsTrigger value="rutin" class="rounded-full data-[state=active]:bg-white data-[state=active]:text-emerald-700 data-[state=active]:shadow-md transition-all">Rutin</TabsTrigger>
                            <TabsTrigger value="bulanan" class="rounded-full data-[state=active]:bg-white data-[state=active]:text-emerald-700 data-[state=active]:shadow-md transition-all">Bulanan</TabsTrigger>
                            <TabsTrigger value="tahunan" class="rounded-full data-[state=active]:bg-white data-[state=active]:text-emerald-700 data-[state=active]:shadow-md transition-all">Tahunan</TabsTrigger>
                        </TabsList>
                    </div>

                    <TabsContent value="rutin" class="animate-in slide-in-from-bottom-4 duration-500">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <Card v-for="(item, idx) in programs.rutin" :key="idx" class="hover:shadow-lg transition-all duration-300 border-slate-200 hover:border-emerald-200">
                                <CardHeader>
                                    <div :class="`w-12 h-12 rounded-xl flex items-center justify-center mb-4 ${item.color}`">
                                        <svg v-if="item.icon==='mic'" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path></svg>
                                        <svg v-else-if="item.icon==='book-open'" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                        <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                                    </div>
                                    <CardTitle class="text-xl text-emerald-900">{{ item.title }}</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <p class="text-slate-500 mb-6 text-sm leading-relaxed">{{ item.desc }}</p>
                                    <Separator class="my-4" />
                                    <div class="space-y-2 text-sm">
                                        <div class="flex items-center text-slate-600">
                                            <svg class="w-4 h-4 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            {{ item.schedule }}
                                        </div>
                                        <div class="flex items-center text-slate-600">
                                            <svg class="w-4 h-4 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            {{ item.location }}
                                        </div>
                                    </div>
                                </CardContent>
                            </Card>
                        </div>
                    </TabsContent>

                    <TabsContent value="bulanan" class="animate-in slide-in-from-bottom-4 duration-500">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div v-for="(item, idx) in programs.bulanan" :key="idx" class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-200 flex flex-col">
                                <div class="h-48 overflow-hidden bg-slate-100 relative">
                                    <img :src="item.image" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent flex items-end p-6">
                                        <h3 class="text-white font-bold text-xl">{{ item.title }}</h3>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <p class="text-slate-600 mb-4">{{ item.desc }}</p>
                                    <div class="flex items-center gap-2 text-sm font-medium text-emerald-700 bg-emerald-50 w-fit px-3 py-1 rounded-full">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ item.schedule }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </TabsContent>

                    <TabsContent value="tahunan" class="animate-in slide-in-from-bottom-4 duration-500">
                        <div class="space-y-6 max-w-4xl mx-auto">
                            <div v-for="(item, idx) in programs.tahunan" :key="idx" class="group flex flex-col md:flex-row gap-6 items-center bg-white p-6 rounded-2xl border border-slate-200 hover:border-emerald-200 hover:shadow-md transition-all">
                                <div class="w-full md:w-32 h-24 bg-slate-50 rounded-xl flex flex-col items-center justify-center border border-slate-100 group-hover:bg-emerald-50 group-hover:border-emerald-100 transition-colors shrink-0">
                                    <span class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Agenda</span>
                                    <span class="text-emerald-700 font-bold text-center text-sm px-2">{{ item.month }}</span>
                                </div>

                                <div class="flex-grow text-center md:text-left">
                                    <div class="flex flex-col md:flex-row md:items-center gap-3 mb-2">
                                        <h3 class="text-xl font-bold text-slate-900 font-serif">{{ item.title }}</h3>
                                        <Badge :class="item.status === 'Coming Soon' ? 'bg-amber-100 text-amber-700 hover:bg-amber-200' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'">
                                            {{ item.status }}
                                        </Badge>
                                    </div>
                                    <p class="text-slate-500 text-sm">{{ item.desc }}</p>
                                </div>

                                <Button variant="outline" class="shrink-0" v-if="item.status !== 'Selesai'">
                                    Info Detail
                                </Button>
                            </div>
                        </div>
                    </TabsContent>

                </Tabs>
            </div>

            <div class="mt-24 text-center bg-gradient-to-r from-emerald-900 to-emerald-800 rounded-3xl p-10 md:p-16 max-w-5xl mx-auto text-white shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-amber-500/20 rounded-full blur-3xl"></div>
                
                <h2 class="text-3xl font-bold font-serif mb-4 relative z-10">Tertarik Mengikuti Kegiatan Kami?</h2>
                <p class="text-emerald-100 mb-8 max-w-xl mx-auto relative z-10">
                    Sebagian besar program rutin kami terbuka untuk umum bagi seluruh mahasiswa Universitas Malikussaleh.
                </p>
                <div class="flex justify-center gap-4 relative z-10">
                    <Button size="lg" class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold rounded-full">
                        Lihat Jadwal Lengkap
                    </Button>
                    <Button size="lg" variant="outline" class="bg-transparent border-emerald-400 text-emerald-100 hover:bg-emerald-800 hover:text-white rounded-full">
                        Tanya Admin
                    </Button>
                </div>
            </div>

        </div>
    </PublicLayout>
</template>