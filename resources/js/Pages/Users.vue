<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { PlusIcon } from '@heroicons/vue/solid';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { router } from '@inertiajs/vue3';
import { route } from "ziggy-js";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";

const props = defineProps(
    {
        users: Array,
        canEdit: Boolean,
        canCreate: Boolean,
        currentUser: Object
    }
);

const viewMicrosite = (id) => {
    router.visit(`/microsites/${id}`);
};

const editUser = (id) => {
    router.visit(`/users/${id}/edit`);
};

const deleteUser = (id) => {
    if (confirm('Are you sure to delete this user?')) {
        router.delete(route('users.delete', {id}));
    }
}

const Actions = 'Actions';
</script>

<template>
    <Head title="Users"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Users</h2>
        </template>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <Link v-if="canCreate" :href="route('register')"
                  class="block bg-gray-500 hover:bg-indigo-700 text-white px-4 py-2 rounded mb-4 flex items-center space-x-2 text-lg sm:text-xl mx-auto sm:mx-40">
                <PlusIcon class="h-8 w-8 sm:h-10 sm:w-10"/>
                <span>Create</span>
            </Link>

            <ul role="list" class="divide-y divide-gray-100">
                <div v-for="user in users" :key="user.id"
                     class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg rounded mx-4 sm:mx-40 mb-4">
                    <li v-if="user.id !== currentUser.id"
                        class="flex flex-col sm:flex-row justify-between gap-y-4 sm:gap-x-6 py-5">
                        <div class="flex gap-x-4">
                            <div class="flex-auto">
                                <h2 class="text-3xlxl sm:text-3xl font-semibold text-gray-100">{{ user.name }}</h2>
                                <p class="text-gray-300 text-2xl">{{ user.email }}</p>
                            </div>
                        </div>
                        <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                            <Dropdown>
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button
                                            type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                            {{ Actions }}
                                            <svg
                                                class="ms-2 -me-0.5 h-4 w-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    </span>
                                </template>
                                <template #content>
                                    <DropdownLink v-if="canEdit" @click="editUser(user.id)" href="#">
                                        Edit
                                    </DropdownLink>
                                    <DropdownLink @click="deleteUser(user.id)" href="#">
                                        Delete
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                    </li>
                </div>
            </ul>
        </div>
    </AuthenticatedLayout>
</template>
