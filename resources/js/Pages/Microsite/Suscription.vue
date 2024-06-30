<script setup>

import {Head, Link, useForm} from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps(
    {microSite: Object}
);


</script>
<template>

    <div class="min-h-screen flex items-center justify-center bg-gray-900 p-6">
        <div class="max-w-7xl mx-auto py-4">
            <div class="">
                <h1 class="text-white text-3xl">{{microSite.name}}</h1>
                <h2 class="text-white text-2xl">Simple Payments, Simple Living</h2>
                <br>
                <Link
                    :href="route('home')"
                    class="px-3 py-2 text-white font-semibold bg-gray-500 hover:bg-indigo-700 rounded"
                >Back</Link
                >
            </div>
        </div>
        <div class="max-w-lg w-full bg-gray-700 p-8 rounded-lg shadow-md">
            <img class="h-32 w-32 sm:h-40 sm:w-40 flex-none rounded-md bg-gray-50 mx-auto" :src="microSite.img_url" alt="">
            <h2 class="text-2xl font-bold mb-6 text-white">Suscription</h2>
            <form @submit.prevent="handleSubmit">
                <div class="mb-4">
                    <InputLabel for="reference" class="block text-sm font-medium text-gray-700">Document *</InputLabel>
                    <TextInput id="reference" v-model="reference" type="text" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                </div>
                <div class="mb-4">
                    <InputLabel for="description" class="block text-sm font-medium text-gray-700">Payment Descripcion *</InputLabel>
                    <TextInput id="description" v-model="description" type="text" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                </div>
                <div class="mb-4">
                    <InputLabel for="currency" class="block text-sm font-medium text-gray-700">Plan *</InputLabel>
                    <select id="currency" v-model="plan" required class = "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        <option value="1 Month">1 Month</option>
                        <option value="3 Month">1 Month</option>
                        <option value="1 Year">1 Year</option>
                        <option value="forever">Forever</option>
                    </select>
                </div>
                <div class="mb-4">
                    <InputLabel for="currency" class="block text-sm font-medium text-gray-700">Currency *</InputLabel>
                    <select id="currency" v-model="currency" required class = "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        <option value="COP">COP</option>
                        <option value="USD">USD</option>
                    </select>
                </div>
                <div class="mb-4">
                    <InputLabel for="amount" class="block text-sm font-medium text-gray-700">Amount *</InputLabel>
                    <TextInput id="amount" v-model="amount" type="number" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-3 py-2 text-white font-semibold bg-gray-500 hover:bg-indigo-700 rounded">Pay</button>
                </div>
            </form>
        </div>
    </div>

</template>

