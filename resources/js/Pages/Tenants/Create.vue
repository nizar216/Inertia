<template>
    <AuthenticatedLayout>
        <div>
            <form class="max-w-sm mx-auto" @submit.prevent="submitForm" enctype="multipart/form-data">
                <!-- Form inputs here -->
                <div class="mb-5">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name:</label>
                    <input type="text" v-model="form.name" id="name"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="name" required/>
                </div>

                <div class="flex items-center justify-center w-full mb-5" @dragover.prevent="dragover"
                     @dragleave.prevent="dragleave"
                     @drop.prevent="drop">
                    <label for="dropzone-file"
                           class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span>
                                or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                800x400px)</p>
                        </div>
                        <input id="dropzone-file" type="file" class="hidden" @change="handleLogoChange"
                               accept="image/*"/>
                    </label>
                </div>
                <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Submit
                </button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import {useForm, Head} from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

export default {
    components: {AuthenticatedLayout},
    setup() {
        const form = useForm({
            name: '',
            logo: ''
        });

        const files = [];

        const dragover = (e) => {
            e.preventDefault();
        };

        const dragleave = (e) => {
            e.preventDefault();
        };

        const drop = (e) => {
            e.preventDefault();
            form.logo = Array.from(e.dataTransfer.files)[0];
        };

        const handleLogoChange = (event) => {
            form.logo = Array.from(event.target.files)[0];
        };
        const submitForm = () => {

            form.post(route('tenants.store'), {
                onSuccess: () => {
                    form.reset();
                    files.length = 0;
                }
            });
        };

        return {
            form,
            dragover,
            dragleave,
            drop,
            handleLogoChange,
            submitForm
        };
    }
};
</script>
