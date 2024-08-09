<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import VueMultiselect from "vue-multiselect";
import { onMounted, watch } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";


const props = defineProps({
    microsite: {
        type: Object,
        required: true,
    },
    fields: Array,
    fieldsDisabled:Array,
});
const form = useForm({
    name: props.microsite.name,
    siteId: props.microsite.id,
    fields: [],
});

onMounted(() => {
    form.fields = props.fields;
});

watch(
    () => props.microsite,
    () => (form.fields = props.fields)
);

</script>

<template>
    <Head title="Update role" />

    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <Link
                    :href="route('fields.index')"
                    class="px-3 py-2 text-white font-semibold bg-gray-500 hover:bg-indigo-700 rounded"
                >Back</Link
                >
            </div>
            <div class="mt-6 max-w-6xl mx-auto dark:bg-gray-800 shadow-lg rounded-lg p-6">
                <h1 class="text-2xl font-semibold text-gray-100">Update fields</h1>
                <form @submit.prevent="form.put(route('fields.update', microsite.id))">
                    <div class="mt-4">
                        <InputLabel for="name" value="Name" />
                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            autocomplete="username"
                        />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div class="mt-4">
                        <InputLabel for="fields" value="Fields" />
                        <VueMultiselect
                            v-model="form.fields"
                            :options="props.microsite.fields"
                            :multiple="true"
                            :close-on-select="true"
                            placeholder="Pick some"
                            label="label"
                            track-by="id"
                        />
                    </div>
                    <div class="flex items-center mt-4">
                        <PrimaryButton
                            class="ml-4"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Update
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>
