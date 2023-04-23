import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import Components from 'unplugin-vue-components/vite'
const { createVuePlugin } = require('vite-plugin-vue2');
export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        createVuePlugin(),
        Components(),
    ],
    define: {
        global: "window",
    },
    resolve: {
        alias: {
            "@": "/resources/js",
            vue_router: "node_modules/vue-router/dist/vue-router",
        },
    },
});
