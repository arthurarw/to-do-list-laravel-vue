import Vue from 'vue';
import router from '@/router';
import store from '@/store';
import App from '@/App.vue';
import '@/plugins/vee-validate.js'
import '@/plugins/axios.js'
import '@/assets/css/tailwindcss.css';

Vue.config.productionTip = false;

new Vue({
    router,
    store,
    render: h => h(App),
}).$mount('#app');
