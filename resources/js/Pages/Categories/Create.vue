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
    {},
);

const form = useForm({
    name: '',
});

const submit = () => {
    form.post(route('categories.store'), {
        onError: () => {
            console.error('An error occurred');
        },
        onSuccess: () => {
            console.log('Category created successfully');
        }
    });
};

</script>

<template>
    <Head title="Create Category" />

    <AuthenticatedLayout>

        <template #header>
            <div class="max-w-7xl mx-auto py-4">
                <div class="flex justify-between">
                    <Link
                        :href="route('categories.index')"
                        class="px-3 py-2 text-white font-semibold bg-gray-500 hover:bg-indigo-700 rounded"
                    >Back</Link
                    >
                </div>
            </div>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create Category</h2>
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
                    <br>
                    <PrimaryButton type="submit">Create</PrimaryButton>
                </form>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
