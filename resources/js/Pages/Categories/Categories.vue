<script setup>

import { Head, Link } from '@inertiajs/vue3';
import { PlusIcon } from '@heroicons/vue/solid';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { router } from '@inertiajs/vue3';
import {route} from "ziggy-js";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";

const props = defineProps(
    {categories: Array,
            canEdit: Boolean,
            canCreate: Boolean,
            canDelete: Boolean},

);

const viewMicrosite = (id) => {
    router.visit(`/microsites/${id}`);
};

const viewPageMicrosite = (slug) => {
    router.visit(route('microsites.viewMicroSite', slug));
}

const editCategory = (id) => {
    router.visit(route('categories.edit', {id}));
};

const deleteCategory = (id) => {
    if (confirm('¿Estás seguro de que deseas eliminar este microsite?')) {
        router.delete(route('categories.destroy', { id }));
    }
}

const Actions = 'Actions';


</script>

<template>
    <Head title="Categories" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Categories</h2>

        </template>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <Link
                v-if="canCreate"
                :href="route('categories.create')"
                class="block bg-gray-500 hover:bg-indigo-700 text-white px-4 py-2 rounded mb-4 flex items-center space-x-2 text-lg sm:text-xl mx-auto sm:mx-40"
            >
                <PlusIcon class="h-8 w-8 sm:h-10 sm:w-10"/>
                <span>Create</span>
            </Link>

            <ul role="list" class="divide-y divide-gray-100">
                <div v-for="category in categories" :key="category.id"
                     class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg rounded mx-4 sm:mx-40 mb-4"
                >
                    <li class="flex flex-col sm:flex-row justify-between gap-y-4 sm:gap-x-6 py-12">
                        <div class="flex gap-x-4">
                            <div class="flex-auto">
                                <h2 class="text-xl sm:text-3xl font-semibold text-gray-100">{{category.name}}</h2>
                            </div>
                        </div>
                        <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                            <Dropdown>
                                <template #trigger>
                    <span class="inline-flex rounded-md">
                        <button
                            type="button"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"
                        >
                            {{ Actions }}
                            <svg
                                class="ms-2 -me-0.5 h-4 w-4"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </button>
                    </span>
                                </template>
                                <template #content>

                                    <DropdownLink v-if="canEdit" @click="editCategory(category.id)" href="#">
                                        Edit
                                    </DropdownLink>
                                    <DropdownLink v-if="canDelete" @click="deleteCategory(category.id)" href="#">
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

