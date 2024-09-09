<script setup>

import {Head, Link, useForm} from '@inertiajs/vue3';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import axios from "axios";
import { ref } from 'vue';
import InputError from "@/Components/InputError.vue";

const props = defineProps(
    {microSite: Object, documentTypes: Array, gateways: Array, plan: Object}
);

const form = useForm({
        reference: '',
        email: '',
        plan: props.plan,
        microsite_id: props.microSite.id,
}
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
                    <h2 class="text-xl font-bold mb-6 text-white">Plan</h2>
                        <div class="mb-4">
                            <p class="block text-sm font-medium text-gray-300">
                                {{ plan.name }}
                            </p>
                        </div>
                        <div class="mb-4">
                        <p class="block text-sm font-medium text-gray-300">
                            {{plan.currency}} ${{ plan.amount }} {{plan.billing_cycle}}
                        </p>
                     </div>

                </div>
                <div class="max-w-lg w-full bg-gray-700 p-8 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold mb-6 text-white">Pay</h2>
                        <div class="mb-4">

                            <InputLabel for="reference" class="block text-sm font-medium text-gray-700">
                                Reference
                            </InputLabel>
                            <TextInput id="reference" v-model="form.reference" type="text"
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"/>
                            <InputError class="mt-2" :message="form.errors.reference" />
                        </div>
                        <div class="mb-4">

                            <InputLabel for="email" class="block text-sm font-medium text-gray-700">
                                Email
                            </InputLabel>
                            <TextInput id="email" v-model="form.email" type="email"
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"/>
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                            class="px-3 py-2 text-white font-semibold bg-gray-500 hover:bg-indigo-700 rounded">Subscribirse
                    </button>
                </div>
            </form>
        </div>
    </div>

</template>

