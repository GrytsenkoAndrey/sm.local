import ArticlesIndex from "../components/Articles/ArticlesIndex";
import Article from "../components/Articles/Article";
import NotFound from "../components/NotFound";

export default {
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'articles.index',
            component: ArticlesIndex
        },
        {
            path: '/articles/:slug',
            name: 'articles.show',
            component: Article
        },
        {
            path: '*',
            name: '404',
            component: NotFound
        }
    ]
};
