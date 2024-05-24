<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import {ref} from "vue";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
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
                <a class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                    <img class="h-20" src="/storage/logos/mgo360-logo.png"
                         alt="logo">
                </a>
                <div
                    class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">

                        <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
                            <div>
                                <label for="email" class="block mb-2 text-base font-semibold dark:text-white">E-Mail-Adresse</label>
                                <TextInput
                                    id="email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    v-model="form.email"
                                    required
                                    autofocus
                                    autocomplete="username"
                                />
                                <p class="mt-2 font-medium text-sm text-red-600 dark:text-red-500" v-if="form.errors.email">{{form.errors.email}}</p>
                            </div>
                            <div>
                                <label for="password" class="block mb-2 text-base font-semibold dark:text-white">Passwort</label>
                                <div class="relative">
                                    <TextInput
                                        id="password"
                                        :type="passwordVisible ? 'text' : 'password'"
                                        class="mt-1 block w-full"
                                        v-model="form.password"
                                        required
                                        autocomplete="current-password"
                                    />
                                    <button type="button" @click="togglePasswordVisibility"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                        <i :class="passwordVisible ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                                    </button>
                                </div>
                                <p class="mt-2 font-medium text-sm text-red-600 dark:text-red-500" v-if="form.errors.password">{{form.errors.password}}</p>
                            </div>
                            <div class="flex flex-col items-end">

                                <a href="#"
                                   class="text-sm font-semibold underline">Passwort vergessen?</a>
                            </div>
                            <button type="submit"
                                    class="w-full h-12 text-white bg-sky-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:focus:ring-primary-800">
                                Einloggen
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
