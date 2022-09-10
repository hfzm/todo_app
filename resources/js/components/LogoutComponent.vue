<template>
    <input type="hidden" name="token_id" v-model="token_id">
</template>

<script>
    export default {
        data() {
            return {
                token_id: '',
            }
        },
        mounted() {
            let tokenData = this.parseToJson(window.token)
            this.token_id = tokenData.jti;
        },
        methods: {
            parseToJson(tokenValue) {
                let base64Url = tokenValue.split('.')[1];

                let base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');

                let jsonPayload = decodeURIComponent(window.atob(base64).split('').map(c => {
                    return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
                }).join(''));

                let tokenData = JSON.parse(jsonPayload);
                return tokenData;
            }
        }
    }
</script>