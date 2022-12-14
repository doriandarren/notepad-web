import './bootstrap';
import '../css/app.css';

import { createApp } from 'vue'
import AppComponent from './App.vue'
import router from './router'

import 'bootstrap-icons/font/bootstrap-icons.css'

import 'flowbite';


const app = createApp(AppComponent)
app.use(router)
app.mount('#app')
