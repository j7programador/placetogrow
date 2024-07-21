<script setup>

import {Inertia} from "@inertiajs/inertia";
import {Head, Link, useForm} from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps(
    {documentTypes: Array,
           categories: Array,
           micrositeTypes: Array},
);

const form = useForm({
    slug: '',
    name: '',
    document_type: '',
    document: '',
    category_id: '',
    type_microsite: '',
    img_url: ''
});

const submit = () => {
    form.post(route('microsites.create'), {
        onError: () => {
            console.error('An error occurred');
        },
        onSuccess: () => {
            console.log('Microsite created successfully');
        }
    });
};

</script>

<template>
    <Head title="Create Microsite" />

    <AuthenticatedLayout>

        <template #header>
            <div class="max-w-7xl mx-auto py-4">
                <div class="flex justify-between">
                    <Link
                        :href="route('microsites.index')"
                        class="px-3 py-2 text-white font-semibold bg-gray-500 hover:bg-indigo-700 rounded"
                    >Back</Link
                    >
                </div>
            </div>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create Microsite</h2>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="name" value="Name" />

                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                        />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div>
                        <InputLabel for="slug" value="Slug" />
                        <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">microsite.com/</span>
                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.slug"
                            required
                            autofocus
                            autocomplete="name"
                        />

                        <InputError class="mt-2" :message="form.errors.slug" />
                    </div>
                    <div>
                        <InputLabel for="document_type" value="Document type" />
                        <select class = "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                id="document_type" v-model="form.document_type" required>
                            <option v-for="type in documentTypes" :key="type" :value="type">{{ type }}</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.document_type" />
                    </div>

                    <div>
                        <InputLabel for="document" value="Document"/>
                        <TextInput
                            type="text"
                            id="document"
                            v-model="form.document"
                            required
                        />
                        <InputError class="mt-2" :message="form.errors.document" />
                    </div>

                    <div>
                        <InputLabel for="category_id" value="Category" />
                        <select class = "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                id="category" v-model="form.category_id" required>
                            <option v-for="category in categories" :key="category" :value="category.id">{{ category.name }}</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.category_id" />
                    </div>
                    <div>
                        <InputLabel for="type_microsite" value="Type" />
                        <select class = "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                id="category" v-model="form.type_microsite" required>
                            <option v-for="type_microsite in micrositeTypes" :key="type_microsite" :value="type_microsite">{{ type_microsite }}</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.category" />
                    </div>

                    <div>
                        <InputLabel for="img_url" value="Image URL"/>
                        <TextInput type="text" id="img_url" v-model="form.img_url"/>
                        <InputError class="mt-2" :message="form.errors.img_url" />
                    </div>
                    <br>
                    <PrimaryButton type="submit">Create</PrimaryButton>
                </form>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
