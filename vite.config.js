import { defineConfig } from 'vite';
import tailwindcss from 'tailwindcss';
import daisyui from 'daisyui';

// Vite configuration
export default defineConfig({
  plugins: [
    tailwindcss(),  // Menggunakan tailwindcss plugin
    daisyui,        // DaisyUI untuk komponen tambahan
  ],
});
