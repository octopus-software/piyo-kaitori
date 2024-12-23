<template>
    <AuthenticatedLayout>
        <div class="relative overflow-x-auto">
            <div
                class="block w-full mb-4 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">買取対象編集</h5>
                <div class="mx-auto">
                    <div>
                        <div class="flex">
                            <div class="mb-5 p-2 w-[20%]">
                                <label for="id"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">買取対象ID</label>
                                <input type="text" :value="purchaseTarget.id" id="id" disabled
                                       class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-1000 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       required/>
                            </div>
                            <div class="mb-5 p-2 w-[30%]">
                                <label for="name"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">買取対象名</label>
                                <input type="text" v-model="name" id="name"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       :class="{ 'bg-red-100': nameError, 'border-red-300': nameError }"
                                       required/>
                                <InputError v-if="nameError" :message="nameError" class="text-red-500"/>
                            </div>
                            <div class="mb-5 p-2 w-[50%]">
                                <label for="jan_code"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">JANコード</label>
                                <input type="text" v-model="jan_code" id="jan_code"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       :class="{ 'bg-red-100': janCodeError, 'border-red-300': janCodeError }"
                                       placeholder="name@flowbite.com" required/>
                                <InputError v-if="janCodeError" :message="janCodeError" class="text-red-500"/>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex">
                            <div class="mb-5 p-2 w-[20%]">
                                <label for="email"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">買取希望数</label>
                                <input type="number" v-model="amount" id="email" min="1"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       :class="{ 'bg-red-100': amountError, 'border-red-300': amountError }"
                                       required/>
                                <InputError v-if="amountError" :message="amountError" class="text-red-500"/>
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
                        <Checkbox value="1" :checked="Boolean(is_active)" label="現在買取中である" subLabel="チェックの入っていない買取対象はユーザーの買取一覧から非表示になります" @update:checked="handleUpdateChecked" />
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
import {ref, watch} from "vue";
import BlueButton from "../../Components/Button/BlueButton.vue";
import GrayButton from "../../Components/Button/GrayButton.vue";
import DeleteButton from "../../Components/Button/DeleteButton.vue";
import {defineProps} from 'vue';
import {router} from "@inertiajs/vue3";
import {string, object, bool} from "yup";
import {useField, useForm} from "vee-validate";
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

const purchaseTarget = ref(props.purchase_target);
const previewImage = ref(props.purchase_target.image_url);
const newImage = ref(null);

const schema = object({
    name: string().required('買取対象名は必須項目です'),
    jan_code: string().required('JANコードは必須項目です').max(13, 'JANコードは13桁以下で入力してください'),
    amount: string().required('買取希望数は必須項目です').min(1, '少なくとも1以上を指定してください'),
    is_active: bool().required('買取中フラグは必須項目です'),
});

const {handleSubmit, errors} = useForm({
    validationSchema: schema,
    initialValues: {
        name: purchaseTarget.value.name,
        jan_code: purchaseTarget.value.jan_code,
        amount: purchaseTarget.value.amount,
        is_active: purchaseTarget.value.is_active,
    }
});

const handleUpdateChecked = (newValue: number) => {
    is_active.value = newValue;
};

const {value: name, errorMessage: nameError} = useField('name');
const {value: jan_code, errorMessage: janCodeError} = useField('jan_code');
const {value: amount, errorMessage: amountError} = useField('amount');
const {value: is_active} = useField('is_active');

watch(purchaseTarget, (newValue) => {
    name.value = newValue.name;
    jan_code.value = newValue.jan_code;
    amount.value = newValue.amount;
    is_active.value = newValue.is_active;
}, {deep: true});

const goBack = async () => {
    await router.get(route('purchase_target.list'));
}

/**
 *
 * @returns {Promise<void>}
 */
const updatePurchaseTarget = async () => {
    try {
        await router.post(route('purchase_target.update', purchaseTarget.value.id), {
            _method: "PUT",
            name: name.value,
            jan_code: jan_code.value,
            amount: amount.value,
            image_file: newImage.value,
            is_active: Number(is_active.value),
            image_url: purchaseTarget.value.image_url,
        }, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
        const toast = useToast();
        await toast.success('データが更新されました')
    } catch (error) {
        const toast = useToast();
        toast.error(error.response.data.message);
    }
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
