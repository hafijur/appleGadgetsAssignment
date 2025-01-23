export default [
    {
        path: "/purchases",
        name: "PurchaseView",
        component: () => import("../views/PurchaseView.vue"),
        meta: {
            layout: "DefaultLayout",
            public: false,
        },
    },
];