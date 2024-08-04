<script setup>

import {Head, useForm} from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";

const props = defineProps(
    {
        microSite: Object,
        category: Object,
        payments: Array,
    }
);

</script>

<template>
    <Head title="Create Microsite"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">View Microsite</h2>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    <h2
                        class="dark:text-gray-200">{{ microSite.name }}</h2>

                </div>
                <div>
                    <img class="h-40 w-40 flex-none rounded-full bg-gray-50" :src="microSite.img_url" alt="">
                </div>
                <div>
                    <InputLabel for="name" value="Slug"/>
                    <p
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                        focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500
                        dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ microSite.slug }}</p>

                </div>
                <div>
                    <InputLabel for="document_type" value="Document type"/>
                    <p
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                            focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500
                            dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ microSite.document_type }}</p>

                </div>
                <div>
                    <InputLabel for="name" value="Document"/>
                    <p
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                            focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500
                            dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ microSite.document }}</p>

                </div>
                <div>
                    <InputLabel for="name" value="Category"/>
                    <p
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                            focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500
                            dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ category.name }}</p>

                </div>
                <div>
                    <InputLabel for="name" value="Type"/>
                    <p
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                            focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500
                            dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ microSite.type_microsite }}</p>

                </div>

                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 sm:px-20 bg-gray-700 text-white border-b border-gray-200">
                                <div class="mt-8 text-2xl">
                                    Payments
                                </div>
                            </div>
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        scope="col"
                                        class="
                            py-3.5
                            pl-4
                            pr-3
                            px-8
                            text-left text-sm
                            font-semibold
                            text-gray-900
                            sm:pl-6
                          "
                                    >
                                        Reference
                                    </th>
                                    <th
                                        scope="col"
                                        class="
                            px-8
                            py-3.5
                            text-left text-sm
                            font-semibold
                            text-gray-900
                          "
                                    >
                                        Amount
                                    </th>
                                    <th
                                        scope="col"
                                        class="
                            px-8
                            py-3.5
                            text-left text-sm
                            font-semibold
                            text-gray-900
                          "
                                    >
                                        Gateway
                                    </th>
                                    <th
                                        scope="col"
                                        class="
                            px-8
                            py-3.5
                            text-left text-sm
                            font-semibold
                            text-gray-900
                          "
                                    >
                                        Status
                                    </th>
                                </tr>
                                </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr
                                        v-for="payment in payments"
                                        :key="payment.id"
                                    >
                                        <td
                                            class="
                            whitespace-nowrap
                            py-4
                            pl-4
                            pr-3
                            text-sm
                            font-medium
                            text-gray-900
                            sm:pl-6
                          "
                                        >
                                            {{payment.reference}}
                                        </td>
                                        <td
                                            class="
                            whitespace-nowrap
                            px-3
                            py-4
                            text-sm text-gray-500
                          "
                                        >
                                            {{ payment.amount }}
                                        </td>
                                        <td
                                            class="
                            whitespace-nowrap
                            px-3
                            py-4
                            text-sm text-gray-500
                          "
                                        >
                                            {{ payment.gateway }}
                                        </td>
                                        <td
                                            class="
                            whitespace-nowrap
                            px-3
                            py-4
                            text-sm text-gray-500
                          "
                                        >
                                            {{ payment.status }}
                                        </td>
                                    </tr>
                                    </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
