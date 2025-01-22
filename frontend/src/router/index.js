// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/HomePage.vue';
import ProductList from '@/components/ProductList.vue';
import productRoutes from "@/modules/product/router";
import supplierRoutes from "@/modules/supplier/router";
import purchaseRoutes from "@/modules/purchase/router";
import supplierLedgerRoutes from "@/modules/supplier_ledger/router";

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
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

export default router;
