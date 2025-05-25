import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import App from './App.vue';
import '../css/app.css';

const ProviderProfile = () => import('./pages/ProviderProfile.vue');
const Providers = () => import('./pages/Providers.vue');
const Home = () =>  import('./pages/Home.vue');

const routes = [
    {
        path: '/',
        component: Home,
    },
    {
        path: '/providers',
        name: 'provider-list',
        component: Providers,
    },
    {
        path: '/providers/:id',
        name: 'provider-detail',
        component: ProviderProfile,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

const app = createApp(App);
app.use(router);
app.mount('#app');
