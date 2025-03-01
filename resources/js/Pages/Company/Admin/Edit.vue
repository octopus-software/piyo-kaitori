<template>
    <Head>
        <title>企業編集画面</title>
    </Head>

    <AdminAuthenticatedLayout>
        <div class="relative overflow-x-auto">
            <div
                class="block w-full mb-4 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">企業編集</h5>
                <!--                <p class="font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>-->
                <div class="mx-auto">
                    <div v-if="Object.keys(serverErrors).length" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>
                            <li v-for="(messages, field) in serverErrors" :key="field">
                                <span v-for="message in messages" :key="message">{{ message }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="flex">
                        <div class="mb-5 p-2 w-[50%]">
                            <label for="name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">企業名</label>
                            <input type="text" :value="values.name" id="name"
                                   @input="(e) => setFieldValue('name', e.target.value)"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="" required/>
                            <InputError v-if="errors.name" :message="errors.name" class="text-red-500"/>
                        </div>
                        <div class="mb-5 p-2 w-[50%]">
                            <label for="email"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Eメール</label>
                            <input type="text" :value="values.email" id="email"
                                   @input="(e) => setFieldValue('email', e.target.value)"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="" required/>
                            <InputError v-if="errors.email" :message="errors.email" class="text-red-500"/>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-5 p-2 w-[50%]">
                            <label for="address"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">住所</label>
                            <input type="text" :value="values.address" id="address"
                                   @input="(e) => setFieldValue('address', e.target.value)"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="" required/>
                            <InputError v-if="errors.address" :message="errors.address" class="text-red-500"/>
                        </div>
                        <div class="mb-5 p-2 w-[50%]">
                            <label for="representative_name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">代表者名</label>
                            <input type="text" :value="values.representative_name" id="representative_name"
                                   @input="(e) => setFieldValue('representative_name', e.target.value)"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="" required/>
                            <InputError v-if="errors.representative_name" :message="errors.representative_name"
                                        class="text-red-500"/>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-5 p-2 w-[50%]">
                            <label for="tel"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">電話番号</label>
                            <input type="text" :value="values.tel" id="tel"
                                   @input="(e) => setFieldValue('tel', e.target.value)"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="" required/>
                            <InputError v-if="errors.tel" :message="errors.tel" class="text-red-500"/>
                        </div>
                        <div class="mb-5 p-2 w-[50%]">
                            <label for="line_id"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">LINE ID</label>
                            <input type="text" :value="values.line_id" id="line_id"
                                   @input="(e) => setFieldValue('line_id', e.target.value)"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="" />
                            <InputError v-if="errors.line_id" :message="errors.line_id" class="text-red-500"/>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-5 p-2 w-[50%]">
                            <label for="secondhand_dealer_license_number"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">古物商許可証番号</label>
                            <input type="text" :value="values.secondhand_dealer_license_number" id="secondhand_dealer_license_number"
                                   @input="(e) => setFieldValue('secondhand_dealer_license_number', e.target.value)"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="" required/>
                            <InputError v-if="errors.secondhand_dealer_license_number" :message="errors.secondhand_dealer_license_number"
                                        class="text-red-500"/>
                        </div>
                        <div class="mb-5 p-2 w-[50%]">
                            <label for="send_address"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">送付先住所</label>
                            <input type="text" :value="values.send_address" id="send_address"
                                   @input="(e) => setFieldValue('send_address', e.target.value)"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="" />
                            <InputError v-if="errors.send_address" :message="errors.send_address" class="text-red-500"/>
                        </div>
                    </div>

                    <BlueButton text="更新する" @click="updateCompany"/>
                </div>
            </div>
        </div>
    </AdminAuthenticatedLayout>
</template>

<script setup lang="ts">
import {Head, router} from '@inertiajs/vue3';
import {defineProps, ref} from "vue";
import AdminAuthenticatedLayout from "@/Layouts/AdminAuthenticatedLayout.vue";
import {useToast} from "vue-toast-notification";
import {object} from "yup";
import {useForm} from "vee-validate";
import InputError from "@/Components/InputError.vue";
import BlueButton from "@/Components/Button/BlueButton.vue";

type Company = {
    id: number;
    user_id: number;
    name: string;
    email: string;
    address: string
    representative_name: string;
    tel: string;
    line_id: string;
    secondhand_dealer_license_number: string;
    send_address: string;
}

const serverErrors = ref({});
const toast = useToast();
const props = defineProps<{
    company: Company;
}>();

const schema = object({
    // name: string().required('企業名は必須項目です'),
    // email: string().required('メールアドレスは必須項目です').email('メールアドレスの形式が正しくありません'),
    // address: string().required('住所は必須項目です'),
    // representative_name: string().required('代表者名は必須項目です'),
    // tel: string().required('電話番号は必須項目です'),
    // line_id: string(),
    // secondhand_dealer_license_number: string().required('古物商許可証番号は必須項目です'),
    // send_address: string().required('送付先住所は必須項目です'),
});

const {handleSubmit, errors, values, setFieldValue} = useForm({
    validationSchema: schema,
    initialValues: {
        name: props.company.name,
        email: props.company.email,
        address: props.company.address,
        representative_name: props.company.representative_name,
        tel: props.company.tel,
        line_id: props.company.line_id ?? '',
        secondhand_dealer_license_number: props.company.secondhand_dealer_license_number,
        send_address: props.company.send_address,
    }
});

const updateCompany = () => {
    const toast = useToast() as { success: (message: string, options?: Record<string, any>) => void;};
    router.put(route('admin.company.update', {id: props.company.id}), {
        name: values.name,
        email: values.email,
        address: values.address,
        representative_name: values.representative_name,
        tel: values.tel,
        line_id: values.line_id,
        secondhand_dealer_license_number: values.secondhand_dealer_license_number,
        send_address: values.send_address,
    }, {
        headers: {
            'Content-Type': 'application/json'
        },
        onSuccess: () => toast.success('企業を更新しました', {duration: 5000}),
        onError: (errors) => {
            serverErrors.value = errors;
        },
    });
};

</script>
