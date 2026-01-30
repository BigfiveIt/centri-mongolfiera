import { resolve } from 'path'
import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
    resolve: {
        alias: {
            '~aos': resolve(__dirname, 'node_modules/aos'),
            '~swiper': resolve(__dirname, 'node_modules/swiper'),
            '~blocks': resolve(__dirname, 'blocks'),
        }
    },
    build: {
        rollupOptions: {
            
            input: 'main.js',
            watch: true,
            output: {
                // Default
                dir: 'dist',
                entryFileNames: 'theme.js',
                assetFileNames: 'theme.css'
            }

        }
    },
    plugins: [
        tailwindcss(),
    ],
});
