import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {path:'/public/author/index', component: () => import('./components/library/author/indexComponent.vue'),
        name: 'library.author.index'},


    {path:'/public/book/index', component: () => import('./components/library/book/indexComponent.vue'),
        name: 'library.book.index'},
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router