<template>
    <AdminAuthenticatedLayout>
        <div class="relative overflow-x-auto">
            <div
                class="block w-full mb-4 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">ユーザー編集</h5>
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
                                <label class="relative flex items-center p-3 -mt-5 rounded-full cursor-pointer">
                                    <Checkbox value="1" :checked="Boolean(values.is_active)" label="現在取引中である" subLabel="チェックの入っていないユーザーの買取オファーは非表示となります" @update:checked="handleUpdateChecked" />
                                    <span
                                        class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100"><svg
                                        xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                        fill="currentColor" stroke="currentColor" stroke-width="1"><path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path></svg></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <BlueButton text="編集する" @click="updateUser"/>
                    <DeleteButton text="削除する" :onclick="deleteUser"/>
                    <GrayButton text="戻る" @click="goBack"/>
                </div>
            </div>
        </div>
    </AdminAuthenticatedLayout>
</template>

<script setup lang="ts">
import {useToast} from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import AdminAuthenticatedLayout from '@/Layouts/AdminAuthenticatedLayout.vue';
import BlueButton from "@/Components/Button/BlueButton.vue";
import GrayButton from "@/Components/Button/GrayButton.vue";
import DeleteButton from "@/Components/Button/DeleteButton.vue";
import {router} from '@inertiajs/vue3';
import {defineProps} from 'vue';
import {bool, object} from "yup";
import {useForm} from "vee-validate";
import Checkbox from "@/Components/Input/Checkbox.vue";

type UserType = {
    id: number,
    name: string,
    email: string,
    is_active: number,
}

const toast = useToast();
const props = defineProps<{
    user: UserType
}>();

const schema = object({
    is_active: bool().required('取引中フラグは必須項目です'),
});

const {handleSubmit, errors, values, setFieldValue} = useForm({
    validationSchema: schema,
    initialValues: {
        is_active: props.user.is_active,
    }
});

const handleUpdateChecked = (newValue: number) => setFieldValue('is_active', newValue);

const goBack = () => router.get(route('admin.user.list'));

const updateUser = async () => {
    console.log(values)
    try {
        await router.put(route('admin.user.update', props.user.id), {
            is_active: values.is_active,
        });
        toast.success('データが更新されました');
    } catch (error) {
        toast.error(error.response.data.message);
    }
};

const deleteUser = async (): Promise<void> => {
    try {
        await router.delete(route('admin.user.delete', props.user.id));
        sessionStorage.setItem('toastMessage', 'データが削除されました');
    } catch (error) {
        const toast = useToast();
        toast.error(error.response.data.message);
    }
};

</script>

<style scoped>

</style>
