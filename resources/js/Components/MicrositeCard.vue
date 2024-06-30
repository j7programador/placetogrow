<template>
    <div class="group bg-gray-300 dark:bg-gray-800 shadow-lg rounded p-1">
        <div class="relative">
            <span ><slot /></span>
        </div>
        <div class="p-2">
            <span>{{ value }}</span>
        </div>
    </div>
</template>
<script setup>
defineProps({
    value: {
        type: String,
    },
});
</script>
