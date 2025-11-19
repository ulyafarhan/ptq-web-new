<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3'; // Import usePage
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
import { Card, CardHeader, CardTitle, CardContent } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Separator } from '@/components/ui/separator';

const props = defineProps({
    programs: Object,
});

// Ambil data global dari HandleInertiaRequests (Navbar/Footer data)
const page = usePage();
const site = page.props.site; 

const hasData = (type) => props.programs[type] && props.programs[type].length > 0;
</script>

<template>
    <Head title="Program Kerja" />

    <PublicLayout>
        <div class="min-h-screen bg-slate-50/50 py-12 px-4 sm:px-6 lg:px-8 font-sans">
            
            <div class="max-w-7xl mx-auto mb-16">
                <Breadcrumb class="mb-8 justify-center md:justify-start">
                    <BreadcrumbList>
                        <BreadcrumbItem><BreadcrumbLink :href="route('home')">Beranda</BreadcrumbLink></BreadcrumbItem>
                        <BreadcrumbSeparator />
                        <BreadcrumbItem><BreadcrumbPage>Program Kerja</BreadcrumbPage></BreadcrumbItem>
                    </BreadcrumbList>
                </Breadcrumb>

                <div class="text-center max-w-4xl mx-auto animate-in fade-in slide-in-from-bottom-4 duration-700">
                    <Badge variant="secondary" class="mb-4 bg-emerald-100 text-emerald-800 hover:bg-emerald-200 px-4 py-1 rounded-full text-xs font-bold uppercase tracking-widest">
                        Agenda Kegiatan
                    </Badge>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold text-emerald-950 mb-6 tracking-tight">
                        Wahana Aktualisasi Diri
                    </h1>
                    <p class="text-slate-500 text-lg md:text-xl font-light leading-relaxed max-w-2xl mx-auto">
                        Beragam kegiatan positif yang dirancang untuk menyeimbangkan prestasi akademik dan kematangan spiritual.
                    </p>
                </div>
            </div>

            <div class="max-w-6xl mx-auto min-h-[600px]">
                <Tabs default-value="rutin" class="w-full">
                    
                    <div class="flex justify-center mb-12">
                        <TabsList class="grid w-full max-w-md grid-cols-3 h-14 bg-slate-200/60 p-1.5 rounded-full shadow-inner">
                            <TabsTrigger value="rutin" class="rounded-full text-sm font-bold data-[state=active]:bg-white data-[state=active]:text-emerald-700 data-[state=active]:shadow-md transition-all">
                                Rutin
                            </TabsTrigger>
                            <TabsTrigger value="bulanan" class="rounded-full text-sm font-bold data-[state=active]:bg-white data-[state=active]:text-emerald-700 data-[state=active]:shadow-md transition-all">
                                Bulanan
                            </TabsTrigger>
                            <TabsTrigger value="tahunan" class="rounded-full text-sm font-bold data-[state=active]:bg-white data-[state=active]:text-emerald-700 data-[state=active]:shadow-md transition-all">
                                Tahunan
                            </TabsTrigger>
                        </TabsList>
                    </div>

                    <TabsContent value="rutin" class="animate-in fade-in zoom-in-95 duration-500">
                        <div v-if="hasData('rutin')" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <Card v-for="(item, idx) in programs.rutin" :key="idx" 
                                  class="group hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border-slate-200 hover:border-emerald-200 bg-white rounded-3xl overflow-hidden">
                                <CardHeader class="pb-4">
                                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-6 bg-emerald-50 text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors shadow-sm">
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                    </div>
                                    <CardTitle class="text-xl font-heading font-bold text-slate-900 group-hover:text-emerald-700 transition-colors">
                                        {{ item.title }}
                                    </CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <p class="text-slate-500 mb-6 text-sm leading-relaxed">{{ item.desc }}</p>
                                    <Separator class="my-4 bg-slate-100" />
                                    <div class="space-y-3 text-sm font-medium">
                                        <div class="flex items-center text-slate-600 bg-slate-50 p-2 rounded-lg">
                                            <svg class="w-4 h-4 mr-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            {{ item.schedule }}
                                        </div>
                                        <div class="flex items-center text-slate-600 bg-slate-50 p-2 rounded-lg">
                                            <svg class="w-4 h-4 mr-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            {{ item.location }}
                                        </div>
                                    </div>
                                </CardContent>
                            </Card>
                        </div>
                         <div v-else class="text-center py-20 bg-white rounded-3xl border border-dashed border-slate-200">
                            <p class="text-slate-400 font-medium">Belum ada program rutin yang ditambahkan.</p>
                        </div>
                    </TabsContent>

                    <TabsContent value="bulanan" class="animate-in fade-in zoom-in-95 duration-500">
                        <div v-if="hasData('bulanan')" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div v-for="(item, idx) in programs.bulanan" :key="idx" 
                                 class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl border border-slate-200 flex flex-col transition-all duration-300 group hover:-translate-y-1">
                                <div class="h-60 overflow-hidden bg-slate-100 relative">
                                    <img v-if="item.image" :src="item.image" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                                    <div v-else class="w-full h-full flex items-center justify-center bg-slate-50 text-slate-300">
                                        <svg class="w-16 h-16 opacity-20" fill="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                    </div>
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-8">
                                        <h3 class="text-white font-heading font-bold text-2xl mb-1">{{ item.title }}</h3>
                                        <p class="text-emerald-200 text-sm font-medium flex items-center">
                                            <span class="w-2 h-2 bg-emerald-400 rounded-full mr-2 animate-pulse"></span>
                                            {{ item.schedule }}
                                        </p>
                                    </div>
                                </div>
                                <div class="p-8 flex flex-col flex-grow">
                                    <p class="text-slate-600 mb-6 text-base leading-relaxed flex-grow">{{ item.desc }}</p>
                                    <div class="flex items-center justify-between pt-6 border-t border-slate-100">
                                        <div class="flex items-center text-sm font-bold text-slate-500">
                                            <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            {{ item.location }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div v-else class="text-center py-20 bg-white rounded-3xl border border-dashed border-slate-200">
                            <p class="text-slate-400 font-medium">Belum ada program bulanan yang ditambahkan.</p>
                        </div>
                    </TabsContent>

                    <TabsContent value="tahunan" class="animate-in fade-in zoom-in-95 duration-500">
                        <div v-if="hasData('tahunan')" class="space-y-6 max-w-4xl mx-auto">
                            <div v-for="(item, idx) in programs.tahunan" :key="idx" 
                                 class="group flex flex-col md:flex-row gap-6 items-stretch bg-white p-6 rounded-3xl border border-slate-200 hover:border-emerald-200 hover:shadow-lg transition-all duration-300">
                                
                                <div class="w-full md:w-40 bg-slate-50 rounded-2xl flex flex-col items-center justify-center border border-slate-100 group-hover:bg-emerald-50 group-hover:border-emerald-100 transition-colors py-6 md:py-0 shrink-0">
                                    <span class="text-xs text-slate-400 font-bold uppercase tracking-widest mb-1">Agenda</span>
                                    <span class="text-emerald-700 font-heading font-bold text-center text-sm px-4">
                                        {{ item.schedule || item.month }}
                                    </span>
                                </div>

                                <div class="flex-grow flex flex-col justify-center text-center md:text-left">
                                    <div class="flex flex-col md:flex-row md:items-center gap-3 mb-3">
                                        <h3 class="text-2xl font-heading font-bold text-slate-900 group-hover:text-emerald-700 transition-colors">
                                            {{ item.title }}
                                        </h3>
                                        <Badge v-if="item.status" 
                                               :variant="item.status === 'Selesai' ? 'secondary' : 'default'"
                                               :class="item.status === 'Selesai' ? 'bg-slate-100 text-slate-500' : 'bg-amber-100 text-amber-800 hover:bg-amber-200 border-amber-200'">
                                            {{ item.status }}
                                        </Badge>
                                    </div>
                                    <p class="text-slate-500 text-base leading-relaxed">{{ item.desc }}</p>
                                </div>
                            </div>
                        </div>
                         <div v-else class="text-center py-20 bg-white rounded-3xl border border-dashed border-slate-200">
                            <p class="text-slate-400 font-medium">Belum ada agenda tahunan yang ditambahkan.</p>
                        </div>
                    </TabsContent>

                </Tabs>
            </div>

            <div class="mt-32 text-center bg-emerald-900 rounded-[2.5rem] p-10 md:p-20 max-w-6xl mx-auto text-white shadow-2xl shadow-emerald-900/30 relative overflow-hidden">
                <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-emerald-500 rounded-full blur-3xl opacity-20"></div>
                <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-amber-400 rounded-full blur-3xl opacity-20"></div>
                
                <h2 class="text-3xl md:text-4xl font-heading font-bold mb-6 relative z-10">Tertarik Mengikuti Kegiatan Kami?</h2>
                <p class="text-emerald-100/80 text-lg mb-10 max-w-2xl mx-auto relative z-10 font-light">
                    Sebagian besar program rutin kami terbuka untuk umum bagi seluruh mahasiswa Universitas Malikussaleh. Mari belajar bersama!
                </p>
                
                <div class="flex flex-col sm:flex-row justify-center gap-4 relative z-10">
                    <a v-if="site.register_url" :href="site.register_url" target="_blank">
                        <Button size="lg" class="bg-white text-emerald-900 hover:bg-emerald-50 font-heading font-bold h-14 px-10 rounded-full shadow-xl">
                            Daftar Sekarang
                        </Button>
                    </a>
                    <Link v-else href="/register">
                        <Button size="lg" class="bg-white text-emerald-900 hover:bg-emerald-50 font-heading font-bold h-14 px-10 rounded-full shadow-xl">
                            Daftar Anggota
                        </Button>
                    </Link>
                </div>
            </div>
        </div>
    </PublicLayout>
</template>