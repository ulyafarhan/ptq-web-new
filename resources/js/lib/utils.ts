import { InertiaLinkProps } from '@inertiajs/vue3';
import { clsx, type ClassValue } from 'clsx';
import { twMerge } from 'tailwind-merge';

export function cn(...inputs: ClassValue[]) {
    return twMerge(clsx(inputs));
}

export function urlIsActive(
    urlToCheck: NonNullable<InertiaLinkProps['href']>,
    currentUrl: string,
) {
    return toUrl(urlToCheck) === currentUrl;
}

export function toUrl(href: NonNullable<InertiaLinkProps['href']>) {
    return typeof href === 'string' ? href : href?.url;
}

export function optimizeImage(url: string | null, width = 800, height?: number) {
    // 1. Jika tidak ada URL, pakai placeholder
    if (!url) return '/images/placeholder.svg'; 

    // 2. Pastikan URL awal adalah full URL
    if (url.startsWith('/')) {
        url = `${window.location.origin}${url}`;
    }

    // 3. Buat URL CDN
    // Dokumentasi: https://wsrv.nl/
    const params = new URLSearchParams({
        url: url,           
        w: width.toString(), 
        q: '80',            
        output: 'webp',     
        il: '',             
    });

    if (height) {
        params.append('h', height.toString());
        params.append('fit', 'cover'); 
    }

    return `https://wsrv.nl/?${params.toString()}`;
}