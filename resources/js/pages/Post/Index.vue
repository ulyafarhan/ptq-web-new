<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';
import { ref, watch } from 'vue';
import { debounce } from 'lodash';

// Shadcn Components
import { Card, CardContent, CardFooter, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';

const props = defineProps({
    posts: Object,
    filters: Object,
});

const search = ref(props.filters.search || '');

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
        <div class="min-h-screen bg-slate-50/50 py-16 px-4 sm:px-6 lg:px-8">
            
            <div class="max-w-2xl mx-auto mb-16 text-center">
                <Badge variant="outline" class="mb-4 border-amber-500 text-amber-600 bg-amber-50">Arsip Kegiatan</Badge>
                <h1 class="text-4xl font-bold text-emerald-900 font-serif mb-4">Warta UKM PTQ</h1>
                <p class="text-slate-500 mb-8">Ikuti perkembangan terkini syiar Islam di kampus kami.</p>
                
                <div class="relative max-w-md mx-auto">
                    <div class="absolute left-3 top-2.5 text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <Input 
                        v-model="search" 
                        type="text" 
                        placeholder="Cari judul berita..." 
                        class="pl-10 rounded-full border-slate-300 focus-visible:ring-emerald-500 h-12 shadow-sm bg-white"
                    />
                </div>
            </div>

            <div class="max-w-7xl mx-auto">
                <div v-if="posts.data.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    
                    <Card v-for="post in posts.data" :key="post.id" class="group hover:shadow-lg transition-all duration-300 border-slate-200 overflow-hidden flex flex-col h-full">
                        
                        <div class="h-52 bg-slate-100 overflow-hidden relative">
                            <img v-if="post.cover" :src="post.cover" :alt="post.title" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            <div v-else class="w-full h-full flex items-center justify-center text-slate-400 bg-slate-50">
                                <svg class="w-12 h-12 opacity-20" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-5-7l-3 3.72L9 13l-3 4h12l-4-5z"/></svg>
                            </div>
                            <Badge class="absolute top-4 right-4 bg-white/90 text-emerald-700 hover:bg-white shadow-sm backdrop-blur-sm">
                                {{ post.published_at }}
                            </Badge>
                        </div>

                        <CardHeader class="pb-2">
                            <CardTitle class="text-xl leading-tight font-bold text-slate-800 group-hover:text-emerald-700 transition-colors line-clamp-2">
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

                        <CardFooter class="pt-0">
                            <Button variant="ghost" as-child class="p-0 h-auto text-emerald-600 hover:text-emerald-800 hover:bg-transparent font-semibold group/btn">
                                <Link :href="route('post.show', post.slug)" class="flex items-center">
                                    Baca Selengkapnya 
                                    <svg class="w-4 h-4 ml-2 transition-transform group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </Link>
                            </Button>
                        </CardFooter>

                    </Card>

                </div>

                <div v-else class="text-center py-24 bg-white rounded-xl border border-dashed border-slate-300">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-medium text-slate-900">Tidak ditemukan</h3>
                    <p class="text-slate-500 mt-1">Coba kata kunci lain atau reset pencarian.</p>
                    <Button variant="link" @click="search = ''" class="mt-4 text-emerald-600">Reset Pencarian</Button>
                </div>

                <div v-if="posts.links.length > 3" class="mt-16 flex justify-center flex-wrap gap-2">
                    <template v-for="(link, k) in posts.links" :key="k">
                        <Link 
                            v-if="link.url"
                            :href="link.url"
                            v-html="link.label"
                            class="h-10 px-4 py-2 inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50"
                            :class="link.active ? 'bg-emerald-600 text-white hover:bg-emerald-700' : 'border border-input bg-background hover:bg-accent hover:text-accent-foreground'"
                        />
                        <span v-else v-html="link.label" class="h-10 px-4 py-2 inline-flex items-center justify-center text-sm text-slate-400 opacity-50 cursor-not-allowed"></span>
                    </template>
                </div>
            </div>

        </div>
    </PublicLayout>
</template>