<script setup>

import { Head, Link } from '@inertiajs/vue3';
import { PlusIcon } from '@heroicons/vue/solid';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { router } from '@inertiajs/vue3';
import {route} from "ziggy-js";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";

const props = defineProps(
    {microsites: Array,
            canEdit: Boolean,
            canCreate: Boolean},

);

// Define methods


const viewMicrosite = (id) => {
    router.visit(`/microsites/${id}`);
};

const editMicrosite = (id) => {
    router.visit(`/microsites/${id}/edit`);
};

const deleteMicrosite = (id) => {
    if (confirm('¿Estás seguro de que deseas eliminar este microsite?')) {
        router.delete(route('microsites.delete', { id }));
    }
}

const Actions = 'Actions';


</script>

<template>
    <Head title="Microsites" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Microsites</h2>

        </template>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <Link v-if = "canCreate" :href="route('microsites.create')" class="block bg-gray-500 text-white px-4 py-2 rounded mb-4 flex items-center space-x-2 text-2xl mx-40">
                <PlusIcon class="h-10 w-10"/>
                <span>Create</span>
            </Link>
                <ul role="list" class="divide-y divide-gray-100">
                <div v-for="microsite in microsites" :key="microsite.id" class="p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg shadow rounded items-center mx-40">
                        <li class="flex justify-between gap-x-6 py-5">
                            <div class="flex min-w-0 gap-x-4">
                                <button><img @click="viewMicrosite(microsite.id)" class="h-40 w-40 flex-none rounded-full bg-gray-50" :src="microsite.img_url" alt=""></button>
                                <div class="min-w-0 flex-auto">
                                    <h2 class="text-3xl font-semibold text-gray-100">{{microsite.name}}</h2>
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
                                        <DropdownLink @click="viewMicrosite(microsite.id)" href="#">
                                           View
                                        </DropdownLink>
                                        <DropdownLink v-if="canEdit" @click="editMicrosite(microsite.id)" href="#">
                                            Edit
                                        </DropdownLink>
                                        <DropdownLink @click="deleteMicrosite(microsite.id)"  href="#">
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

