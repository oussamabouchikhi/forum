<template>
    <div class="gel3ah">

        <div class="container border w-3/4 mt-12 border-gray-300 p-6 mx-auto flex content-center font-sans shadow-2xl">
        
        <div class="w-2/5 border border-gray-400">
            <img :src="imgForm" alt="image for login" class="w-full mx-auto">
        </div>
        
        <div class="text-center w-3/5 border border-gray-400">
            <h1 class="text-5xl font-bold text-mainColor">Sign un to Account</h1>
            <div class="mt-2">
                <h3 class="text-3xl text-gray-700">Welcome Back!</h3>
                <p class="text-xl text-gray-700">Fill your personal information and start your journey with us.</p>
                <!-- Display errors of found -->
                <div v-if="authError" class="bg-red-400 text-white mb-4 p-4 w-1/2 mx-auto"> <!-- authError: computed property -->
                    <p> {{ authError }} </p>
                </div>
                <!-- Display errors of found -->
                <form class="mt-5 mb-5 px-5" @submit.prevent="register" @keydown="form.onKeydown($event)">
                    <input class="w-full border mb-3 p-4 border-gray-400 outline-none block" placeholder="Enter your name" name="name" v-model="form.name" type="text">
                    <input class="w-full border mb-3 p-4 border-gray-400 outline-none block" placeholder="Enter your email" name="email" v-model="form.email" type="email">
                    <input class="w-full border p-4 border-gray-400 outline-none block" placeholder="Enter your password" name="password" v-model="form.password" type="password">
                    <input class="w-full border p-4 border-gray-400 outline-none block" placeholder="Confirm your password" name="password_confirmation" v-model="form.password_confirmation" type="password">
                    <button class="w-full mt-8 border-none bg-mainColor px-10 py-2 text-white block" type="submit"> <i class="fa fa-sign-in" aria-hidden="true"></i> register</button>
                </form>
                <p class="pt-4 text-gray-600">Already have an account? <a href="/login" class="text-mainColor font-bold">Login</a> </p>
            </div>
        </div>

    </div>

    <div class="bg-mainColor h-screen w-screen">
    <div class="flex flex-col items-center flex-1 h-full justify-center px-4 sm:px-0">
        <div class="flex rounded-lg shadow-lg w-full sm:w-3/4 lg:w-1/2 bg-white sm:mx-0" style="height: 500px">
            
            <div class="hidden md:block md:w-1/2 rounded-r-lg m-auto" style="background-size: cover; background-position: center center;">
                <img :src="imgForm" alt="image for login" class="px-5">
            </div>
            
            <div class="flex flex-col w-full md:w-1/2 p-4">
                <div class="flex flex-col flex-1 justify-center mb-8">
                    <h1 class="text-4xl text-center font-thin">Welcome Back</h1>
                    <div class="w-full mt-4">
                        <form class="form-horizontal w-3/4 mx-auto" method="POST" action="#">
                            <div class="flex flex-col mt-4">
                                <input id="email" type="text" class="flex-grow h-8 px-2 border rounded border-grey-400" name="email" value="" placeholder="Email">
                                <!-- vform verification -->
                                <has-errortailwind 
                                    :form="form" field="email" 
                                    :class="{ 'is-valid': form.errors.has('email') }"
                                ></has-errortailwind>
                                <!-- vform verification -->
                            </div>
                            <div class="flex flex-col mt-4">
                                <input id="password" type="password" class="flex-grow h-8 px-2 rounded border border-grey-400" name="password" required placeholder="Password">
                                <!-- vform verification -->
                                <has-errortailwind 
                                    :form="form" field="password" 
                                    :class="{ 'is-valid': form.errors.has('password') }"
                                ></has-errortailwind>
                                <!-- vform verification -->
                            </div>
                            <div class="flex items-center mt-4">
                                <input type="checkbox" name="remember" id="remember" class="mr-2"> <label for="remember" class="text-sm text-grey-dark">Remember Me</label>
                            </div>
                            <div class="flex flex-col mt-8">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded">
                                    <pulse-loader :loading="isLoading" color="#fff" size="30px" ></pulse-loader>
                                    <span v-if="!isLoading" >Login</span>
                                </button>
                            </div>
                        </form>
                        <div class="text-center mt-4">
                            <a class="no-underline hover:underline text-blue-dark text-xs" href="#">
                                Forgot Your Password?
                            </a>
                        </div>

                        <div class="mt-4" style="padding-left: 3.4rem;">
                            <hr style="width: 80px; height: 5px; display: inline-block;"> 
                            <span class="text-gray-700"> OR </span>
                            <hr style="width: 80px; height: 5px; display: inline-block;">
                        </div>

                        <div class="flex flex-col mt-4 mx-10">
                            <button type="submit" class="bg-githubColor hover:bg-gray-700 text-white text-sm font-semibold py-2 px-4 rounded">
                                Login with Github
                            </button>
                        </div>
                        <div class="flex flex-col mt-2 mx-10">
                            <button type="submit" class="bg-facebookColor hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded">
                                Login with Facebook
                            </button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

    </div>

</template>

<script>
import Vue              from 'vue';
import {Form}           from 'vform';
import {mapGetters}     from 'vuex';
import HasErrorTailwind from '../../components/HasErrorTailwind';
import {PulseLoader}      from 'vue-spinner/dist/vue-spinner.min.js';

// Register components
// Vue.component('has-errortailwind', HasErrorTailwind) Or
Vue.component(HasErrorTailwind.name, HasErrorTailwind)
Vue.component('pulse-loader', PulseLoader)

export default {
    data() {
        return {
            form: new Form({
                email:    '',
                password: '',
                password_confirmation: ''
            }),
            imgForm: "/images/register.svg"
        }
    },
    methods: {
        register () {

            // Submit the form via a POST request
            this.form.post('/api/v1/auth/register')
                .then( ({data}) => { // get only data from response
                    this.$router.push({ name: 'login' });    // redirect to login page
                })
                .catch( (error) => {
                    console.log(error);
                    
                } )

        }
    },
    computed: {
        ...mapGetters({
            authError: 'auth/authError',
            isLoading: 'auth/isLoading',
        })
    }
}
</script>

// scoped: the style is applied only in this component
<style scoped>

    .is-invalid {
        border: apx solid #ff3949;
    }

</style>