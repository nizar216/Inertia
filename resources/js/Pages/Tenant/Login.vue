<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import {ref} from "vue";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    tenant: Object
});
const loginErrors = []
const form = useForm({
    email: '',
    password: '',
});

const submit = () => {
    form.post(route('tenant.store'), {
        onFinish: () => form.reset('password'),
        onError:(error)=>{
            loginErrors.value = error
            console.log(loginErrors.value );
        }
    });
};

const passwordVisible = ref(false);
const togglePasswordVisibility = () => {
    passwordVisible.value = !passwordVisible.value;
};
</script>
<template>
    <div class="min-h-screen">
        <section class="bg-gray-50 dark:bg-gray-900">
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                    <img class="w-[314px] mr-2" :src="tenant.logo"
                         alt="logo">
                </a>
                <div
                    class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
                            <div>
                                <label for="email" class="block mb-2 text-sm font-semibold dark:text-white">Your
                                    email</label>
                                <input type="email" name="email" id="email"
                                       v-model="form.email"
                                       class="bg-gray-200 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       required="">
                                <span v-if="loginErrors?.value?.email">{{loginErrors?.value?.email}}</span>
                            </div>
                            <div>
                                <label for="password" class="block mb-2 text-sm font-semibold dark:text-white">Password</label>
                                <div class="relative">
                                    <input :type="passwordVisible ? 'text' : 'password'" name="password" id="password" v-model="form.password"
                                           class="bg-gray-200 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           autocomplete="current-password" required>
                                    <button type="button" @click="togglePasswordVisibility"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                        <i :class="passwordVisible ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="flex flex-col items-end">

                                <a href="#"
                                   class="text-sm font-semibold underline">Forgot
                                    password?</a>
                            </div>
                            <button type="submit"
                                    class="w-full h-12 text-white bg-sky-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:focus:ring-primary-800">
                                Sign in
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>


