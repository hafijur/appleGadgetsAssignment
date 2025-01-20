// src/store/index.js
import { createStore } from 'vuex';

const store = createStore({
    state: {
        products: [],
    },
    mutations: {
        ADD_PRODUCT(state, product) {
            const existingProduct = state.products.find(p => p.sku === product.sku);
            if (existingProduct) {
                Object.assign(existingProduct, product);
            } else {
                state.products.push(product);
            }
        },
    },
    actions: {
        addProduct({ commit }, product) {
            commit('ADD_PRODUCT', product);
        },
    },
    getters: {
        products: (state) => state.products,
    },
});

export default store;
