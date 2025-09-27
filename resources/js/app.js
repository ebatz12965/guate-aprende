//resources/js/app.js

import './bootstrap';
import { createApp } from 'vue';

// Importa y registra tus componentes
import RolesComponent from './components/RolesComponent.vue';
import PermissionsComponent from './components/PermissionsComponent.vue';
import Index from './pages/Admin/Users/Index.vue';

const app = createApp({});

// Registra los componentes correctamente
app.component('roles-component', RolesComponent);
app.component('permissions-component', PermissionsComponent);
app.componet('user-index', Index);

app.mount('#app');

