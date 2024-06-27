<script setup>

import {Head, useForm} from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps(
    {microSite: Object}
);

</script>

<template>
    <Head title="Create Microsite" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">View Microsite</h2>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    <h2
                        class="dark:text-gray-200" >{{microSite.name}}</h2>

                </div>
                <div>
                    <img class="h-40 w-40 flex-none rounded-full bg-gray-50" :src="microSite.img_url" alt="">
                </div>
                <div>
                    <InputLabel for="name" value="Slug" />
                    <p
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                        focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500
                        dark:focus:ring-indigo-600 rounded-md shadow-sm" >{{microSite.slug}}</p>

                </div>
                <div>
                    <InputLabel for="document_type" value="Document type" />
                    <p
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                            focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500
                            dark:focus:ring-indigo-600 rounded-md shadow-sm" >{{microSite.document_type}}</p>

                </div>
                <div>
                    <InputLabel for="name" value="Document" />
                    <p
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                            focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500
                            dark:focus:ring-indigo-600 rounded-md shadow-sm" >{{microSite.document}}</p>

                </div>
                <div>
                    <InputLabel for="name" value="Category" />
                    <p
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                            focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500
                            dark:focus:ring-indigo-600 rounded-md shadow-sm" >{{microSite.category_id}}</p>

                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
