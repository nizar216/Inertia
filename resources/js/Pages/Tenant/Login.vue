<script setup>
import {useForm} from 'laravel-precognition-vue-inertia';
import {useForm as useFormVue} from '@inertiajs/vue3';
import {nextTick, ref} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Modal from "@/Components/Modal.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";

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
const form = useForm('post', route('tenant.store'), {
    email: '',
    password: '',
});

const submit = () => form.submit({
    preserveScroll: true,
    onSuccess: () => form.reset(),
});
const passwordVisible = ref(false);
const togglePasswordVisibility = () => {
    passwordVisible.value = !passwordVisible.value;
};
const confirmingPasswordForgotten = ref(false);
const closeModal = () => {
    confirmingPasswordForgotten.value = false;
    passwordForm.reset();
};
const passwordForm = useFormVue({
    email: '',
});
const showModal = ref(false);
const submitPasswordForm = () => {
    passwordForm.post(route('tenant.password.email'), {
        onSuccess: () => {
            showModal.value = true;
        }
    });
};
const resendVerification = () => {
    passwordForm.post(route('tenant.password.email'));
};
const changeEmail = () => {
    showModal.value = false;
    passwordForm.reset();
};
const confirmPasswordForgotten = () => {
    confirmingPasswordForgotten.value = true;

    nextTick(() => formInput.value.focus());
};
const formInput = ref(null);
</script>
<template>
    <div class="min-h-screen">
        <section class="bg-gray-50 dark:bg-gray-900">
            <div class="flex flex-col items-center justify-center py-8 mx-auto md:h-screen lg:py-0 w-[420px]">
                <a class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                    <img class="w-[314px] mr-2" :src="tenant.logo"
                         alt="logo">
                </a>
                <div
                    class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
                            <div>
                                <InputLabel for="email" :value="$t('labels.email')"/>
                                <TextInput
                                    id="email"
                                    type="email"
                                    v-model="form.email"
                                    @change="form.validate('email')"
                                    required
                                    autofocus
                                    autocomplete="username"
                                />
                                <p class="mt-2 font-medium text-sm text-red-600 dark:text-red-500"
                                   v-if="form.invalid('email')">{{ form.errors.email }}</p>
                            </div>
                            <div>
                                <InputLabel for="password" :value="$t('labels.password')"/>
                                <div class="relative">
                                    <TextInput
                                        id="password"
                                        :type="passwordVisible ? 'text' : 'password'"
                                        class="block w-full"
                                        v-model="form.password"
                                        required
                                        autocomplete="current-password"
                                        @change="form.validate('password')"
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
                                <p class="mt-2 font-medium text-sm text-red-600 dark:text-red-500"
                                   v-if="form.invalid('password')">{{ form.errors.password }}</p>
                            </div>
                            <div class="flex flex-col items-end">

                                <a href="#" @click="confirmPasswordForgotten"
                                   class="text-sm font-semibold underline">{{
                                        $t("loginPage.passwordResetPage.forgotPassword")
                                    }}</a>
                            </div>
                            <button type="submit"
                                    class="w-full h-12 text-white bg-sky-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:focus:ring-primary-800">
                                {{ $t("buttons.login") }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <Modal :show="confirmingPasswordForgotten" :closeable="true" @close="closeModal">
                <div class="w-full flex flex-col gap-8 relative text-center" v-if="!showModal">
                    <h2 class="leading-trim font-palanquin font-semibold text-xl">
                        {{ $t("loginPage.passwordResetPage.forgotPasswordTitle") }}
                    </h2>

                    <p class="text-lg font-normal">
                        {{ $t("loginPage.passwordResetPage.forgotPasswordPrompt") }}
                        <span
                            class="font-bold">{{ $t("loginPage.passwordResetPage.forgotPasswordPromptBold") }}</span>
                    </p>
                    <form @submit.prevent="submitPasswordForm" class="flex flex-col items-center">
                        <div class="flex flex-col items-start w-full">

                            <label for="email"
                                   class="block mb-2 text-base font-semibold dark:text-white"> {{ $t("labels.email") }}</label>
                            <div class="relative w-full">
                                <TextInput
                                    id="email"
                                    type="email"
                                    ref="formInput"
                                    v-model="passwordForm.email"
                                    class="block"
                                    :placeholder="$t('placeholders.email')"
                                />
                                <div class="absolute inset-y-0 right-0 p-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" width="20" height="20" viewBox="0 0 20 20"
                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M17.0668 3.81681L18.75 2.13381L17.8662 1.25L16.1832 2.93306L15.5 2.25C15.3872 2.13146 15.2514 2.03708 15.101 1.97259C14.9506 1.9081 14.7887 1.87485 14.625 1.87485C14.4613 1.87485 14.2994 1.9081 14.149 1.97259C13.9986 2.03708 13.8628 2.13146 13.75 2.25L2.5 13.5V17.5H6.5L17.75 6.25C17.8685 6.13716 17.9629 6.00142 18.0274 5.85101C18.0919 5.7006 18.1251 5.53865 18.1251 5.375C18.1251 5.21135 18.0919 5.0494 18.0274 4.89899C17.9629 4.74858 17.8685 4.61284 17.75 4.5L17.0668 3.81681ZM6 16.25H3.75V14L14.625 3.125L16.875 5.375L6 16.25Z"
                                            fill="#6E6E6E"/>
                                        <path
                                            d="M10.3662 2.50001L5.62501 7.2412L6.50881 8.125L11.25 3.3838L10.3662 2.50001Z"
                                            fill="#6E6E6E"/>
                                    </svg>

                                </div>
                            </div>
                            <p>{{ passwordForm.errors.email }}</p>
                        </div>

                        <div class="mt-8 flex justify-center space-x-4 w-[364px]">
                            <SecondaryButton @click="closeModal" class="flex-1">{{ $t("buttons.cancel") }}</SecondaryButton>
                            <PrimaryButton :type="'submit'" :class="{ 'opacity-25': form.processing, 'flex-1': true }"
                                           :disabled="form.processing" textSize="text-sm">
                                {{ $t("buttons.resetPassword") }}
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
                <div class="w-full flex flex-col gap-8 text-center" v-else>
                    <h2 class="text-center leading-trim font-palanquin font-semibold text-2xl">
                        {{ $t('loginPage.passwordResetPage.emailSentSuccess') }}
                    </h2>
                    <p class="text-lg font-normal">
                        <span v-html="$t('loginPage.passwordResetPage.emailSentMessage', { email: '<span class=\'font-bold\'>' + form.email + '</span>' })"></span>
                    </p>
                    <div class="flex flex-col items-center text-sm gap-2">
                        <div class="flex items-baseline">
                            <p class="mr-1">{{ $t('loginPage.passwordResetPage.emailNotReceived') }}</p>
                            <button class="text-blue-600 text-base font-semibold underline"
                                    style="color: var(--app-color-primary);"
                                    @click="resendVerification">{{ $t('loginPage.passwordResetPage.resendEmail') }}
                            </button>
                        </div>
                        <div class="flex items-baseline">
                            <p class="mr-1">{{ $t('loginPage.passwordResetPage.emailNotReceived') }}</p>
                            <button class="m-link"
                                    @click="changeEmail">{{ $t('loginPage.passwordResetPage.changeEmailAddress') }}
                            </button>
                        </div>
                    </div>
                </div>
            </Modal>
        </section>
    </div>
</template>
<style lang="scss">
.m-link{
    @apply text-blue-600 text-base font-semibold underline;
    color: var(--app-color-primary);
}
</style>

