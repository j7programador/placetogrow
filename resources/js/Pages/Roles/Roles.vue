<script setup>
import { ref } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Table from "@/Components/TableRow.vue";
import TableRow from "@/Components/TableRow.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import TableDataCell from "@/Components/TableDataCell.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import AdminCustomerLayout from "@/Layouts/AdminCustomerLayout.vue";

defineProps(["roles"]);
const form = useForm({})

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <AdminCustomerLayout>
        <div class="max-w-7xl mx-auto py-4">

            <div class="flex justify-between">
                <h1 class="text-white text-2xl">Roles</h1>
            </div>
            <div class="mt-6">
                <Table class="items-center">
                    <template #default>
                        <TableRow v-for="role in roles" :key="role.id" class="border-b text-white">
                            <TableDataCell>{{ role.id }}</TableDataCell>
                            <TableDataCell>{{ role.name }}</TableDataCell>
                            <TableDataCell class="space-x-4">
                                <Link :href="route('roles.edit', role.id)" class="text-green-400 hover:text-green-600">Edit</Link>
                            </TableDataCell>
                        </TableRow>
                    </template>
                </Table>
            </div>
        </div>
        </AdminCustomerLayout>
    </AuthenticatedLayout>
</template>
