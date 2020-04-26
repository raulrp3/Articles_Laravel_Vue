<template>
    <div>
        <h2 class="text-center">Create Article</h2>
        <ArticleForm action="create" :article="article"></ArticleForm>
    </div>
</template>

<script>
    import ArticleForm from '../../components/ArticleForm';

    export default {

        data() {
            return {
                article: {
                    'attributes': {
                        'title': '',
                        'content': '',
                    },
                }
            }
        },

        components: {
            ArticleForm,
        }

    }
</script>
