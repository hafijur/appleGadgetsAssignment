export default [
    {
        path: "/supplier-ledgers",
        name: "SupplierLedgerView",
        component: () => import("../views/SupplierLedgerView.vue"),
        meta: {
            layout: "DefaultLayout",
            public: false,
        },
    },
];