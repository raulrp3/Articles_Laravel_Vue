import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from './views/Home';
import About from './views/About';
import NotFound from './views/NotFound.vue';
import ArticleIndex from './views/articles/index';
import MyArticles from './views/articles/my';
import ArticleShow from './views/articles/show';
import ArticleCreate from './views/articles/create';
import ArticleUpdate from './views/articles/update';

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history', //Elimina el asterisco de la ruta en el navegador.
    routes: [
        { path: '/home', component: Home },
        { path: '/about', component: About },
        { path: '/articles', component: ArticleIndex },
        { path: '/articles/my', component: MyArticles },
        { path: '/articles/create', component: ArticleCreate },
        { path: '/articles/:slug/edit', component: ArticleUpdate, name: 'update' },
        { path: '/articles/:slug', component: ArticleShow, name: 'show' },
        { path: '*', component: NotFound },
    ]
});
