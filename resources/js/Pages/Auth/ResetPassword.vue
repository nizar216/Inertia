<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, useForm} from '@inertiajs/vue3';
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Modal from "@/Components/Modal.vue";
import {ref} from "vue";

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

const togglePasswordVisibility = () => {
    passwordVisible.value = !passwordVisible.value;
};

const passwordVisible = ref(false);
</script>

<template>
    <div class="min-h-screen">
        <section class="bg-gray-50 dark:bg-gray-900">
            <div
                class="flex flex-col items-center justify-center py-8 mx-auto md:h-screen lg:py-0 max-w-[420px] space-y-10">
                <div class="flex items-center">
                    <img class="h-20" src="/storage/logos/mgo360-logo.png"
                         alt="logo">
                </div>
                <div class="flex flex-col items items-center space-y-6">
                    <h2>Neues Passwort vergeben!</h2>
                    <p class="text-center"> Bitte vergeben Sie ein neues Passwort, um das Seitentool weiterhin nutzen zu
                        können.
                        <span
                            class="font-bold">Ihr neues Passwort muss sich von Ihrem alten Passwort unterscheiden.</span>
                    </p>
                </div>
                <div
                    class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4">
                        <form class="flex flex-col gap-12" @submit.prevent="submit">
                            <div class="hidden">
                                <InputLabel for="email" value="Email"/>

                                <TextInput
                                    id="email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    v-model="form.email"
                                    required
                                    autofocus
                                    autocomplete="username"
                                />

                                <InputError class="mt-2" :message="form.errors.email"/>
                            </div>
                            <div class="space-y-4">
                                <div class="space-y-2">
                                    <InputLabel for="password" value="Neues Passwort eingeben"/>
                                    <div class="relative">
                                        <TextInput
                                            id="password"
                                            :type="passwordVisible ? 'text' : 'password'"
                                            class="block w-full"
                                            v-model="form.password"
                                            required
                                            autocomplete="new-password"
                                        />

                                        <InputError class="mt-2" :message="form.errors.password"/>
                                        <button type="button" @click="togglePasswordVisibility"
                                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_5995_15210)">
                                                    <path
                                                        d="M3.27473 14.0688L4.16848 13.1812C3.18987 12.3026 2.42097 11.2154 1.91848 10C3.18723 6.83125 6.68723 4.375 9.99973 4.375C10.8522 4.38625 11.6969 4.5383 12.4997 4.825L13.4685 3.85C12.3701 3.38583 11.192 3.13959 9.99973 3.125C7.96256 3.20161 5.99248 3.87347 4.33299 5.05755C2.67349 6.24164 1.39733 7.88603 0.662234 9.7875C0.612589 9.92482 0.612589 10.0752 0.662234 10.2125C1.21739 11.6856 2.1125 13.0069 3.27473 14.0688Z"
                                                        fill="#6E6E6E"/>
                                                    <path
                                                        d="M7.49973 9.83125C7.5432 9.23232 7.80079 8.66905 8.22541 8.24443C8.65003 7.81981 9.21331 7.56221 9.81223 7.51875L10.9435 6.38125C10.3096 6.21434 9.64301 6.21651 9.01021 6.38754C8.37741 6.55857 7.80049 6.89248 7.33698 7.356C6.87347 7.81951 6.53955 8.39642 6.36852 9.02922C6.19749 9.66202 6.19532 10.3286 6.36223 10.9625L7.49973 9.83125Z"
                                                        fill="#6E6E6E"/>
                                                    <path
                                                        d="M19.3372 9.7875C18.6206 7.92075 17.3735 6.30439 15.7497 5.1375L18.7497 2.13125L17.8685 1.25L1.24973 17.8687L2.13098 18.75L5.31848 15.5625C6.73966 16.3963 8.35226 16.8484 9.99973 16.875C12.0369 16.7984 14.007 16.1265 15.6665 14.9424C17.326 13.7584 18.6021 12.114 19.3372 10.2125C19.3869 10.0752 19.3869 9.92482 19.3372 9.7875ZM12.4997 10C12.4971 10.4376 12.3797 10.8668 12.1592 11.2447C11.9387 11.6227 11.6228 11.9361 11.2432 12.1538C10.8636 12.3714 10.4336 12.4856 9.99598 12.485C9.55841 12.4843 9.12868 12.3688 8.74973 12.15L12.1497 8.75C12.3744 9.12858 12.4952 9.55978 12.4997 10ZM9.99973 15.625C8.68852 15.6021 7.40217 15.2634 6.24973 14.6375L7.83723 13.05C8.55932 13.551 9.43444 13.7825 10.3098 13.704C11.1852 13.6256 12.0052 13.2421 12.6267 12.6207C13.2481 11.9992 13.6316 11.1792 13.71 10.3038C13.7885 9.42846 13.557 8.55334 13.056 7.83125L14.8497 6.0375C16.2839 7.02186 17.4053 8.39714 18.081 10C16.8122 13.1687 13.3122 15.625 9.99973 15.625Z"
                                                        fill="#6E6E6E"/>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_5995_15210">
                                                        <rect width="20" height="20" fill="white"/>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <InputLabel for="password_confirmation" value="Passwort bestätigen"/>
                                    <div class="relative">
                                        <TextInput
                                            id="password_confirmation"
                                            :type="passwordVisible ? 'text' : 'password'"
                                            class="block w-full"
                                            v-model="form.password_confirmation"
                                            required
                                            autocomplete="new-password"
                                        />
                                        <button type="button" @click="togglePasswordVisibility"
                                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_5995_15210)">
                                                    <path
                                                        d="M3.27473 14.0688L4.16848 13.1812C3.18987 12.3026 2.42097 11.2154 1.91848 10C3.18723 6.83125 6.68723 4.375 9.99973 4.375C10.8522 4.38625 11.6969 4.5383 12.4997 4.825L13.4685 3.85C12.3701 3.38583 11.192 3.13959 9.99973 3.125C7.96256 3.20161 5.99248 3.87347 4.33299 5.05755C2.67349 6.24164 1.39733 7.88603 0.662234 9.7875C0.612589 9.92482 0.612589 10.0752 0.662234 10.2125C1.21739 11.6856 2.1125 13.0069 3.27473 14.0688Z"
                                                        fill="#6E6E6E"/>
                                                    <path
                                                        d="M7.49973 9.83125C7.5432 9.23232 7.80079 8.66905 8.22541 8.24443C8.65003 7.81981 9.21331 7.56221 9.81223 7.51875L10.9435 6.38125C10.3096 6.21434 9.64301 6.21651 9.01021 6.38754C8.37741 6.55857 7.80049 6.89248 7.33698 7.356C6.87347 7.81951 6.53955 8.39642 6.36852 9.02922C6.19749 9.66202 6.19532 10.3286 6.36223 10.9625L7.49973 9.83125Z"
                                                        fill="#6E6E6E"/>
                                                    <path
                                                        d="M19.3372 9.7875C18.6206 7.92075 17.3735 6.30439 15.7497 5.1375L18.7497 2.13125L17.8685 1.25L1.24973 17.8687L2.13098 18.75L5.31848 15.5625C6.73966 16.3963 8.35226 16.8484 9.99973 16.875C12.0369 16.7984 14.007 16.1265 15.6665 14.9424C17.326 13.7584 18.6021 12.114 19.3372 10.2125C19.3869 10.0752 19.3869 9.92482 19.3372 9.7875ZM12.4997 10C12.4971 10.4376 12.3797 10.8668 12.1592 11.2447C11.9387 11.6227 11.6228 11.9361 11.2432 12.1538C10.8636 12.3714 10.4336 12.4856 9.99598 12.485C9.55841 12.4843 9.12868 12.3688 8.74973 12.15L12.1497 8.75C12.3744 9.12858 12.4952 9.55978 12.4997 10ZM9.99973 15.625C8.68852 15.6021 7.40217 15.2634 6.24973 14.6375L7.83723 13.05C8.55932 13.551 9.43444 13.7825 10.3098 13.704C11.1852 13.6256 12.0052 13.2421 12.6267 12.6207C13.2481 11.9992 13.6316 11.1792 13.71 10.3038C13.7885 9.42846 13.557 8.55334 13.056 7.83125L14.8497 6.0375C16.2839 7.02186 17.4053 8.39714 18.081 10C16.8122 13.1687 13.3122 15.625 9.99973 15.625Z"
                                                        fill="#6E6E6E"/>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_5995_15210">
                                                        <rect width="20" height="20" fill="white"/>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <PrimaryButton :class="{ 'opacity-25': form.processing ,'flex-1': true}"
                                               :disabled="form.processing">
                                    Passwort ändern
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

