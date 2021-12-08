<template>
    <div class="container mx-auto px-4 w-full md:w-3/4 lg:w-3/5 xl:w-1/2 mt-20">
        <h2 class="text-4xl">Articles</h2>
        <div class="block">
            <div class="row-auto">
                <div class="col-2">
                    <select class="text-gray-700" v-model="category_id">
                        <option selected value="">-- select category --</option>
                        <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
                    </select>
                </div>
                <div class="col-2">
                    <input v-model="search" class="shadow appearance-none border rounded w-25 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>
        </div>
        <div class="flex">
            <div>
                <a href="#" @click.prevent="change_sort('title')">Title</a>
                <span v-if="this.sort_field == 'title' && this.sort_direction == 'asc'">&uarr;</span>
                <span v-if="this.sort_field == 'title' && this.sort_direction == 'desc'">&darr;</span>
            </div>
            <div>
                <a href="#" @click.prevent="change_sort('published_at')" class="pl-3">Published At</a>
                <span v-if="this.sort_field == 'published_at' && this.sort_direction == 'asc'">&uarr;</span>
                <span v-if="this.sort_field == 'published_at' && this.sort_direction == 'desc'">&darr;</span>
            </div>
        </div>
        <ArticleItem v-for="article in articles.data" :key="articles.slug" :article="article" class="mt-3"></ArticleItem>
        <pagination :data="articles" @patination-change-page="getArticles"></pagination>
    </div>
</template>

<script>
import ArticleItem from "./ArticleItem";

export default {
    components: {
        ArticleItem
    },
    data() {
        return {
            articles: {},
            categories: {},
            sort_field: 'title',
            sort_direction: 'asc',
            category_id: '',
            search: ''
        }
    },
    mounted() {
        axios.get('/api/categories')
        .then(response => {
            this.categories = response.data.data;
        });

        this.getArticles();
    },
    watch: {
        category_id(value) {
            this.getArticles();
        },
        search(value) {
            console.log(value);
            this.getArticles();
        }
    },
    methods: {
        change_sort(field) {
            if (this.sort_field === field) {
                this.sort_direction = this.sort_direction === 'asc' ? 'desc' : 'asc';
            } else {
                this.sort_field = field;
                this.sort_direction = 'asc';
            }
            this.getArticles();
        },
        getArticles(page = 1) {
            axios.get('/api/articles?page=' + page
                + '&category_id=' + this.category_id
                + '&sort_field=' + this.sort_field
                + '&sort_direction=' + this.sort_direction
                + '&search=' + this.search)
                .then(response => {
                    this.articles = response.data;
                })
                .catch(error => {
                    this.$router.push({name: '404'});
                });
        }
    }
}
</script>
