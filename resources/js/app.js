import './bootstrap';
import {createApp, defineAsyncComponent} from 'vue/dist/vue.esm-bundler.js'
import Toast from "vue-toastification"
import "vue-toastification/dist/index.css";

const app = createApp({})

app.component('login-form', defineAsyncComponent(() => import('./components/admin/auth/LoginForm.vue')))

app.use(Toast)

app.mount("#app")