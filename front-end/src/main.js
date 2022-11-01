import { createApp } from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import App from './App.vue'

import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"
import './assets/main.css'

createApp(App).use(VueAxios, axios).mount('#app')
