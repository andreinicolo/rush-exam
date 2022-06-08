<template>
    <div>
        <h1>Login</h1>
        <form  @submit.prevent="login">
            <div>
                <label for="email">Email</label>
                <input type="email" v-model="user.email">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" v-model="user.password">
            </div>
            <button @click="login">Login</button>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user: {
                    email: '',
                    password: '',
                }
            };
        },

        methods: {
            login() {
                axios.post('/api/login', this.user)
                    .then(({data}) => {
                        this.$cookie.set("accessToken", data.access_token, 1);
                        let accessToken = this.$cookie.get('accessToken');
                        // console.log(accessToken);
                        window.location.href = './users';
                    })
                    .catch((error) => {
						Vue.$toast.open(error.message);
                    });
            }
        }
    }
</script>