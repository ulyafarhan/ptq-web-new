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
    teras: Array,      // Array Pengurus Inti
    divisions: Object, // Object Grouping Divisi
});

// Helper Inisial Nama
const getInitials = (name) => name ? name.split(' ').map((n) => n[0]).join('').substring(0, 2).toUpperCase() : 'UKM';
</script>

<template>
    <Head title="Struktur Organisasi" />

    <PublicLayout>
        <div class="min-h-screen bg-slate-50/50 py-12 px-4 sm:px-6 lg:px-8 font-sans">
            
            <div class="max-w-7xl mx-auto mb-20">
                <Breadcrumb class="mb-8 justify-center md:justify-start">
                    <BreadcrumbList>
                        <BreadcrumbItem><BreadcrumbLink :href="route('home')">Beranda</BreadcrumbLink></BreadcrumbItem>
                        <BreadcrumbSeparator />
                        <BreadcrumbItem><BreadcrumbPage>Struktur Organisasi</BreadcrumbPage></BreadcrumbItem>
                    </BreadcrumbList>
                </Breadcrumb>

                <div class="text-center max-w-3xl mx-auto animate-in fade-in slide-in-from-bottom-4 duration-700">
                    <Badge variant="outline" class="mb-4 border-emerald-200 text-emerald-800 bg-emerald-50 px-4 py-1 text-xs font-bold tracking-widest uppercase">
                        Periode Kepengurusan 2025 - 2026
                    </Badge>
                    <h1 class="text-4xl md:text-6xl font-bold text-emerald-950 font-serif mb-6 tracking-tight leading-tight">
                        Fungsionaris UKM PTQ
                    </h1>
                    <p class="text-slate-500 text-lg md:text-xl font-light leading-relaxed">
                        Para penggerak dakwah Al-Qur'an yang berdedikasi di Universitas Malikussaleh.
                    </p>
                </div>
            </div>

            <section class="max-w-7xl mx-auto mb-28">
                <div class="flex items-center gap-6 mb-16">
                    <Separator class="flex-1 bg-emerald-200 h-[1px]" />
                    <h2 class="text-2xl md:text-3xl font-bold text-emerald-900 font-serif text-center tracking-wide">
                        Pengurus Harian
                    </h2>
                    <Separator class="flex-1 bg-emerald-200 h-[1px]" />
                </div>

                <div class="flex flex-wrap justify-center gap-10">
                    
                    <div v-for="person in teras" :key="person.id" 
                         class="flex flex-col bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-slate-100 rounded-2xl w-full max-w-[300px] transition-all duration-300 hover:-translate-y-2 hover:shadow-xl group overflow-hidden">
                        
                        <div class="p-3 pb-0">
                            <div class="overflow-hidden rounded-xl h-80 relative bg-slate-100">
                                <img v-if="person.photo" 
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 saturate-[0.95] group-hover:saturate-100" 
                                     :src="person.photo" 
                                     :alt="person.name" 
                                />
                                <div v-else class="w-full h-full flex flex-col items-center justify-center text-slate-300">
                                    <span class="text-4xl font-serif font-bold">{{ getInitials(person.name) }}</span>
                                </div>
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-emerald-900/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            </div>
                        </div>

                        <div class="px-6 py-6 text-center">
                            <h4 class="text-xl font-bold text-slate-900 font-serif leading-snug mb-1 group-hover:text-emerald-700 transition-colors">
                                {{ person.name }}
                            </h4>
                            <p class="text-xs font-bold text-emerald-600 uppercase tracking-widest mb-4">
                                {{ person.position }}
                            </p>
                            <div class="w-8 h-1 bg-amber-400 mx-auto rounded-full opacity-50 group-hover:w-16 group-hover:opacity-100 transition-all duration-300"></div>
                        </div>
                    </div>

                </div>
            </section>

            <section class="max-w-7xl mx-auto">
                <div class="flex items-center gap-6 mb-16">
                    <Separator class="flex-1 bg-slate-200" />
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-700 font-serif text-center tracking-wide">
                        Divisi & Departemen
                    </h2>
                    <Separator class="flex-1 bg-slate-200" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-start">
                    <Card v-for="(group, divisionName) in divisions" :key="divisionName" 
                          class="border-slate-200/60 shadow-sm hover:shadow-lg hover:border-emerald-100 transition-all duration-300">
                        
                        <CardHeader class="bg-slate-50/50 border-b border-slate-100 pb-4 pt-5">
                            <CardTitle class="flex items-center gap-3 text-emerald-950 text-lg font-bold tracking-tight">
                                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-white border border-slate-200 text-emerald-600 shadow-sm">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                </span>
                                {{ divisionName }}
                            </CardTitle>
                        </CardHeader>

                        <CardContent class="p-0">
                            <div class="divide-y divide-slate-100">
                                <div v-for="member in group.members" :key="member.id" 
                                     class="flex items-center gap-4 p-4 hover:bg-emerald-50/30 transition-colors group/item">
                                    
                                    <div class="h-11 w-11 rounded-[10px] overflow-hidden bg-slate-100 shrink-0 border border-slate-200 group-hover/item:border-emerald-300 transition-colors shadow-sm">
                                        <img v-if="member.photo" :src="member.photo" class="w-full h-full object-cover">
                                        <div v-else class="w-full h-full flex items-center justify-center text-[10px] font-bold text-slate-400">
                                            {{ getInitials(member.name) }}
                                        </div>
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-slate-800 truncate group-hover/item:text-emerald-800 font-heading">
                                            {{ member.name }}
                                        </p>
                                        <p class="text-xs text-slate-500 truncate font-medium">
                                            {{ member.position }}
                                        </p>
                                    </div>

                                    <Badge v-if="member.level === 1" variant="outline" class="text-[10px] border-amber-300 bg-amber-50 text-amber-700 h-6 px-2 font-bold">
                                        KOORD
                                    </Badge>
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                </div>
                
                <div v-if="Object.keys(divisions).length === 0 && teras.length === 0" class="text-center py-20">
                    <p class="text-slate-400 italic font-serif">Belum ada data pengurus.</p>
                </div>
            </section>

        </div>
    </PublicLayout>
</template>

<style scoped>
/* Utility tambahan agar font heading lebih tajam */
.font-heading {
    font-family: 'Plus Jakarta Sans', sans-serif;
}
</style>