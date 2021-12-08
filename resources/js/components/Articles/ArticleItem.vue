<template>
<div>
    <div>
        <router-link :to="{name: 'articles.show', params: {slug: article.slug }}">
            <h4 class="text-2xl pb-3 font-semibold hover:underline">{{ article.title }}</h4>
        </router-link>
        <p class="text-gray-600 pb-3">{{ article.subtitle }}</p>
        <div class="text-sm text-gray-600">
            By {{ article.author.name }}&nbsp; in {{  article.published_at | longPublished }}
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: {
        article: Object
    }
}
</script>

<style scoped>

</style>
