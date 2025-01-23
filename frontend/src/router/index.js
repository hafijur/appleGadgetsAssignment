// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/HomePage.vue';
import productRoutes from "@/modules/product/router";
import supplierRoutes from "@/modules/supplier/router";
import purchaseRoutes from "@/modules/purchase/router";
import supplierLedgerRoutes from "@/modules/supplier_ledger/router";
import LoginPage from '@/views/LoginPage.vue';

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home,
        meta: {
            public: true,
            layout: null
        }
    },
    {
        path: '/login',
        name: 'Login',
        component: LoginPage,
        meta: {
            public: true,
            layout: null
        }
    },

    ...productRoutes,
    ...supplierRoutes,
    ...purchaseRoutes,
    ...supplierLedgerRoutes
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

// Global Navigation Guard
router.beforeEach((to, from, next) => {
    const isAuthenticated = !!localStorage.getItem("authToken"); // Example authentication logic
    if (!to.meta.public && !isAuthenticated) {
      next({ name: "Login" });
    } else {
      next();
    }
  });

export default router;
