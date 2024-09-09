<script setup>

import {Head, Link, useForm} from '@inertiajs/vue3';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import axios from "axios";
import { ref } from 'vue';
import InputError from "@/Components/InputError.vue";

const props = defineProps(
    {subscription: Object}
);

let message = ref("");

const submit = async () => {
    try {
        form.post(route('subscription.store'), {
            onError: () => {
                console.error('An error occurred');
            },
            onSuccess: () => {
                console.log('Microsite created successfully');
            }
        });
    } catch (error) {
        console.error('An error occurred', error);
    }
};

const formatLabel = (label) => {
    return label
        .split('_')
        .map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase())
        .join(' ');
};

</script>
<template>

    <div class="min-h-screen flex-col items-center justify-center bg-gray-900 p-6">
        <div>
            <div v-if="message !== ''" class="bg-red-400">
                <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between flex-wrap">
                        <div class="w-0 flex-1 flex items-center">
                            <p class="ml-3 font-medium text-white truncate">
                                <span class="md:hidden"> {{ message }} </span>
                                <span class="hidden md:inline">
                {{ message }}
              </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto py-4">
            <div class="items-center">
                <h2 class="text-white text-2xl">Simple Payments, Simple Living</h2>
                <br>
                <Link
                    :href="route('home')"
                    class="px-3 py-2 text-white font-semibold bg-gray-500 hover:bg-indigo-700 rounded"
                >Back
                </Link
                >
            </div>
        </div>
        <div class="max-h-screen flex items-start justify-center bg-gray-900 p-6">
                <div class="max-w-lg w-full bg-gray-700 p-8 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold mb-6 text-white">¡Haz Completado tu subscripcion! {{ subscription.name }}</h2>
                    <div class="mb-4">
                        <p class="block text-sm font-medium text-white">
                            {{ subscription.status }}
                        </p>
                    </div>
                    <div class="mb-4">
                        <p class="block text-sm font-medium text-white">
                            {{ subscription.description }}
                        </p>
                    </div>
                    <div class="mb-4">
                        <p class="block text-sm font-medium text-white">
                            {{ subscription.expiration_date }}
                        </p>
                    </div>

                </div>
                <div class="flex justify-end">
                </div>
        </div>
    </div>

</template>

