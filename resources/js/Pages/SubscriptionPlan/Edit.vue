<script setup>

import {Head, useForm} from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";


const props = defineProps(
    {subscriptionPlan: Object,
        currencies: Array,
        billingFrequencies: Array,
        sites: Array,
        types: Array,
    },
);

const form = useForm({
    name: props.subscriptionPlan.name,
    amount: props.subscriptionPlan.amount,
    description: props.subscriptionPlan.description,
    currency: props.subscriptionPlan.currency,
    site_id: props.subscriptionPlan.site_id,
    billing_cycle: props.subscriptionPlan.billing_cycle,
    subscription_expiration:props.subscriptionPlan.subscription_expiration,
    process_identifier:props.subscriptionPlan.process_identifier,
    type: props.subscriptionPlan.type,
});

const submit = () => {

    form.put(route('subscriptionplan.update', props.subscriptionPlan.id), {
        onError: () => {
            console.log(props.subscriptionPlan.id);
            console.error('An error occurred');
        },
        onSuccess: () => {
            console.log('Subscription Plan updated successfully');
        }
    });
};

</script>

<template>
    <Head title="Edit Plan" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Plan</h2>
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
                    <br>
                    <div>
                        <InputLabel for="amount" value="Amount" />

                        <TextInput
                            id="amount"
                            type="number"
                            class="mt-1 block w-full"
                            v-model="form.amount"
                            required
                            autofocus
                            autocomplete="amount"
                        />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <br>
                    <div>
                        <InputLabel for="description" value="Description" />

                        <TextInput
                            id="description"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.description"
                            required
                            autofocus
                            autocomplete="description"
                        />
                        <InputError class="mt-2" :message="form.errors.description" />
                    </div>
                    <br>
                    <div>
                        <InputLabel for="currency" value="Currency" />
                        <select class = "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                id="category" v-model="form.currency" required>
                            <option v-for="currency in currencies" :key="currency" :value="currency">{{ currency }}</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.currency" />
                    </div>
                    <br>
                    <div>
                        <InputLabel for="currency" value="Billing Cycle" />
                        <select class = "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                id="category" v-model="form.billing_cycle" required>
                            <option v-for="billing_cycle in billingFrequencies" :key="billing_cycle" :value="billing_cycle">{{ billing_cycle }}</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.billing_cycle" />
                    </div>
                    <br>
                    <div>
                        <InputLabel for="subscription_expiration" value="Expiration" />

                        <TextInput
                            id="subscription_expiration"
                            type="number"
                            class="mt-1 block w-full"
                            v-model="form.subscription_expiration"
                            required
                            autofocus
                            autocomplete="subscription_expiration"
                        />
                        <InputError class="mt-2" :message="form.errors.subscription_expiration" />
                    </div>
                    <div>
                        <InputLabel for="process_identifier" value="Identifier" />

                        <TextInput
                            id="process_identifier"
                            type="number"
                            class="mt-1 block w-full"
                            v-model="form.process_identifier"
                            required
                            autofocus
                            autocomplete="process_identifier"
                        />
                        <InputError class="mt-2" :message="form.errors.process_identifier" />
                    </div>
                    <br>
                    <div>
                        <InputLabel for="type" value="Type" />
                        <select class = "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                id="type" v-model="form.type" required>
                            <option v-for="type in types" :key="type" :value="type">{{ type }}</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.type" />
                    </div>
                    <br>
                    <div>
                        <InputLabel for="site" value="Site" />
                        <select class = "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                id="category" v-model="form.site_id" required>
                            <option v-for="site in sites" :key="site" :value="site.id">{{ site.name }}</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.site_id" />
                    </div>
                    <br>
                    <PrimaryButton type="submit">Edit</PrimaryButton>
                </form>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
