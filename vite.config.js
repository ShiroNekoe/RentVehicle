import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from 'tailwindcss';
import daisyui from 'daisyui';

// Vite configuration
export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],  
      refresh: true,
    }),
    tailwindcss(),  // Menggunakan tailwindcss plugin
    daisyui,        // DaisyUI untuk komponen tambahan
  ],
});
