<template>
    <div>
        <div class="text-center">
            <div class="font-sans container">
                <div class="text-right my-4" v-if="can()">
                    <button @click="destroy" class="btn btn-danger">Eliminar</button>
                    <button @click="edit" class="btn btn-primary">Editar</button>
                </div>
                <h1 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-2 text-3xl">{{ attributes.title }}</h1>
                <p class="text-sm font-normal text-gray-600">{{ attributes.created_at }}</p>
                <p class="py-5">{{ attributes.content }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                article: {},
                attributes: {},
            }
        },

        created() {
            this.fetchArticle();
        },

        methods: {
            fetchArticle() {
                axios.get(`/api/articles/${this.$route.params.slug}`).then(response => {
                    this.article = response.data;
                    this.attributes = response.data.attributes;
                }).catch(error => {
                    console.log(error);
                });
            },

            destroy() {
                axios.delete(`/api/articles/${this.article.slug}`).then(response => {
                    this.$router.push({ path: '/articles/my' });
                })
            },

            edit() {
                let slug = this.article.slug;
                this.$router.push({ name: 'update', params: { slug }});
            },

            can() {
                return this.article.user_id === window.id;
            }
        },

    }
</script>
