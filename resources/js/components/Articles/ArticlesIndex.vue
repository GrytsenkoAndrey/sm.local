<template>
    <div class="container mx-auto px-4 w-full md:w-3/4 lg:w-3/5 xl:w-1/2 mt-20">
        <h2 class="text-4xl">Articles</h2>
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
            articles: {}
        }
    },
    mounted() {
        this.getArticles();
    },
    methods: {
        getArticles(page = 1) {
            axios.get('/api/articles?page=' + page)
                .then(response => {
                    this.articles = response.data;
                });
        }
    }
}
</script>
