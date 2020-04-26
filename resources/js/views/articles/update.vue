<template>
    <div>
        <h2 class="text-center">Update Article</h2>
        <ArticleForm action="update" :article="article"></ArticleForm>
    </div>
</template>

<script>
    import ArticleForm from '../../components/ArticleForm';

    export default {

        data() {
            return {
                article: {
                    'attributes': {},
                },
            }
        },

        created() {
            this.fetchArticle();
        },

        components: {
            ArticleForm,
        },

        methods: {
            fetchArticle() {
                axios.get(`/api/articles/${this.$route.params.slug}`).then(response => {
                    this.article = response.data;
                }).catch(error => {
                    console.log(error);
                });
            }
        }

    }
</script>
