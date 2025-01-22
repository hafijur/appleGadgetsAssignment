// import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue';
import router from './router';
import './index.css';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';




const app = createApp(App);
app.use(VueSweetalert2);

app.use(router);
// app.use(store);

app.mixin({
    methods: {
        getCurrentDate() {
            const date = new Date();
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        },
    },
});

app.mount('#app');
