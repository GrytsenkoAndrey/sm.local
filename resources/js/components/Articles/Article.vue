<template>
    <div class="container mx-auto px-4 w-full md:w-3/4 lg:w-3/5 xl:w-1/2 mt-20">
        <div class="text-lg text-gray-600">
            By{{ article.author.name }} in {{ article.category.title }}, {{ article.published_at | timeago }}
        </div>
        <h1 class="text-5xl mt-10 font-bold mb-12">{{ article.title }}</h1>
        <p class="text-gray-700 pb-3 mb-12 whitespace-pre-line">{{ article.content }}</p>
        <footer class="mb-24 flex">
            <div class="flex flex-col justify-center">
                <div class="text-xl text-gray-600">
                    written by {{ article.author.name }} at {{ article.published_at | longPublished }}
                </div>
                <div class="text-gray-600">
                    tags:
                    <ul v-for="tag in article.tags" :key="tag.slug">
                        <li class="ml-3">{{ tag.title }}</li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
export default {
    name: "Article.vue",
    data() {
        return {
            article: Object
        }
    },
    mounted() {
        axios.get('/api/articles/' + this.$route.params.slug)
            .then(response => {
                this.article = response.data.data;
            });
    }
}
</script>

<style scoped>
ul {
    display:inline-flex;
}
</style>
