import { createApp } from 'vue'
import App from './App.vue'
// import './registerServiceWorker'
import router from './router'
import store from './store'
import Menu from './components/Menu.vue'
import Header from './components/Header.vue'
import Footer from './components/Footer.vue'
import '@/assets/scss/style.scss'

const app =  createApp(App)
app.use(store)
app.use(router)
app.component('Menu',Menu)
app.component('Header',Header)
app.component('Footer',Footer)
app.mount('#app')
