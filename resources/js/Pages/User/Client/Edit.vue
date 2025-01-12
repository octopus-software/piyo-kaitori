<template>
    <ClientAuthenticatedLayout>
        <div class="relative overflow-x-auto">
            <div
                class="block w-full mb-4 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">ユーザー編集</h5>
                <div class="mx-auto">
                    <div class="flex">
                        <div class="mb-5 p-2 w-[30%]">
                            <label for="name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ユーザー名</label>
                            <input type="text" :value="values.name" id="name"
                                   @input="(e) => setFieldValue('name', e.target.value)"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required/>
                        </div>
                        <div class="mb-5 p-2 w-[30%]">
                            <label for="name_kana"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ユーザー名(かな)</label>
                            <input type="text" :value="values.name_kana" id="name_kana"
                                   @input="(e) => setFieldValue('name_kana', e.target.value)"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required/>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="mb-5 p-2 w-[30%]">
                            <label for="email"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Eメール</label>
                            <input type="email" :value="values.email" id="email"
                                   @input="(e) => setFieldValue('email', e.target.value)"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="name@flowbite.com" required/>
                        </div>
                        <div class="mb-5 p-2 w-[30%]">
                            <label for="birthday"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">生年月日</label>
                            <input type="date" :value="values.birthday" id="birthday"
                                   @input="(e) => setFieldValue('birthday', e.target.value)"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="name@flowbite.com" required/>
                        </div>
                        <div class="mb-5 p-2 w-[40%]">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">性別</label>
                            <div class="flex items-center space-x-4">
                                <!-- 男性 -->
                                <div class="flex items-center">
                                    <input type="radio" id="male" value="1"
                                           :checked="values.gender === 1"
                                           @change="() => setFieldValue('gender', 1)"
                                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 dark:bg-gray-600 dark:border-gray-500" />
                                    <label for="male" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">男性</label>
                                </div>

                                <!-- 女性 -->
                                <div class="flex items-center ml-4">
                                    <input type="radio" id="female" value="2"
                                           :checked="values.gender === 2"
                                           @change="() => setFieldValue('gender', 2)"
                                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 dark:bg-gray-600 dark:border-gray-500" />
                                    <label for="female" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">女性</label>
                                </div>

                                <!-- その他 -->
                                <div class="flex items-center ml-4">
                                    <input type="radio" id="other" value="3"
                                           :checked="values.gender === 3"
                                           @change="() => setFieldValue('gender', 3)"
                                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 dark:bg-gray-600 dark:border-gray-500" />
                                    <label for="other" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">その他</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="mb-5 p-2 w-[30%]">
                            <label for="post_code"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">郵便番号</label>
                            <input type="text" :value="values.post_code" id="post_code"
                                   @input="(e) => setFieldValue('post_code', e.target.value)"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required/>
                        </div>
                        <div class="mb-5 p-2 w-[70%]">
                            <label for="address"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">郵便番号</label>
                            <input type="text" :value="values.address" id="address"
                                   @input="(e) => setFieldValue('address', e.target.value)"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required/>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="mb-5 p-2 w-[30%]">
                            <label for="tel"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">電話番号</label>
                            <input type="text" :value="values.tel" id="tel"
                                   @input="(e) => setFieldValue('tel', e.target.value)"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required/>
                        </div>
                        <div class="mb-5 p-2 w-[30%]">
                            <label for="job"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">職業</label>
                            <input type="text" :value="values.job" id="job"
                                   @input="(e) => setFieldValue('job', e.target.value)"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required/>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="mb-5 p-2 w-[30%]">
                            <label for="bank_name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">銀行名</label>
                            <input type="text" :value="values.bank_name" id="bank_name"
                                   @input="(e) => setFieldValue('bank_name', e.target.value)"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required/>
                        </div>
                        <div class="mb-5 p-2 w-[30%]">
                            <label for="bank_branch_name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">支店名</label>
                            <input type="text" :value="values.bank_branch_name" id="bank_branch_name"
                                   @input="(e) => setFieldValue('bank_branch_name', e.target.value)"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required/>
                        </div>
                        <div class="mb-5 p-2 w-[40%]">
                            <label for="bank_branch_code"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">支店コード</label>
                            <input type="text" :value="values.bank_branch_code" id="bank_branch_code"
                                   @input="(e) => setFieldValue('bank_branch_code', e.target.value)"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                      required/>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="mb-5 p-2 w-[30%]">
                            <label for="bank_account_type"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">口座種別</label>
                            <input type="text" :value="values.bank_account_type" id="bank_account_type"
                                   @input="(e) => setFieldValue('bank_account_type', e.target.value)"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required/>
                        </div>
                        <div class="mb-5 p-2 w-[30%]">
                            <label for="bank_account_number"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">口座番号</label>
                            <input type="text" :value="values.bank_account_number" id="bank_account_number"
                                   @input="(e) => setFieldValue('bank_account_number', e.target.value)"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required/>
                        </div>
                        <div class="mb-5 p-2 w-[40%]">
                            <label for="bank_account_name_kana"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">口座名義(カナ)</label>
                            <input type="text" :value="values.bank_account_name_kana" id="bank_account_name_kana"
                                   @input="(e) => setFieldValue('bank_account_name_kana', e.target.value)"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required/>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="mb-5 p-2 w-[50%]">
                            <div class="inline-flex items-center">
                                <label class="relative flex items-center p-3 -mt-5 rounded-full cursor-pointer">
                                    <Checkbox value="1" :checked="Boolean(values.is_qualified_supplier)" label="適格請求書発行事業者である" subLabel="インボイス番号をお持ちの場合はチェックを入れてください" @update:checked="handleUpdateChecked" />
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
                        <div class="mb-5 p-2 w-[30%]">
                            <label for="invoice_number"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">インボイス番号 ※先頭のTは不要です。</label>
                            <input type="text" :value="values.invoice_number" id="invoice_number"
                                   @input="(e) => setFieldValue('invoice_number', e.target.value)"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required/>
                        </div>
                    </div>

                    <BlueButton text="編集する" @click="updateUser"/>
                </div>
            </div>
        </div>
    </ClientAuthenticatedLayout>
