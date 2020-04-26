<template>
    <div class="container mt-5">
        <router-view></router-view>
    </div>
</template>

<script>
    export default {

        props: ['user'],

        created() {
            window.id = this.user.id;
            axios.interceptors.request.use((config) => {
                if (config.method === 'get'){
                    if (config.url.match('/\?./')){
                        let url = config.url.split('?');
                        let page = url[1];
                        url = url[0];

                        config.url = `${url}?api_token=${this.user.token}&${page}`;

                        return config;
                    }

                    config.url = `${config.url}?api_token=${this.user.token}`;
                }else{
                    config.data = {
                        ...config.data,
                        api_token: this.user.token,
                    };
                }

                return config;
            });

        },
    }
</script>
