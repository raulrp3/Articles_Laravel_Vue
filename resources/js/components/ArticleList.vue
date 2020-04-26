<template>
    <div>
        <div class="d-flex flex-wrap justify-center">
            <div v-for="article of articles" :key="article.id" class="w-25 rounded overflow-hidden shadow-lg mx-4 my-4" @click="show(article.slug)">
                <img class="w-100" :src="article.attributes.picture">
                <div class="px-5 py-4">
                    <div class="font-bold text-xl mb-2">Título: {{ article.attributes.title }}</div>
                </div>
            </div>
        </div>
        <ul class="d-flex mt-5">
            <li v-for="page in pagination.last_page" :key="page" class="py-2 px-2 list-group-item mx-1">
                <button class="btn btn-primary" @click="doPagination(page)">{{ page }}</button>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {

        props: ['endPoint'],

        data() {
            return {
                articles: [],
                pagination: {},
            }
        },

        created() {
            this.fetchArticles();
        },

        methods: {
            fetchArticles(endPoint = this.endPoint) {
                axios.get(endPoint).then(response => {
                    this.articles = response.data.data;
                    this.makePagination({
                        ...response.data.meta,
                        ...response.data.links,
                    });
                }).catch(error => {
                    console.log(error);
                });
            },

            makePagination(data) {
                this.pagination = data;
            },

            doPagination(page) {
                this.fetchArticles(`${this.endPoint}?page=${page}`);
            },

            show(slug) {
                this.$router.push({ name: 'show', params:{ slug } });
            }

        }
    }
</script>
