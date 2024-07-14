<script setup>

import {Inertia} from "@inertiajs/inertia";
import {Head, useForm} from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps(
    {
           user: Object,
           role: String,
           roles: Array,
          },
);

const form = useForm(
    {
          name : props.user.name,
          role: props.role,

        }
);

const submit = () => {
    form.put(route('users.update', props.user.id), {
        onError: () => {
            console.error('An error occurred');
        },
        onSuccess: () => {
            console.log('User updated successfully');
        }
    });
};

</script>

<template>
    <Head title="Create Microsite" />

    <AuthenticatedLayout>
        <template #header>
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
                        <InputLabel for="role" value="Role" />
                        <select class = "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                id="document_type" v-model="form.role" required>
                            <option v-for="role in roles" :key="role" :value="role">{{ role }}</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.role" />
                    </div>
                    <br>
                    <PrimaryButton type="submit">Update</PrimaryButton>
                </form>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
