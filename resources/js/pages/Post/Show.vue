<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';

// Import Komponen Shadcn UI
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Separator } from '@/components/ui/separator';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import {
  Breadcrumb,
  BreadcrumbItem,
  BreadcrumbLink,
  BreadcrumbList,
  BreadcrumbPage,
  BreadcrumbSeparator,
} from '@/components/ui/breadcrumb';
import { Card, CardContent } from '@/components/ui/card';

defineProps({
    post: Object,
});

// Helper untuk inisial nama (misal: "Farhan Lubis" -> "FL")
const getInitials = (name) => name.split(' ').map((n) => n[0]).join('').substring(0, 2).toUpperCase();
</script>

<template>
    <Head :title="post.title" />

    <PublicLayout>
        <div class="min-h-screen bg-slate-50/50 pt-10 pb-20 font-sans">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="mb-8">
                    <Breadcrumb>
                        <BreadcrumbList>
                            <BreadcrumbItem>
                                <BreadcrumbLink :href="route('home')">Beranda</BreadcrumbLink>
                            </BreadcrumbItem>
                            <BreadcrumbSeparator />
                            <BreadcrumbItem>
                                <BreadcrumbLink :href="route('posts.index')">Berita</BreadcrumbLink>
                            </BreadcrumbItem>
                            <BreadcrumbSeparator />
                            <BreadcrumbItem>
                                <BreadcrumbPage class="text-emerald-600 font-medium max-w-[200px] truncate">
                                    {{ post.title }}
                                </BreadcrumbPage>
                            </BreadcrumbItem>
                        </BreadcrumbList>
                    </Breadcrumb>
                </div>

                <div class="text-center mb-10 space-y-6">
                    <div class="flex items-center justify-center gap-2 animate-fade-in-up">
                        <Badge variant="outline" class="border-emerald-200 text-emerald-700 bg-emerald-50">
                            Berita Terbaru
                        </Badge>
                        <span class="text-xs text-slate-400">•</span>
                        <span class="text-sm text-slate-500">{{ post.published_at }}</span>
                    </div>

                    <h1 class="text-3xl md:text-5xl font-bold text-slate-900 tracking-tight leading-tight font-serif">
                        {{ post.title }}
                    </h1>

                    <div class="flex items-center justify-center gap-3">
                        <Avatar class="h-10 w-10 border-2 border-white shadow-sm">
                            <AvatarImage src="" /> 
                            <AvatarFallback class="bg-emerald-100 text-emerald-700 font-bold">
                                {{ getInitials(post.author) }}
                            </AvatarFallback>
                        </Avatar>
                        <div class="text-left">
                            <p class="text-sm font-semibold text-slate-900">{{ post.author }}</p>
                            <p class="text-xs text-slate-500">Penulis Konten</p>
                        </div>
                    </div>
                </div>

                <Card class="mb-12 overflow-hidden border-none shadow-xl shadow-slate-200/60 rounded-2xl">
                    <div v-if="post.cover" class="aspect-video w-full bg-slate-100 relative">
                         <img :src="post.cover" :alt="post.title" class="w-full h-full object-cover">
                    </div>
                </Card>

                <div class="prose prose-lg prose-emerald mx-auto text-slate-700 leading-relaxed mb-12 first-letter:text-5xl first-letter:font-bold first-letter:text-emerald-700 first-letter:mr-2 first-letter:float-left">
                    <div v-html="post.content"></div>
                </div>

                <Separator class="my-10" />

                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <Button variant="outline" as-child class="group border-slate-300 hover:border-emerald-500 hover:text-emerald-700">
                        <Link :href="route('posts.index')">
                            <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            Kembali ke Daftar Berita
                        </Link>
                    </Button>

                    <div class="flex gap-2">
                        <span class="text-sm text-slate-500 self-center mr-2">Bagikan:</span>
                        <Button size="icon" variant="secondary" class="rounded-full hover:bg-blue-100 hover:text-blue-600 transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </Button>
                        <Button size="icon" variant="secondary" class="rounded-full hover:bg-sky-100 hover:text-sky-500 transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </Button>
                    </div>
                </div>

            </div>
        </div>
    </PublicLayout>
</template>

<style scoped>
/* Kustomisasi Tipografi Agar Lebih Enak Dibaca */
:deep(.prose h2) {
    @apply text-2xl font-bold text-emerald-800 mt-8 mb-4 border-l-4 border-emerald-500 pl-4;
}
:deep(.prose p) {
    @apply mb-5 text-slate-600 leading-8 text-[1.05rem];
}
:deep(.prose blockquote) {
    @apply font-serif italic text-xl text-slate-700 bg-slate-50 p-6 rounded-r-lg border-l-4 border-amber-400 not-italic;
}
</style>