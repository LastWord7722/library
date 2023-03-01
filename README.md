Инструкция по установке : 
необходимое для запуска 
    PHP 7+
    Laravel 9
    Bootstrap 
    VUE 3
    nodeJS 
    

В консоле вводим :

git clone https://github.com/LastWord7722/library.git
composer install
npm  install
php artisan ui vue
npm i @vitejs/plugin-vue
npm install vue@next vue-loader@next
php artisan ui bootstrap

файл .env.example переиминовать в .env  внутри файла подключить базу данных mySQL

php artisan key:generate
php artisan migrate
php artisan db:seed
npm  install && npm run dev




Убедитесь в том что vite.config.js имеет эти подключения
```javascript
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
```
и то что app.js  выглядить вот так:
```javascript
`import './bootstrap';
import { createApp } from 'vue';
import router from "./router.js";


const app = createApp({});
import index from './index.vue'

app.component('index', index)

app.use(router)

app.mount('#app');`
```