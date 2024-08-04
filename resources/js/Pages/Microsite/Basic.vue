<script setup>

import {Inertia} from "@inertiajs/inertia";
import {Link, useForm} from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps(
    {
        microSite: Object,
        documentTypes:Array,
        gateways:Array,
    }
);

const microsite_id = props.microSite.id;

const form = useForm({
    reference:'',
    description:'',
    currency:'',
    amount:0,
    email:'',
    site_id:microsite_id,
    document_number:'',
    document_type:'',
    name:'',
    last_name:'',
    gateway:'',

});

const submit = async () => {
    try {
        const response = await axios.post(route('payments.store'), form.data());
        if (response.data.url) {
            window.location.href = response.data.url;
        }
    } catch (error) {
        console.error('An error occurred', error);
    }
};


</script>
<template>

    <div class="min-h-screen flex-col items-center justify-center bg-gray-900 p-6">
        <div class="max-w-7xl mx-auto py-4">
            <div class="items-center">
                <img class="h-32 w-32 sm:h-40 sm:w-40 flex-none rounded-md bg-gray-50 mx-auto" :src="microSite.img_url"
                     alt="">
                <h1 class="text-white text-3xl">{{ microSite.name }}</h1>
                <h2 class="text-white text-2xl">Simple Payments, Simple Living</h2>
                <h2 class="text-2xl font-bold mb-6 text-white items-center">Basic Pay</h2>
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
                    <div class="mb-4">
                        <InputLabel for="name" class="block text-sm font-medium text-gray-700">Name</InputLabel>
                        <TextInput id="name" v-model="form.name" type="text"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"/>
                    </div>
                    <div class="mb-4">
                        <InputLabel for="last_name" class="block text-sm font-medium text-gray-700">Last Name
                        </InputLabel>
                        <TextInput id="last_name" v-model="form.last_name" type="text"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"/>
                    </div>
                    <div class="mb-4">
                        <InputLabel for="document_number" class="block text-sm font-medium text-gray-700">Document
                            Number
                        </InputLabel>
                        <TextInput id="document_number" v-model="form.document_number" type="text"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"/>
                    </div>
                    <div>
                        <InputLabel for="document_type" value="Document type"/>
                        <select
                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            id="document_type" v-model="form.document_type" required>
                            <option v-for="type in documentTypes" :key="type" :value="type">{{ type }}</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <InputLabel for="email" class="block text-sm font-medium text-gray-700">Email</InputLabel>
                        <TextInput id="email" v-model="form.email" type="email"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"/>
                    </div>
                </div>
                <div class="max-w-lg w-full bg-gray-700 p-8 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold mb-6 text-white">Pay</h2>
                    <div class="mb-4">
                        <InputLabel for="reference" class="block text-sm font-medium text-gray-700">Reference *
                        </InputLabel>
                        <TextInput id="reference" v-model="form.reference" type="text" required
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"/>
                    </div>
                    <div class="mb-4">
                        <InputLabel for="description" class="block text-sm font-medium text-gray-700">Payment
                            Descripcion *
                        </InputLabel>
                        <TextInput id="description" v-model="form.description" type="text" required
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"/>
                    </div>
                    <div class="mb-4">
                        <InputLabel for="currency" class="block text-sm font-medium text-gray-700">Currency *
                        </InputLabel>
                        <select id="currency" v-model="form.currency" required
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="COP">COP</option>
                            <option value="USD">USD</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <InputLabel for="amount" class="block text-sm font-medium text-gray-700">Amount *</InputLabel>
                        <TextInput id="amount" v-model="form.amount" type="numeric" required
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"/>
                    </div>
                    <div>
                        <InputLabel for="gateway" value="Payment Gateway"/>
                        <select
                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            id="document_type" v-model="form.gateway" required>
                            <option v-for="gateway in gateways" :key="gateway" :value="gateway">{{ gateway }}</option>
                        </select>
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
