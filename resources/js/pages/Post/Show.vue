<script setup>
import { Head, Link } from '@inertiajs/vue3';
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
import { Button } from '@/components/ui/button';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';

defineProps({
    post: Object,
});

// Helper Initials
const getInitials = (name) => name ? name.split(' ').map((n) => n[0]).join('').substring(0, 2).toUpperCase() : 'A';
</script>

<template>
    <Head :title="post.title" />

    <PublicLayout>
        <article class="min-h-screen bg-slate-50/50 py-12 px-4 sm:px-6 lg:px-8 font-sans">
            
            <div class="max-w-4xl mx-auto mb-12">
                <Breadcrumb class="mb-8">
                    <BreadcrumbList>
                        <BreadcrumbItem><BreadcrumbLink :href="route('home')">Beranda</BreadcrumbLink></BreadcrumbItem>
                        <BreadcrumbSeparator />
                        <BreadcrumbItem><BreadcrumbLink :href="route('posts.index')">Berita</BreadcrumbLink></BreadcrumbItem>
                        <BreadcrumbSeparator />
                        <BreadcrumbItem><BreadcrumbPage class="max-w-[200px] truncate">{{ post.title }}</BreadcrumbPage></BreadcrumbItem>
                    </BreadcrumbList>
                </Breadcrumb>

                <div class="text-center animate-in fade-in slide-in-from-bottom-4 duration-700">
                    <div class="flex items-center justify-center gap-3 mb-6">
                        <Badge variant="outline" class="border-emerald-200 text-emerald-700 bg-emerald-50 px-3 py-1">
                            Berita Terbaru
                        </Badge>
                        <span class="text-slate-300">•</span>
                        <span class="text-slate-500 text-sm font-medium">{{ post.published_at }}</span>
                    </div>
                    
                    <h1 class="text-3xl md:text-5xl lg:text-6xl font-heading font-bold text-slate-900 leading-tight mb-8 tracking-tight">
                        {{ post.title }}
                    </h1>

                    <div class="flex items-center justify-center gap-4">
                        <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-full shadow-sm border border-slate-100">
                            <Avatar class="h-10 w-10 border border-slate-200">
                                <AvatarFallback class="bg-emerald-100 text-emerald-700 font-bold">
                                    {{ getInitials(post.author) }}
                                </AvatarFallback>
                            </Avatar>
                            <div class="text-left">
                                <p class="text-sm font-bold text-slate-900 leading-none">{{ post.author }}</p>
                                <p class="text-xs text-slate-500 mt-0.5">Penulis Konten</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-5xl mx-auto mb-16 animate-in fade-in zoom-in-95 duration-700 delay-150">
                <div class="relative rounded-[2rem] overflow-hidden shadow-2xl shadow-slate-200/50 bg-slate-200 aspect-video">
                    <img v-if="post.cover" :src="post.cover" :alt="post.title" class="w-full h-full object-cover">
                    <div v-else class="w-full h-full flex items-center justify-center text-slate-400">
                        <span class="text-6xl">📰</span>
                    </div>
                </div>
            </div>

            <div class="max-w-3xl mx-auto">
                <div class="prose prose-lg prose-emerald prose-headings:font-heading prose-headings:font-bold prose-p:text-slate-600 prose-p:leading-loose max-w-none bg-white p-8 md:p-12 rounded-3xl shadow-sm border border-slate-100">
                    <div v-html="post.content"></div>
                </div>

                <div class="mt-12 pt-8 border-t border-slate-200 flex flex-col md:flex-row justify-between items-center gap-6">
                    <Button variant="ghost" as-child class="text-slate-600 hover:text-emerald-700 hover:bg-emerald-50 group">
                        <Link :href="route('posts.index')">
                            <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            Kembali ke Daftar Berita
                        </Link>
                    </Button>

                    <div class="flex items-center gap-4">
                        <span class="text-sm font-medium text-slate-500">Bagikan:</span>
                        <div class="flex gap-2">
                            <Button size="icon" variant="outline" class="rounded-full hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </Button>
                            <Button size="icon" variant="outline" class="rounded-full hover:bg-sky-50 hover:text-sky-500 hover:border-sky-200 transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            </Button>
                        </div>
                    </div>
                </div>

            </div>

        </article>
    </PublicLayout>
</template>

<style scoped>
/* Kustomisasi Detail Tipografi Artikel */
:deep(.prose p) {
    margin-bottom: 1.5em;
    line-height: 1.8;
}
:deep(.prose h2) {
    font-family: 'Outfit', sans-serif;
    font-size: 1.75rem;
    margin-top: 2em;
    margin-bottom: 1em;
    color: #064e3b; /* Emerald 900 */
}
:deep(.prose blockquote) {
    border-left-color: #f59e0b; /* Amber 500 */
    font-style: italic;
    color: #334155;
    background: #f8fafc;
    padding: 1.5rem;
    border-radius: 0 1rem 1rem 0;
    margin-top: 2rem;
    margin-bottom: 2rem;
}
:deep(.prose img) {
    border-radius: 1rem;
    box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
    margin-top: 2rem;
    margin-bottom: 2rem;
}
</style>