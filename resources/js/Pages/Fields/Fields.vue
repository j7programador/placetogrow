<script setup>
import { ref } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Table from "@/Components/TableRow.vue";
import TableRow from "@/Components/TableRow.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import TableDataCell from "@/Components/TableDataCell.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import AdminCustomerLayout from "@/Layouts/AdminCustomerLayout.vue";

defineProps(["microsites"]);

</script>

<template>
    <Head title="Fields" />

    <AuthenticatedLayout>
        <AdminCustomerLayout>
            <div class="max-w-7xl mx-auto py-4">

                <div class="flex justify-between">
                    <h1 class="text-white text-2xl">Microsites Fields</h1>
                </div>
                <div class="mt-6">
                    <Table class="items-center">
                        <template #default>
                            <TableRow v-for="microsite in microsites" :key="microsite.id" class="border-b text-white">
                                <TableDataCell>{{ microsite.id }}</TableDataCell>
                                <TableDataCell>{{ microsite.name }}</TableDataCell>
                                <TableDataCell class="space-x-4">
                                    <Link :href="route('fields.edit', microsite.id)" class="text-green-400 hover:text-green-600">Edit</Link>
                                </TableDataCell>
                            </TableRow>
                        </template>
                    </Table>
                </div>
            </div>
        </AdminCustomerLayout>
    </AuthenticatedLayout>
</template>
