import { createApp } from 'vue'

import LoginForm from './components/LoginForm.vue';

window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};
    
var app = createApp({});

app.component('login-form', LoginForm);

app.mount('#app');