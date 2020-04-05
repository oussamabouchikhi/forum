<template>
    <div class="container border w-3/4 mt-12 border-gray-300 p-6 mx-auto flex content-center font-sans shadow-2xl">
        
        <div class="w-2/5 border border-gray-400">
            <img :src="imgForm" alt="image for login" class="w-full mx-auto">
        </div>
        
        <div class="text-center w-3/5 border border-gray-400">
            <h1 class="text-5xl font-bold text-mainColor">Sign in to Account</h1>
            <div class="mt-2">
                <div class="text-3xl text-gray-700">Welcome Back!</div>
                <div class="text-xl text-gray-700">Fill your personal information and start your journey with us.</div>
                <form class="mt-5 mb-5 px-5" @submit.prevent="login" @keydown="form.onKeydown($event)">
                    <input class="w-full border mb-3 p-4 border-gray-400 outline-none block" placeholder="Enter your email" name="email" v-model="form.email" type="email">
                    <input class="w-full border p-4 border-gray-400 outline-none block" placeholder="Enter your password" name="password" v-model="form.password" type="password">
                    <button class="w-full mt-8 border-none bg-mainColor px-10 py-2 text-white block" type="submit"> <i class="fa fa-sign-in" aria-hidden="true"></i> Sign in</button>
                </form>
                <div>
                    <a href="/login/github" class="mt-8 border-none bg-githubColor px-16 py-2 text-white"> <i class="fab fa-github"></i> Login with Github</a>
                    <a href="/login/facebook" class="mt-8 border-none bg-facebookColor px-16 py-2 text-white"> <i class="fab fa-facebook"></i> Login with Facebook</a>
                </div>
                <p class="pt-4 text-gray-600">Not registered yet? <a href="/register" class="text-mainColor font-bold">create an account</a> </p>
            </div>
        </div>

    </div>

</template>

<script>
import {Form} from 'vform';

export default {
    data() {
        return {
            form: new Form({
                email: '',
                password: '',
                remember: false
            }),
            imgForm: "/images/login.svg"
        }
    },
    methods: {
        async login () {
            // Submit the form via a POST request
            const {data} = await this.form.post('/api/v1/auth/login'); // get only data
            this.$store.dispatch('auth/saveToken', {
                token: data.access_token,
                remember: this.remember
            })
            await this.$store.dispatch('auth/fetchUser');
            // redirect to home page
            this.$router.push({ name: 'home' });
        }
    }
}
</script>