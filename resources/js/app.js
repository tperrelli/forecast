/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

import App from './components/App.vue';
import useAuth from '@/composables/useAuth';
import NotFound from './components/NotFound.vue';
import Login from './components/Login.vue';
import MainDashboard from './components/MainDashboard.vue';

const { attempt, authenticated } = useAuth();

const routes = [
  { 
    path: '/login',
    name: 'Login',
    component: Login,
    meta: {
      auth: false
    }
  },
  { 
    path: '/',
    name: 'dashboard',
    component: MainDashboard,
    meta: {
      auth: true
    } 
  },
  { 
    path: '/:pathMatch(.*)*', 
    component: NotFound,
    meta: {
      auth: true
    }
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

router.beforeEach((to, from, next) => {
  attempt().then(() => {

    if (to.meta.auth) {
      if (!authenticated.value) {
        next({ name: 'Login' });
      }
      next();
    } else {

      if (authenticated.value) {
        next({ name: 'dashboard' });
      }

      next();
    }
  });
});

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp(App).use(router);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

attempt().then(() => {
  app.mount('#app');
});
