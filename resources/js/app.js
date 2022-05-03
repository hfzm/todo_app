require('./bootstrap');

import {createApp} from 'vue'
import * as VueRouter from 'vue-router'

import HomeComponent from './components/HomeComponent.vue'
import TaskComponent from './components/TaskComponent.vue'

import LoaderComponent from './components/LoaderComponent.vue'

const routes = [
    {path: '/', component: HomeComponent},
    {path: '/tasks', component: TaskComponent},
]

const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory('/todo_app/public/'),
    routes,
    linkActiveClass: "active",
    linkExactActiveClass: "exact-active",
})

const app = createApp({})

window.url = '/todo_app/public/'

var Emitter = require('tiny-emitter')
window.emitter = new Emitter()

app.component('loader-component', LoaderComponent)

app.use(router)

app.mount('#app')
