export default [
    {
        path: "/products",
        name: "ProductView",
        component: () => import("../views/ProductView.vue"),
        meta: {
            layout: "DefaultLayout",
            public: false,
        },
    },
];