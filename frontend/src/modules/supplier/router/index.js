export default [
    {
        path: "/suppliers",
        name: "SupplierView",
        component: () => import("../views/SupplierView.vue"),
        meta: {
            layout: "DefaultLayout",
            public: false,
        },
    },
];