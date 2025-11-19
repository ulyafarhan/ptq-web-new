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
  SheetClose, // Penting untuk menutup menu mobile saat klik link
} from '@/components/ui/sheet';
import { Separator } from '@/components/ui/separator';

// Icon Panah Bawah (Chevron Down)
import { ChevronDown } from 'lucide-vue-next'; // Pastikan lucide-vue-next terinstall, atau pakai SVG manual di bawah

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
        
        <header class="sticky top-0 z-50 w-full border-b border-slate-200 bg-white/90 backdrop-blur-md transition-all">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    
                    <Link :href="route('home')" class="flex items-center gap-3 group">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-700 text-white shadow-md group-hover:bg-emerald-800 transition">
                            <span class="font-bold text-lg">P</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-lg font-bold leading-none text-emerald-950">UKM PTQ</span>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Unimal</span>
                        </div>
                    </Link>

                    <nav class="hidden md:flex items-center gap-1">
                        
                        <template v-for="link in navLinks" :key="link.route">
                            <Link :href="route(link.route)">
                                <Button variant="ghost" 
                                    :class="['text-sm font-medium px-4 py-2 rounded-md hover:bg-emerald-50 hover:text-emerald-700 transition-colors', 
                                    route().current(link.active) ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-slate-600']">
                                    {{ link.label }}
                                </Button>
                            </Link>
                        </template>

                        <DropdownMenu>
                            <DropdownMenuTrigger as-child>
                                <Button variant="ghost" class="group text-slate-600 hover:text-emerald-700 hover:bg-emerald-50 px-4">
                                    Profil UKM
                                    <svg class="ml-2 h-4 w-4 transition-transform duration-200 group-data-[state=open]:rotate-180" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                </Button>
                            </DropdownMenuTrigger>
                            
                            <DropdownMenuContent align="end" class="w-56 bg-white border border-slate-200 shadow-lg rounded-xl p-2 animate-in fade-in-0 zoom-in-95">
                                <DropdownMenuLabel class="text-xs font-bold text-slate-400 uppercase tracking-wider px-2 py-1.5">
                                    Tentang Kami
                                </DropdownMenuLabel>
                                <DropdownMenuSeparator class="bg-slate-100" />
                                
                                <DropdownMenuItem v-for="item in profileLinks" :key="item.label" as-child>
                                    <Link :href="item.route ? route(item.route) : '#'" 
                                          class="w-full cursor-pointer rounded-md px-2 py-2.5 text-sm font-medium text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 focus:bg-emerald-50 focus:text-emerald-700">
                                        {{ item.label }}
                                    </Link>
                                </DropdownMenuItem>
                            </DropdownMenuContent>
                        </DropdownMenu>

                    </nav>

                    <div class="hidden md:flex items-center gap-3">
                        <div class="h-5 w-px bg-slate-200"></div>
                        <Button variant="ghost" as-child class="text-slate-600 hover:text-emerald-700">
                            <Link href="/admin/login">Masuk</Link>
                        </Button>
                        <Button as-child class="bg-emerald-600 hover:bg-emerald-700 text-white rounded-full px-6 shadow-sm shadow-emerald-200">
                            <Link href="/register">Gabung</Link>
                        </Button>
                    </div>

                    <div class="md:hidden">
                        <Sheet v-model:open="isMobileOpen">
                            <SheetTrigger as-child>
                                <Button variant="ghost" size="icon" class="text-slate-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                                </Button>
                            </SheetTrigger>
                            <SheetContent side="right" class="w-[300px] bg-white">
                                <SheetHeader class="text-left border-b border-slate-100 pb-4 mb-4">
                                    <SheetTitle class="text-emerald-800 font-bold flex items-center gap-2">
                                        <div class="w-2 h-6 bg-emerald-600 rounded-full"></div>
                                        Menu Navigasi
                                    </SheetTitle>
                                </SheetHeader>
                                
                                <div class="flex flex-col space-y-1">
                                    <Link v-for="link in navLinks" :key="link.route" 
                                          :href="route(link.route)"
                                          @click="isMobileOpen = false"
                                          :class="['px-4 py-3 rounded-lg text-sm font-medium transition-colors flex items-center', route().current(link.active) ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50']">
                                          <span class="w-1.5 h-1.5 rounded-full mr-3" :class="route().current(link.active) ? 'bg-emerald-500' : 'bg-slate-300'"></span>
                                          {{ link.label }}
                                    </Link>

                                    <div class="pt-4 pb-2">
                                        <p class="px-4 text-xs font-bold uppercase text-emerald-600/70 tracking-wider mb-2">Profil UKM</p>
                                        <div class="space-y-1 border-l-2 border-slate-100 ml-4 pl-2">
                                            <Link v-for="item in profileLinks" :key="item.label" 
                                                  :href="item.route ? route(item.route) : '#'"
                                                  @click="isMobileOpen = false"
                                                  class="block px-4 py-2.5 rounded-md text-sm text-slate-600 hover:text-emerald-700 hover:bg-emerald-50">
                                                {{ item.label }}
                                            </Link>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-auto border-t border-slate-100 pt-6 absolute bottom-8 left-6 right-6">
                                    <Button class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold" as-child>
                                        <Link href="/register">Daftar Anggota</Link>
                                    </Button>
                                    <div class="mt-4 text-center">
                                        <Link href="/admin" class="text-xs text-slate-400 hover:text-emerald-600">Login Pengurus</Link>
                                    </div>
                                </div>
                            </SheetContent>
                        </Sheet>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-grow">
            <slot />
        </main>

        <footer class="bg-slate-900 border-t border-slate-800 text-slate-400 py-12 text-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-2">
                    <div class="h-8 w-8 bg-emerald-700 text-white flex items-center justify-center rounded font-bold">P</div>
                    <span class="text-slate-200 font-semibold">UKM PTQ Unimal</span>
                </div>
                <p>&copy; {{ new Date().getFullYear() }} Hak Cipta Dilindungi.</p>
            </div>
        </footer>

    </div>
</template>