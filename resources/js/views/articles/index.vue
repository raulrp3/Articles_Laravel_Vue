<template>
    <div>
        <ArticleList endPoint="/api/articles"></ArticleList>
    </div>
</template>

<script>
    import ArticleList from '../../components/ArticleList';

    export default {

        components: {
            ArticleList,
        }
    }
</script>