</template>

<script setup lang="ts">
import {useToast} from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import AdminAuthenticatedLayout from '@/Layouts/AdminAuthenticatedLayout.vue';
import BlueButton from "@/Components/Button/BlueButton.vue";
import {defineProps} from 'vue';
import {number, object, string} from "yup";
import {useForm} from "vee-validate";
import Checkbox from "@/Components/Input/Checkbox.vue";
import ClientAuthenticatedLayout from "@/Layouts/ClientAuthenticatedLayout.vue";

type UserType = {
    id: number,
    email: string,
    name: string,
    name_kana: string,
    birthday: string,
    gender: number,
    post_code: string,
    address: string,
    tel: string,
    job: string,
    bank_name: string,
    bank_branch_name: string,
    bank_branch_code: string,
    bank_account_type: number,
    bank_account_number: string,
    bank_account_name_kana: string,
    is_qualified_supplier: number,
    invoice_number: string|null,
    is_active: number,
}

const toast = useToast();
const props = defineProps<{
    user: UserType
}>();

const handleUpdateChecked = (newValue: number) => setFieldValue('is_qualified_supplier', newValue);

const schema = object({
    email: string().email('メールアドレスの形式が正しくありません').required('メールアドレスは必須項目です'),
    name: string().required('ユーザー名は必須項目です'),
    name_kana: string().required('ユーザー名(カナ)は必須項目です'),
    birthday: string(),
    gender: number().required('性別は必須項目です'),
    post_code: string(),
    address: string(),
    tel: string(),
    job: string(),
    bank_name: string(),
    bank_branch_name: string(),
    bank_branch_code: string(),
    bank_account_type: number(),
    bank_account_number: string(),
    bank_account_name_kana: string(),
    is_qualified_supplier: number(),
    invoice_number: string().nullable(),
    is_active: number(),
});

const {handleSubmit, errors, values, setFieldValue} = useForm({
    validationSchema: schema,
    initialValues: {
        email: props.user.email,
        name: props.user.name,
        name_kana: props.user.name_kana,
        birthday: props.user.birthday,
        gender: props.user.gender,
        post_code: props.user.post_code,
        address: props.user.address,
        tel: props.user.tel,
        job: props.user.job,
        bank_name: props.user.bank_name,
        bank_branch_name: props.user.bank_branch_name,
        bank_branch_code: props.user.bank_branch_code,
        bank_account_type: props.user.bank_account_type,
        bank_account_number: props.user.bank_account_number,
        bank_account_name_kana: props.user.bank_account_name_kana,
        is_qualified_supplier: props.user.is_qualified_supplier,
        invoice_number: props.user.invoice_number,
        is_active: props.user.is_active,
    }
});

const updateUser = async () => {
    console.log(values)
    // try {
    //     await router.put(route('client.user.update', props.user.id), {
    //         //,
    //     });
    //     toast.success('データが更新されました');
    // } catch (error) {
    //     toast.error(error.response.data.message);
    // }
};

</script>

<style scoped>

</style>
