<template>
    <button
        class="m-2 text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        {{ text }}
    </button>
</template>

<script setup lang="ts">
import {defineProps} from 'vue';

const props = defineProps<{
    text: string
}>()
</script>

<style scoped>

</style>
