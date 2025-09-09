//resources/js/app.js

import './bootstrap';
import { createApp } from 'vue';

// Importa y registra tus componentes
import RolesComponent from './components/RolesComponent.vue';
import PermissionsComponent from './components/PermissionsComponent.vue'; // Asegúrate de que este archivo exista

const app = createApp({});

// Registra los componentes correctamente
app.component('roles-component', RolesComponent);
app.component('permissions-component', PermissionsComponent);

app.mount('#app');
