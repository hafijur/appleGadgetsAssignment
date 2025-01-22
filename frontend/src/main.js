// import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue';
import router from './router';
import './index.css';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import { getCurrentDate } from './utils/dataUtils'; './utils/dataUtils';

const app = createApp(App);
app.use(VueSweetalert2);

app.use(router);
// app.use(store);

app.mixin({
    methods: {
        getCurrentDate,
    },
});

app.mount('#app');
