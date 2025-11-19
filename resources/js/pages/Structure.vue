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
import { Separator } from '@/components/ui/separator';
import { Card, CardHeader, CardTitle, CardContent } from '@/components/ui/card';

defineProps({
    teras: Array,      
    divisions: Object, 
});

// Helper Inisial Nama
const getInitials = (name) => name ? name.split(' ').map((n) => n[0]).join('').substring(0, 2).toUpperCase() : 'UKM';
</script>

<template>
    <Head title="Struktur Organisasi" />

    <PublicLayout>
        <div class="min-h-screen bg-slate-50/50 py-12 px-4 sm:px-6 lg:px-8 font-sans">
            
            <div class="max-w-7xl mx-auto mb-16">
                <Breadcrumb class="mb-8 justify-center md:justify-start">
                    <BreadcrumbList>
                        <BreadcrumbItem><BreadcrumbLink :href="route('home')">Beranda</BreadcrumbLink></BreadcrumbItem>
                        <BreadcrumbSeparator />
                        <BreadcrumbItem><BreadcrumbPage>Struktur Organisasi</BreadcrumbPage></BreadcrumbItem>
                    </BreadcrumbList>
                </Breadcrumb>

                <div class="text-center max-w-3xl mx-auto animate-in fade-in slide-in-from-bottom-4 duration-700">
                    <Badge variant="outline" class="mb-4 border-emerald-200 text-emerald-700 bg-emerald-50 px-4 py-1 text-xs font-bold tracking-widest uppercase">
                        Periode 2025 - 2026
                    </Badge>
                    <h1 class="text-4xl md:text-5xl font-heading font-bold text-emerald-950 mb-4 tracking-tight">
                        Fungsionaris UKM PTQ
                    </h1>
                    <p class="text-slate-500 text-lg leading-relaxed">
                        Mengenal lebih dekat para penggerak dakwah Al-Qur'an di Universitas Malikussaleh.
                    </p>
                </div>
            </div>

            <section class="max-w-7xl mx-auto mb-24">
                <div class="flex items-center gap-6 mb-12">
                    <Separator class="flex-1 bg-emerald-200" />
                    <h2 class="text-2xl font-heading font-bold text-emerald-900 text-center uppercase tracking-wider px-4">
                        Pengurus Harian
                    </h2>
                    <Separator class="flex-1 bg-emerald-200" />
                </div>

                <div class="flex flex-wrap justify-center gap-8">
                    
                    <div v-for="person in teras" :key="person.id" 
                         class="flex flex-col bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.12)] border border-slate-200 rounded-2xl w-full max-w-[300px] transition-all duration-300 hover:-translate-y-1 group">
                        
                        <div class="m-3 overflow-hidden rounded-xl h-80 relative bg-slate-100 border border-slate-100">
                            <img v-if="person.photo" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" 
                                 :src="person.photo" 
                                 :alt="person.name" 
                            />
                            <div v-else class="w-full h-full flex flex-col items-center justify-center text-slate-300">
                                <span class="text-4xl font-heading font-bold opacity-50">{{ getInitials(person.name) }}</span>
                            </div>
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        </div>

                        <div class="px-6 pb-6 pt-2 text-center">
                            <h4 class="text-xl font-heading font-bold text-slate-900 leading-tight mb-3 group-hover:text-emerald-600 transition-colors">
                                {{ person.name }}
                            </h4>
                            <div class="inline-block">
                                <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full uppercase tracking-wider border border-emerald-100">
                                    {{ person.position }}
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

            <section class="max-w-7xl mx-auto">
                <div class="flex items-center gap-6 mb-12">
                    <Separator class="flex-1 bg-slate-200" />
                    <h2 class="text-2xl font-heading font-bold text-slate-700 text-center uppercase tracking-wider px-4">
                        Divisi & Departemen
                    </h2>
                    <Separator class="flex-1 bg-slate-200" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-start">
                    <Card v-for="(group, divisionName) in divisions" :key="divisionName" 
                          class="border-slate-200 shadow-sm hover:shadow-lg transition-shadow duration-300 overflow-hidden rounded-2xl">
                        
                        <CardHeader class="bg-slate-50 border-b border-slate-100 pb-4 pt-5">
                            <CardTitle class="flex items-center gap-3 text-slate-800 text-lg font-heading font-bold">
                                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-white border border-slate-200 text-emerald-600 shadow-sm">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                </span>
                                {{ divisionName }}
                            </CardTitle>
                        </CardHeader>

                        <CardContent class="p-0">
                            <div class="divide-y divide-slate-50">
                                <div v-for="member in group.members" :key="member.id" 
                                     class="flex items-center gap-4 p-4 hover:bg-emerald-50/50 transition-colors group/item">
                                    
                                    <div class="h-10 w-10 rounded-lg overflow-hidden bg-slate-100 shrink-0 border border-slate-200 shadow-sm group-hover/item:border-emerald-300 transition-colors">
                                        <img v-if="member.photo" :src="member.photo" class="w-full h-full object-cover">
                                        <div v-else class="w-full h-full flex items-center justify-center text-[10px] font-bold text-slate-400">
                                            {{ getInitials(member.name) }}
                                        </div>
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-slate-800 truncate group-hover/item:text-emerald-700 font-heading">
                                            {{ member.name }}
                                        </p>
                                        <p class="text-xs text-slate-500 truncate font-medium font-sans">
                                            {{ member.position }}
                                        </p>
                                    </div>

                                    <Badge v-if="member.level === 1" variant="outline" class="text-[10px] border-amber-300 bg-amber-50 text-amber-700 h-6 px-2 font-bold rounded-md">
                                        Ketua
                                    </Badge>
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                </div>
                
                <div v-if="Object.keys(divisions).length === 0 && teras.length === 0" class="text-center py-20 bg-white rounded-2xl border border-dashed border-slate-200 mt-10">
                    <p class="text-slate-400 font-medium">Data struktur organisasi belum tersedia.</p>
                </div>
            </section>

        </div>
    </PublicLayout>
</template>