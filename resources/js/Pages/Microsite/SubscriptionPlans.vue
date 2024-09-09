<script setup>

import {Head, Link, useForm} from '@inertiajs/vue3';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import axios from "axios";
import { ref } from 'vue';
import MicrositeCard from "@/Components/MicrositeCard.vue";

const props = defineProps(
    {microSite: Object, documentTypes: Array, gateways: Array, subscriptionPlans: Array}
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
            <main class="max-w-6xl mx-auto mt-6 min-h-screen">
                <section class="bg-gray-200 dark:bg-gray-900 dark:text-white mt-4 p-2 rounded">
                    <div class="grid grid-cols-5 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-5 rounded">
                        <div v-for="subscriptionPlan in subscriptionPlans" :key="subscriptionPlan.id">
                            <MicrositeCard>
                                <Link :href="`/micrositeSubscription/${microSite.slug}/${subscriptionPlan.id}`">
                                    <div class="aspect-w-2 aspect-h-3">
                                        <p class="text-gray-400">{{ subscriptionPlan.name }}</p>
                                        <p class="text-gray-300">{{ subscriptionPlan.type }}</p>
                                        <p class="text-gray-300">Amount {{ subscriptionPlan.currency }} ${{ subscriptionPlan.amount }} {{ subscriptionPlan.billing_cycle }}</p>
                                    </div>
                                </Link>
                            </MicrositeCard>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>

</template>

