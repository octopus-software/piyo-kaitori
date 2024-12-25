<template>
    <AuthenticatedLayout>
        <div class="relative overflow-x-auto">
            <div
                class="block w-full mb-4 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">買取対象編集</h5>
                <div class="mx-auto">
                    <div v-if="Object.keys(serverErrors).length"
                         class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>
                            <li v-for="(messages, field) in serverErrors" :key="field">
                                <span v-for="message in messages" :key="message">{{ message }}</span>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <div class="flex">
                            <div class="mb-5 p-2 w-[20%]">
                                <label for="id"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">買取対象ID</label>
                                <input type="text" :value="purchase_target.id" id="id" disabled
                                       class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-1000 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       required/>
                            </div>
                            <div class="mb-5 p-2 w-[30%]">
                                <label for="name"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">買取対象名</label>
                                <input type="text" :value="values.name" id="name"
                                       @input="(e) => setFieldValue('name', e.target.value)"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       :class="{ 'bg-red-100': errors.name, 'border-red-300': errors.name }"
                                       required/>
                                <InputError v-if="errors.name" :message="errors.name" class="text-red-500"/>
                            </div>
                            <div class="mb-5 p-2 w-[50%]">
                                <label for="jan_code"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">JANコード</label>
                                <input type="text" :value="values.jan_code" id="jan_code"
                                       @input="(e) => setFieldValue('jan_code', e.target.value)"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       :class="{ 'bg-red-100': errors.jan_code, 'border-red-300': errors.jan_code }"
                                />
                                <InputError v-if="errors.jan_code" :message="errors.jan_code" class="text-red-500"/>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex">
                            <div class="mb-5 p-2 w-[20%]">
                                <label for="amount"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">買取希望数</label>
                                <input type="number" :value="values.amount" id="amount" min="1"
                                       @input="(e) => setFieldValue('amount', e.target.value)"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       :class="{ 'bg-red-100': errors.amount, 'border-red-300': errors.amount }"
                                       required/>
                                <InputError v-if="errors.amount" :message="errors.amount" class="text-red-500"/>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex">
                            <div class="mb-5 p-2 w-[30%]">
                                <label for="image_url"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">買取対象画像</label>
                                <img :src="previewImage" alt="image" class="w-52"/>
                                <input type="file" id="image_url" @input="onFileChange"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="name@flowbite.com" required/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5 p-2 w-[70%] flex">
                        <Checkbox value="1" :checked="Boolean(values.is_active)" label="現在買取中である"
                                  subLabel="チェックの入っていない買取対象はユーザーの買取一覧から非表示になります" @update:checked="handleUpdateChecked"/>
                    </div>
                    <BlueButton text="編集する" :onclick="handleSubmit(updatePurchaseTarget)"/>
                    <DeleteButton text="削除する" :onclick="deletePurchaseTarget"/>
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
import {defineProps} from 'vue';
import {router} from "@inertiajs/vue3";
import {string, object, bool} from "yup";
import {useForm} from "vee-validate";
import InputError from "@/Components/InputError.vue";
import Checkbox from "@/Components/Input/Checkbox.vue";

const props = defineProps<{
    purchase_target: {
        id: number,
        name: string,
        jan_code: string,
        image_url: string,
        amount: string,
        is_active: number,
        offers: Array<any>,
    }
}>()

const serverErrors = ref({});
const previewImage = ref(props.purchase_target.image_url);
const newImage = ref(null);

const schema = object({
    name: string().required('買取対象名は必須項目です'),
    jan_code: string().required('JANコードは必須項目です').max(13, 'JANコードは13桁以下で入力してください'),
    amount: string().required('買取希望数は必須項目です').min(1, '少なくとも1以上を指定してください'),
    is_active: bool().required('買取中フラグは必須項目です'),
});

const {handleSubmit, errors, values, setFieldValue} = useForm({
    validationSchema: schema,
    initialValues: {
        name: props.purchase_target.name,
        jan_code: props.purchase_target.jan_code,
        amount: props.purchase_target.amount,
        is_active: props.purchase_target.is_active,
    }
});

const handleUpdateChecked = (newValue: number) => setFieldValue('is_active', newValue);

const goBack = async () => {
    await router.get(route('purchase_target.list'));
}

/**
 *
 * @returns {Promise<void>}
 */
const updatePurchaseTarget = async () => {
    const toast = useToast() as { success: (message: string, options?: Record<string, any>) => void;};
    resetServerErrors();
    await router.post(route('purchase_target.update', props.purchase_target.id), {
        _method: "PUT",
        name: values.name,
        jan_code: values.jan_code,
        amount: values.amount,
        image_file: newImage.value,
        is_active: Number(values.is_active),
        image_url: props.purchase_target.image_url,
    }, {
        headers: {
            'Content-Type': 'multipart/form-data'
        },
        onSuccess: () => toast.success('買取対象を更新しました', {duration: 5000}),
        onError: (errors) => {
            serverErrors.value = errors;
        },
    });
};

const resetServerErrors = () => {
    serverErrors.value = {};
};

/**
 *
 * @returns {Promise<void>}
 */
const deletePurchaseTarget = async () => {
    try {
        await router.delete(route('purchase_target.delete', props.purchase_target.id), {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
        sessionStorage.setItem('toastMessage', 'データが削除されました');
    } catch (error) {
        const toast = useToast();
        toast.error(error.response.data.message);
    }
};

const onFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            previewImage.value = e.target.result.toString();
            newImage.value = file;
        };
        reader.readAsDataURL(file);
    }
};

</script>

<style scoped>

</style>
