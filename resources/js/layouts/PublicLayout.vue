<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

// Import Shadcn Components
import { Button } from '@/components/ui/button';
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuTrigger,
  DropdownMenuLabel,
  DropdownMenuSeparator,
} from '@/components/ui/dropdown-menu';
import {
  Sheet,
  SheetContent,
  SheetHeader,
  SheetTitle,
  SheetTrigger,
} from '@/components/ui/sheet';
import { Separator } from '@/components/ui/separator';

// --- AKSES SHARED PROPS ---
const page = usePage();
// Helper untuk akses data site lebih singkat
const site = page.props.site; 

const navLinks = [
    { label: 'Beranda', route: 'home', active: 'home' },
    { label: 'Berita', route: 'posts.index', active: 'posts.*' },
];

const profileLinks = [
    { label: 'Struktur Organisasi', route: 'structure' },
    { label: 'Sejarah & Visi Misi', route: 'profile.history' },
    { label: 'Program Kerja', route: 'profile.programs' },
];

const isMobileOpen = ref(false);
</script>

<template>
    <div class="flex flex-col min-h-screen bg-slate-50 font-sans text-slate-800 selection:bg-emerald-100 selection:text-emerald-900">
        
        <header class="sticky top-0 z-50 w-full border-b border-slate-200 bg-white/80 backdrop-blur-xl transition-all supports-[backdrop-filter]:bg-white/60">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    
                    <Link :href="route('home')" class="flex items-center gap-3 group">
                        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-600 text-white shadow-lg shadow-emerald-200 group-hover:scale-105 transition-transform duration-300">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-lg font-heading font-bold leading-none text-slate-900 tracking-tight">UKM PTQ</span>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Unimal</span>
                        </div>
                    </Link>

                    <nav class="hidden md:flex items-center gap-2">
                        <template v-for="link in navLinks" :key="link.route">
                            <Link :href="route(link.route)">
                                <Button variant="ghost" 
                                    :class="['text-sm font-medium px-4 py-2 rounded-full hover:bg-emerald-50 hover:text-emerald-700 transition-colors', 
                                    route().current(link.active) ? 'bg-emerald-50 text-emerald-700 font-semibold' : 'text-slate-600']">
                                    {{ link.label }}
                                </Button>
                            </Link>
                        </template>

                        <DropdownMenu>
                            <DropdownMenuTrigger as-child>
                                <Button variant="ghost" class="group text-slate-600 hover:text-emerald-700 hover:bg-emerald-50 px-4 rounded-full data-[state=open]:bg-emerald-50 data-[state=open]:text-emerald-700">
                                    Profil UKM
                                    <svg class="ml-2 h-4 w-4 transition-transform duration-200 group-data-[state=open]:rotate-180 opacity-50 group-hover:opacity-100" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                </Button>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent align="center" class="w-56 p-2 rounded-xl shadow-xl border-slate-100/50 bg-white/90 backdrop-blur-md animate-in fade-in-0 zoom-in-95">
                                <DropdownMenuLabel class="text-xs font-bold text-slate-400 uppercase tracking-wider px-2 py-1.5">
                                    Tentang Kami
                                </DropdownMenuLabel>
                                <DropdownMenuSeparator class="bg-slate-100" />
                                <DropdownMenuItem v-for="item in profileLinks" :key="item.label" as-child class="focus:bg-emerald-50 focus:text-emerald-700 rounded-lg cursor-pointer">
                                    <Link :href="route(item.route)" class="w-full flex items-center px-2 py-2.5 text-sm font-medium text-slate-700">
                                        {{ item.label }}
                                    </Link>
                                </DropdownMenuItem>
                            </DropdownMenuContent>
                        </DropdownMenu>
                    </nav>

                    <div class="hidden md:flex items-center gap-4">
                        <div class="h-6 w-px bg-slate-200/60"></div>
                        <Link href="/admin/login" class="text-sm font-medium text-slate-500 hover:text-emerald-700 transition-colors">
                            Masuk
                        </Link>
                        
                        <a v-if="site.register_url" :href="site.register_url" target="_blank">
                            <Button class="bg-emerald-600 hover:bg-emerald-700 text-white rounded-full px-6 shadow-lg shadow-emerald-200 hover:shadow-emerald-300 transition-all hover:-translate-y-0.5">
                                Gabung
                            </Button>
                        </a>
                        <Link v-else href="/register">
                            <Button class="bg-emerald-600 hover:bg-emerald-700 text-white rounded-full px-6 shadow-lg shadow-emerald-200 hover:shadow-emerald-300 transition-all hover:-translate-y-0.5">
                                Gabung
                            </Button>
                        </Link>
                    </div>

                    <div class="md:hidden">
                        <Sheet v-model:open="isMobileOpen">
                            <SheetTrigger as-child>
                                <Button variant="ghost" size="icon" class="text-slate-600 hover:bg-slate-100 rounded-full">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                                </Button>
                            </SheetTrigger>
                            <SheetContent side="right" class="w-[300px] bg-white/95 backdrop-blur-xl border-l border-slate-200 p-0">
                                <SheetHeader class="text-left border-b border-slate-100 p-6">
                                    <SheetTitle class="text-emerald-900 font-heading font-bold flex items-center gap-3 text-xl">
                                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-600 text-white shadow-md">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                        Menu
                                    </SheetTitle>
                                </SheetHeader>
                                
                                <div class="flex flex-col p-4 space-y-2">
                                    <Link v-for="link in navLinks" :key="link.route" 
                                          :href="route(link.route)"
                                          @click="isMobileOpen = false"
                                          :class="['px-4 py-3.5 rounded-xl text-base font-medium transition-all flex items-center', route().current(link.active) ? 'bg-emerald-50 text-emerald-700 font-semibold shadow-sm' : 'text-slate-600 hover:bg-slate-50']">
                                          <span class="w-2 h-2 rounded-full mr-3" :class="route().current(link.active) ? 'bg-emerald-500' : 'bg-slate-300'"></span>
                                          {{ link.label }}
                                    </Link>
                                    <div class="pt-6 pb-2">
                                        <p class="px-4 text-xs font-bold uppercase text-slate-400 tracking-widest mb-3">Profil UKM</p>
                                        <div class="space-y-1">
                                            <Link v-for="item in profileLinks" :key="item.label" 
                                                  :href="route(item.route)"
                                                  @click="isMobileOpen = false"
                                                  class="block px-4 py-3 rounded-xl text-sm text-slate-600 hover:text-emerald-700 hover:bg-emerald-50/50 transition-colors border-l-2 border-transparent hover:border-emerald-200 ml-2">
                                                {{ item.label }}
                                            </Link>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-auto border-t border-slate-100 p-6 bg-slate-50/50 absolute bottom-0 w-full">
                                    <a v-if="site.register_url" :href="site.register_url" target="_blank">
                                        <Button class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold h-12 rounded-xl shadow-lg shadow-emerald-200">
                                            Daftar Anggota
                                        </Button>
                                    </a>
                                    <Link v-else href="/register">
                                         <Button class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold h-12 rounded-xl shadow-lg shadow-emerald-200">
                                            Daftar Anggota
                                        </Button>
                                    </Link>
                                    <div class="mt-4 text-center">
                                        <Link href="/admin" class="text-sm text-slate-500 hover:text-emerald-700 font-medium transition-colors">Login Pengurus</Link>
                                    </div>
                                </div>
                            </SheetContent>
                        </Sheet>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-grow relative z-0">
            <slot />
        </main>

        <footer class="bg-white border-t border-slate-100 pt-16 pb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-12">
                    
                    <div class="md:col-span-5 space-y-6">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center shadow-lg shadow-emerald-100">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-heading font-bold text-slate-900">UKM PTQ Unimal</h3>
                                <p class="text-xs text-emerald-600 font-bold uppercase tracking-widest">Generasi Qur'ani</p>
                            </div>
                        </div>
                        <p class="text-slate-500 leading-relaxed text-sm max-w-sm">
                           {{ site.hero_desc || "Wadah pengembangan minat dan bakat mahasiswa dalam seni baca Al-Qur'an, tahsin, dan kajian keislaman yang moderat dan berprestasi." }}
                        </p>
                        <div class="flex gap-4">
                            <a v-if="site.contact.instagram && site.contact.instagram !== '#'" :href="'https://'+site.contact.instagram" target="_blank" class="h-10 w-10 rounded-full bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-400 hover:text-pink-600 hover:border-pink-200 transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            </a>
                            <a v-if="site.contact.facebook && site.contact.facebook !== '#'" :href="'https://'+site.contact.facebook" target="_blank" class="h-10 w-10 rounded-full bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-400 hover:text-blue-600 hover:border-blue-200 transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                        </div>
                    </div>

                    <div class="md:col-span-3">
                        <h4 class="font-heading font-bold text-slate-900 mb-6">Jelajahi</h4>
                        <ul class="space-y-3 text-sm text-slate-500">
                            <li><Link :href="route('home')" class="hover:text-emerald-600 transition-colors">Beranda Utama</Link></li>
                            <li><Link :href="route('posts.index')" class="hover:text-emerald-600 transition-colors">Kabar Berita</Link></li>
                            <li><Link :href="route('structure')" class="hover:text-emerald-600 transition-colors">Profil Pengurus</Link></li>
                            <li><Link :href="route('profile.programs')" class="hover:text-emerald-600 transition-colors">Program Kerja</Link></li>
                        </ul>
                    </div>

                    <div class="md:col-span-4">
                        <h4 class="font-heading font-bold text-slate-900 mb-6">Hubungi Kami</h4>
                        <ul class="space-y-4 text-sm text-slate-500">
                            <li class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600 shrink-0 mt-0.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <span>{{ site.contact.address }}</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600 shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 00-2-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <a :href="`mailto:${site.contact.email}`">{{ site.contact.email }}</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-slate-100 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-slate-400 font-medium">
                    <p>&copy; {{ new Date().getFullYear() }} UKM PTQ Universitas Malikussaleh.</p>
                    <div class="flex gap-6">
                        <a href="#" class="hover:text-emerald-600 transition-colors">Privacy Policy</a>
                        <a href="#" class="hover:text-emerald-600 transition-colors">Terms of Service</a>
                    </div>
                </div>
            </div>
        </footer>

    </div>
</template>