<template>
    <button @click="showModal = true"
            class="m-2 text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        {{ text }}
    </button>
    <div v-if="showModal" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-800 bg-opacity-75 overflow-x-hidden overflow-y-auto h-full w-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        本当に削除しますか？
                    </h3>
                    <button @click="showModal = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <RedButton text="削除する" @click="onClick" />
                    <GrayButton text="キャンセル" @click="showModal = false" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, defineProps } from 'vue';
import RedButton from "./RedButton.vue";
import GrayButton from "./GrayButton.vue";

const props = defineProps<{
    text: string;
    onclick: () => void;
}>();

const showModal = ref(false);

const onClick = () => {
    showModal.value = false;
    props.onclick();
};
</script>

<style scoped>
</style>
