module.exports = {
    apps: [
        // APLIKASI UTAMA (WEB SERVER)
        {
            name: "ptq-web-laravel",
            script: "artisan",
            interpreter: "php",
            args: ["serve", "--host=0.0.0.0"], // Dijalankan oleh Nginx/Apache untuk memproses PHP
            instances: 1, // Cukup satu instance untuk Laravel
            autorestart: true,
            watch: false,
            max_memory_restart: '256M',
            env: {
                NODE_ENV: "production",
            }
        },

        // SSR INERTIA (NODE.JS SERVER)
        {
            name: "ptq-web-ssr",
            script: "node",
            args: ["./vendor/inertiajs/inertia-laravel/scripts/ssr.js"],
            instances: 1, // Cukup satu instance untuk SSR
            exec_mode: "fork",
            autorestart: true,
            watch: false,
            max_memory_restart: '256M',
            env: {
                NODE_ENV: "production",
                VITE_APP_NAME: "UKM PTQ Unimal SSR",
            }
            // Tambahkan log_file di sini jika diperlukan untuk debugging
        }
    ]
}