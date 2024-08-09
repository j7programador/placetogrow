<script setup>

import {Head, Link, useForm} from '@inertiajs/vue3';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import axios from "axios";
import { ref } from 'vue';

const props = defineProps(
    {microSite: Object, documentTypes: Array, gateways: Array}
);

const form = useForm(
    props.microSite.fields.reduce((acc, field) => {
        acc[field.label] = '';
        acc['site_id'] = props.microSite.id;
        return acc;
    }, {})
);

let message = ref("");

const submit = async () => {
    try {
        console.log(form.data());
        const response = await axios.post(route('payments.store'), form.data());

        if (response.data.url) {
            window.location.href = response.data.url;
        } else {
            message.value = response.data.message;
            console.log(message);
        }
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
                <img class="h-32 w-32 sm:h-40 sm:w-40 flex-none rounded-md bg-gray-50 mx-auto" :src="microSite.img_url"
                     alt="">
                <h1 class="text-white text-3xl">{{ microSite.name }}</h1>
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
        <div>
            <form @submit.prevent="submit" class="flex flex-col items-center space-y-6">
                <div class="max-w-lg w-full bg-gray-700 p-8 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold mb-6 text-white">Buyer</h2>
                    <div v-for="field in props.microSite.fields" :key="field.id">

                        <div v-if="field.enabled && field.type !== 'selector' && field.personal_info" class="mb-4">
                            <InputLabel :for="field.label" class="block text-sm font-medium text-gray-700">
                                {{ formatLabel(field.label) }}
                            </InputLabel>
                            <TextInput :id="field.label" v-model="form[field.label]" :type="field.type"
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"/>
                        </div>
                        <div
                            v-if="field.enabled && field.type === 'selector' && field.personal_info && field.label ==='document_type'"
                            class="mb-4">
                            <InputLabel :for="field.label" class="block text-sm font-medium text-gray-700">
                                {{ formatLabel(field.label) }}
                            </InputLabel>
                            <select
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                id="document_type" v-model="form[field.label]" required>
                                <option v-for="type in documentTypes" :key="type" :value="type">{{ type }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="max-w-lg w-full bg-gray-700 p-8 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold mb-6 text-white">Pay</h2>
                    <div v-for="field in props.microSite.fields" :key="field.id">

                        <div v-if="field.enabled && field.type !== 'selector' && !field.personal_info" class="mb-4">
                            <InputLabel :for="field.label" class="block text-sm font-medium text-gray-700">
                                {{ formatLabel(field.label) }}
                            </InputLabel>
                            <TextInput :id="field.label" v-model="form[field.label]" :type="field.type"
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"/>
                        </div>

                        <div
                            v-if="field.enabled && field.type === 'selector' && !field.personal_info && field.label ==='currency'"
                            class="mb-4">
                            <InputLabel :for="field.label" class="block text-sm font-medium text-gray-700">
                                {{ formatLabel(field.label) }}
                            </InputLabel>
                            <select id="currency" v-model="form[field.label]" required
                                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="COP">COP</option>
                                <option value="USD">USD</option>
                            </select>
                        </div>
                        <div
                            v-if="field.enabled && field.type === 'selector' && !field.personal_info && field.label ==='gateway'"
                            class="mb-4">
                            <InputLabel :for="field.label" class="block text-sm font-medium text-gray-700">
                                {{ formatLabel(field.label) }}
                            </InputLabel>
                            <select
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                id="gateway" v-model="form[field.label]" required>
                                <option v-for="gateway in gateways" :key="gateway" :value="gateway">{{
                                        gateway
                                    }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                            class="px-3 py-2 text-white font-semibold bg-gray-500 hover:bg-indigo-700 rounded">Pay
                    </button>
                </div>
            </form>
        </div>
    </div>

</template>

