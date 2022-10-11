import { createApp } from 'vue'
import App from './App.vue'
// import './registerServiceWorker'
import router from './router'
import store from './store'
import Main from './components/Main.vue'
import "@/assets/Scss/Style.scss"

const app =  createApp(App)
app.use(store)
app.use(router)
app.component('Main',Main)
app.mount('#app')
