<template>
    <AuthenticatedLayout>
        <div class="relative overflow-x-auto">
            <div
                class="block w-full mb-4 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">買取対象編集</h5>
                <div class="mx-auto">
                    <div v-if="Object.keys(serverErrors).length" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>
                            <li v-for="(messages, field) in serverErrors" :key="field">
                                <span v-for="message in messages" :key="message">{{ message }}</span>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <div class="flex">
                            <div class="mb-5 p-2 w-[50%]">
                                <label for="name"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">買取対象名</label>
                                <input type="text" :value="values.name" id="name"
                                       @input="(e) => setFieldValue('name', e.target.value)"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       :class="{ 'bg-red-100': errors.name, 'border-red-300': errors.name }"
                                />
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
                                <label for="max_quantity"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">買取希望数</label>
                                <input type="number" :value="values.max_quantity" id="max_quantity" min="1"
                                       @input="(e) => setFieldValue('max_quantity', e.target.value)"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       :class="{ 'bg-red-100': errors.max_quantity, 'border-red-300': errors.max_quantity }"
                                       required/>
                                <InputError v-if="errors.max_quantity" :message="errors.max_quantity" class="text-red-500"/>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex">
                            <div class="mb-5 p-2 w-[30%]">
                                <label for="image_url"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">買取対象画像</label>
                                <img v-if="image" :src="previewImage" alt="image" class="w-52"/>
                                <input type="file" id="image_url" @input="onFileChange"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="name@flowbite.com" required/>
                            </div>
                        </div>
                    </div>
                    <BlueButton text="作成する" :onclick="handleSubmit(storePurchaseTarget)"/>
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
import BlueButton from "../../../Components/Button/BlueButton.vue";
import GrayButton from "../../../Components/Button/GrayButton.vue";
import {router} from "@inertiajs/vue3";
import {string, object} from "yup";
import {useForm} from "vee-validate";
import InputError from "@/Components/InputError.vue";

const serverErrors = ref({});

const previewImage = ref('');
const image = ref(null);

const schema = object({
    name: string().required('買取対象名は必須項目です'),
    jan_code: string().required('JANコードは必須項目です').max(13, 'JANコードは13桁以下で入力してください'),
    max_quantity: string().required('買取希望数は必須項目です').min(1, '少なくとも1以上を指定してください'),
});

const {handleSubmit, errors, values, setFieldValue} = useForm({
    validationSchema: schema,
    initialValues: {
        name: '',
        jan_code: '',
        max_quantity: 1,
    }
});

const goBack = async () => {
    await router.get(route('purchase_target.list'));
}

/**
 *
 * @returns {Promise<void>}
 */
const storePurchaseTarget = () => {
    const toast = useToast() as { success: (message: string, options?: Record<string, any>) => void;};
    resetServerErrors();
    router.post(route('purchase_target.store'), {
        name: values.name,
        jan_code: values.jan_code,
        max_quantity: values.max_quantity,
        image_file: image.value,
    }, {
        headers: {
            'Content-Type': 'multipart/form-data'
        },
        onSuccess: () => toast.success('買取対象を作成しました', {duration: 5000}),
        onError: (errors) => {
            serverErrors.value = errors;
        },
    });
};

const resetServerErrors = () => {
    serverErrors.value = {};
};

const onFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            previewImage.value = e.target.result.toString();
            image.value = file;
        };
        reader.readAsDataURL(file);
    }
};

</script>

<style scoped>

</style>
