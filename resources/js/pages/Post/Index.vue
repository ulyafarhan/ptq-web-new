<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';
import { ref, watch } from 'vue';
import { debounce } from 'lodash';

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
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Separator } from '@/components/ui/separator';

const props = defineProps({
    posts: Object, // Object Pagination dari Laravel
    filters: Object,
});

// State untuk Search Bar
const search = ref(props.filters.search || '');

// Logika pencarian otomatis (tunggu 500ms setelah mengetik)
watch(search, debounce((value) => {
    router.get(route('posts.index'), { search: value }, {
        preserveState: true,
        replace: true,
    });
}, 500));
</script>

<template>
    <Head title="Kabar Berita" />

    <PublicLayout>
        <div class="min-h-screen bg-slate-50/50 py-12 px-4 sm:px-6 lg:px-8 font-sans">
            
            <div class="max-w-7xl mx-auto mb-16">
                <Breadcrumb class="mb-8 justify-center md:justify-start">
                    <BreadcrumbList>
                        <BreadcrumbItem><BreadcrumbLink :href="route('home')">Beranda</BreadcrumbLink></BreadcrumbItem>
                        <BreadcrumbSeparator />
                        <BreadcrumbItem><BreadcrumbPage>Arsip Berita</BreadcrumbPage></BreadcrumbItem>
                    </BreadcrumbList>
                </Breadcrumb>

                <div class="flex flex-col md:flex-row justify-between items-end gap-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
                    <div class="text-center md:text-left max-w-2xl">
                        <Badge variant="outline" class="mb-4 border-emerald-200 text-emerald-700 bg-emerald-50 px-4 py-1 text-xs font-bold tracking-widest uppercase">
                            Warta UKM
                        </Badge>
                        <h1 class="text-4xl md:text-5xl font-heading font-bold text-emerald-950 mb-4 tracking-tight">
                            Kabar & Kegiatan Terkini
                        </h1>
                        <p class="text-slate-500 text-lg font-light leading-relaxed">
                            Ikuti perkembangan terbaru syiar Islam dan prestasi mahasiswa di lingkungan Universitas Malikussaleh.
                        </p>
                    </div>

                    <div class="w-full md:w-96 relative group">
                        <div class="absolute left-4 top-3.5 text-slate-400 group-focus-within:text-emerald-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <Input 
                            v-model="search" 
                            type="text" 
                            placeholder="Cari judul berita..." 
                            class="pl-12 h-12 rounded-full border-slate-200 bg-white focus:border-emerald-500 focus:ring-emerald-200 shadow-sm transition-all hover:border-emerald-300"
                        />
                    </div>
                </div>
                
                <Separator class="mt-12 bg-slate-200" />
            </div>

            <div class="max-w-7xl mx-auto">
                <div v-if="posts.data.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    
                    <Card v-for="post in posts.data" :key="post.id" 
                          class="group flex flex-col h-full bg-white border-slate-200 shadow-[0_2px_10px_rgb(0,0,0,0.05)] hover:shadow-[0_15px_30px_rgb(0,0,0,0.1)] hover:-translate-y-1 transition-all duration-300 rounded-3xl overflow-hidden">
                        
                        <div class="h-56 bg-slate-100 overflow-hidden relative">
                            <img v-if="post.cover" :src="post.cover" :alt="post.title" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 group-hover:saturate-105">
                            <div v-else class="w-full h-full flex items-center justify-center bg-emerald-50 text-emerald-200">
                                <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-5-7l-3 3.72L9 13l-3 4h12l-4-5z"/></svg>
                            </div>
                            
                            <div class="absolute top-4 left-4">
                                <Badge class="bg-white/90 backdrop-blur text-slate-800 hover:bg-white shadow-sm border-none px-3 py-1 text-xs font-bold font-sans">
                                    {{ post.published_at }}
                                </Badge>
                            </div>
                        </div>
                        
                        <div class="flex flex-col flex-grow p-8 pt-6">
                            <CardHeader class="p-0 mb-4">
                                <CardTitle class="text-xl font-heading font-bold text-slate-900 leading-tight line-clamp-2 group-hover:text-emerald-700 transition-colors">
                                    <Link :href="route('post.show', post.slug)">
                                        {{ post.title }}
                                    </Link>
                                </CardTitle>
                            </CardHeader>
                            
                            <CardContent class="p-0 flex-grow">
                                <p class="text-slate-500 text-sm leading-relaxed line-clamp-3 font-sans">
                                    {{ post.excerpt }}
                                </p>
                            </CardContent>

                            <CardFooter class="p-0 pt-6 mt-auto border-t border-slate-50">
                                <Button variant="link" as-child class="p-0 h-auto text-emerald-600 font-bold hover:text-emerald-800 hover:no-underline group/btn">
                                    <Link :href="route('post.show', post.slug)" class="flex items-center">
                                        Baca Selengkapnya 
                                        <svg class="w-4 h-4 ml-1 transition-transform group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                    </Link>
                                </Button>
                            </CardFooter>
                        </div>
                    </Card>
                </div>

                <div v-else class="text-center py-32 bg-white rounded-3xl border border-dashed border-slate-200">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-50 mb-6">
                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-heading font-bold text-slate-900 mb-2">Tidak Ditemukan</h3>
                    <p class="text-slate-500 text-lg">Maaf, tidak ada berita yang cocok dengan pencarian Anda.</p>
                    <Button variant="outline" @click="search = ''" class="mt-6 rounded-full border-emerald-200 text-emerald-700 hover:bg-emerald-50 hover:text-emerald-800 hover:border-emerald-300">
                        Reset Pencarian
                    </Button>
                </div>

                <div v-if="posts.links.length > 3" class="mt-20 flex justify-center">
                    <div class="flex flex-wrap gap-2 items-center bg-white p-2 rounded-full shadow-sm border border-slate-100">
                        <template v-for="(link, k) in posts.links" :key="k">
                            <Link 
                                v-if="link.url"
                                :href="link.url"
                                v-html="link.label"
                                class="w-10 h-10 flex items-center justify-center rounded-full text-sm font-bold transition-all"
                                :class="link.active 
                                    ? 'bg-emerald-600 text-white shadow-md scale-105' 
                                    : 'text-slate-600 hover:bg-slate-100 hover:text-emerald-700'"
                            />
                            <span v-else v-html="link.label" class="w-10 h-10 flex items-center justify-center text-slate-300 font-medium text-sm"></span>
                        </template>
                    </div>
                </div>

            </div>
        </div>
    </PublicLayout>
</template>