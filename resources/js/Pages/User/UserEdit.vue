<template>
    <AuthenticatedLayout>
        <div class="relative overflow-x-auto">
            <div
                class="block w-full mb-4 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">ユーザー編集</h5>
                <!--                <p class="font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>-->
                <div class="mx-auto">
                    <div class="flex">
                        <div class="mb-5 p-2 w-[20%]">
                            <label for="id"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ユーザーID</label>
                            <input type="text" :value="user.id" id="name" disabled
                                   class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-1000 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required/>
                        </div>
                        <div class="mb-5 p-2 w-[30%]">
                            <label for="name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ユーザー名</label>
                            <input type="text" :value="user.name" id="name" disabled
                                   class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required/>
                        </div>
                        <div class="mb-5 p-2 w-[50%]">
                            <label for="email"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Eメール</label>
                            <input type="email" :value="user.email" id="email" disabled
                                   class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="name@flowbite.com" required/>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="mb-5 p-2 w-[100%]">
                            <div class="inline-flex items-center">
                                <label class="relative flex items-center p-3 -mt-5 rounded-full cursor-pointer"
                                       htmlFor="description">
                                    <input type="checkbox" :checked="user.is_active" v-model="user.is_active"
                                           class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-gray-900 checked:bg-gray-900 checked:before:bg-gray-900 hover:before:opacity-10"
                                           id="description"/>
                                    <span
                                        class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100"><svg
                                        xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                        fill="currentColor" stroke="currentColor" stroke-width="1"><path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path></svg></span>
                                </label>
                                <label class="mt-px font-light text-gray-700 cursor-pointer select-none"
                                       htmlFor="description">
                                    <div>
                                        <p class="block font-sans text-base antialiased font-medium leading-relaxed text-blue-gray-900">
                                            現在取引中である
                                        </p>
                                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-gray-700">
                                            チェックの入っていないユーザーの買取オファーは非表示となります。
                                        </p>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <BlueButton text="編集する" :onclick="updateUser"/>
                    <DeleteButton text="削除する" :onclick="deleteUser"/>
                    <GrayButton text="戻る" :onclick="goBack"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup lang="ts">
import {useToast} from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {ref} from "vue";
import BlueButton from "../../Components/Button/BlueButton.vue";
import GrayButton from "../../Components/Button/GrayButton.vue";
import DeleteButton from "../../Components/Button/DeleteButton.vue";
import {router} from '@inertiajs/vue3';
import {defineProps} from 'vue';
import {Inertia} from "@inertiajs/inertia";

const toast = useToast();
const props = defineProps<{
    user: {
        id: number,
        name: string,
        email: string,
        is_active: boolean,
    }
}>();
const user = ref({...props.user});
console.log(user.value);

const goBack = () => {
    router.get(route('user.list'));
}

const updateUser = async () => {
    try {
        await router.put(route('user.update', user.value.id), {
            is_active: user.value.is_active,
        });
        toast.success('データが更新されました');
    } catch (error) {
        toast.error(error.response.data.message);
    }
};

const deleteUser = async (): Promise<void> => {
    try {
        await router.delete(route('user.delete', user.value.id));
        sessionStorage.setItem('toastMessage', 'データが削除されました');
        // Inertia.visit(route('user.list'));
    } catch (error) {
        const toast = useToast();
        toast.error(error.response.data.message);
    }
};

</script>

<style scoped>

</style>
