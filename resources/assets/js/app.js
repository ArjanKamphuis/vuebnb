import 'core-js/features/object/assign';
import Vue from 'vue';
import router from './router';
import store from './store';
import App from '../components/App.vue';

export default new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app');
