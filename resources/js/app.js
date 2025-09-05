import './bootstrap';
import { createApp } from 'vue';
import App from './components/App.vue';
import router from './router';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

createApp(App).use(router).mount('#app');
