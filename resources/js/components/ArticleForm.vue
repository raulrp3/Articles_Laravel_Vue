<template>
    <div>
        <div class="mt-5">
            <form @submit.prevent="submit" class="w-100 max-w-xl">
                <div class="d-flex justify-content-center mb-5">
                    <input type="text" name="title" class="form-control" id="inline-full-name" v-model="article.attributes.title">
                </div>
                <div class="d-flex align-items-center mb-5">
                    <textarea name="content" id="inline-username" rows="10"  class="form-control" v-model="article.attributes.content"></textarea>
                </div>
                <div class="mt-5">
                    <button class="btn btn-success btn-lg shadow" type="submit">{{ buttonTitle }}</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {

        props: ['action', 'article'],

        methods: {
            create() {
                this.article.attributes.thumbnail = 'https://picsum.photos/250/250';
                axios.post('/api/articles', this.article.attributes).then(response => {
                    let slug = response.data.slug;
                    this.$router.push({ name: 'show', params: { slug } });
                }).catch(error => {
                    console.log(error);
                });
            },

            update() {
                this.article.attributes.thumbnail = 'https://picsum.photos/250/250';
                 axios.put(`/api/articles/${this.article.slug}`, this.article.attributes).then(response => {
                    let slug = response.data.data.slug;
                    this.$router.push({ name: 'show', params: { slug } });
                }).catch(error => {
                    console.log(error);
                });
            },

            submit() {
                if (this.action === 'create'){
                    this.create();
                }else{
                    this.update();
                }
            }
        },

        computed: {
            buttonTitle() {
                return this.action === 'create'? 'Create article': 'Update article';
            }
        }

    }
</script>
