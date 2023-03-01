###Инструкция по установке : 
необходимое для запуска 
    PHP 8;  Laravel 9; Bootstrap; VUE 3; nodeJS, composer
    

##В консоле вводим :

Клонируем проект,инициализируем и устанавливаем необходимые зависимости
```
git clone https://github.com/LastWord7722/library.git
composer install
npm  install
php artisan ui vue
npm i @vitejs/plugin-vue
npm install vue@next vue-loader@next
php artisan ui bootstrap
```
#Файл .env.example переиминовать в .env  внутри файла подключить базу данных mySQL
```
php artisan key:generate
php artisan migrate
php artisan db:seed
npm  install && npm run dev
```



Убедитесь в том что vite.config.js имеет эти импорты
```javascript
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
```
И то что app.js  выглядить вот так:
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