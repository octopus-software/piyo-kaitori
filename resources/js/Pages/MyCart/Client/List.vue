<template>
    <ClientAuthenticatedLayout>
        <div class="relative overflow-x-auto">
            <div
                class="block w-full mb-4 p-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <div class="flex justify-end">
                    <BlueButton text="買取オファーを作成する" @click="() => console.log('create offer.')"/>
                </div>
            </div>

            <!-- マイカート -->
            <div v-if="cart.length !== 0">
                <!--                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">-->
                <!--                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">-->
                <!--                    <tr>-->
                <!--                        <th scope="col" class="px-6 py-3 w-[10%]">-->
                <!--                            商品画像-->
                <!--                        </th>-->
                <!--                        <th scope="col" class="px-6 py-3 w-[30%]">-->
                <!--                            商品名-->
                <!--                        </th>-->
                <!--                        <th scope="col" class="px-6 py-3 w-[20%]">-->
                <!--                            JANコード-->
                <!--                        </th>-->
                <!--                        <th scope="col" class="px-6 py-3 w-[20%]">-->
                <!--                            買取希望数 (現在 / 上限)-->
                <!--                        </th>-->
                <!--                        <th scope="col" class="px-6 py-3 w-[20%]">-->
                <!--                            買取ステータス-->
                <!--                        </th>-->
                <!--                    </tr>-->
                <!--                    </thead>-->
                <!--                    <tbody>-->
                <!--                    <tr v-for="(purchase_target, index) in purchase_targets" :key="index"-->
                <!--                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">-->
                <!--                        <td class="px-6 py-4">-->
                <!--                            <img v-if="purchase_target.image_url" :src="purchase_target.image_url" alt="商品画像">-->
                <!--                        </td>-->
                <!--                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white hover:text-blue-700">-->
                <!--                            <a :href="`/purchase_target/${purchase_target.id}/edit`">{{ purchase_target.name }}</a>-->
                <!--                            &lt;!&ndash; ユーザーの名前などを表示する &ndash;&gt;-->
                <!--                        </td>-->
                <!--                        <td class="px-6 py-4">-->
                <!--                            {{ purchase_target.jan_code }}-->
                <!--                        </td>-->
                <!--                        <td class="px-6 py-4">-->
                <!--                            {{ purchase_target.current_quantity }} / {{ purchase_target.max_quantity }}-->
                <!--                        </td>-->
                <!--                        <td class="px-6 py-4">-->
                <!--                            <span v-if="purchase_target.is_active"-->
                <!--                                  class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">買取中</span>-->
                <!--                            <span v-else-->
                <!--                                  class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">停止中</span>-->
                <!--                        </td>-->
                <!--                    </tr>-->
                <!--                    </tbody>-->
                <!--                </table>-->
                <!--                <div v-if="last_page !== 1">-->
                <!--                    <nav aria-label="Page navigation example" class="mt-4">-->
                <!--                        <ul class="flex items-center -space-x-px h-8 text-sm">-->
                <!--                            <li>-->
                <!--                                <div @click="previousPage"-->
                <!--                                     class="flex cursor-pointer items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"-->
                <!--                                     :class="{ 'pointer-events-none': current_page === 1 }">-->
                <!--                                    <span class="sr-only">Previous</span>-->
                <!--                                    <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true"-->
                <!--                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">-->
                <!--                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"-->
                <!--                                              stroke-width="2" d="M5 1 1 5l4 4"/>-->
                <!--                                    </svg>-->
                <!--                                </div>-->
                <!--                            </li>-->
                <!--                            <li v-for="page in $page.props.last_page" :key="page">-->
                <!--                                <div @click="goPage(page)"-->
                <!--                                     :aria-current="page === $page.props.current_page ? 'page' : null"-->
                <!--                                     class="flex cursor-pointer items-center justify-center px-3 h-8 leading-tight"-->
                <!--                                     :class="{-->
                <!--                            'text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white': page === current_page,-->
                <!--                            'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white': page !== current_page-->
                <!--                        }">{{ page }}-->
                <!--                                </div>-->
                <!--                            </li>-->
                <!--                            <li>-->
                <!--                                <div @click="nextPage"-->
                <!--                                     class="flex cursor-pointer items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"-->
                <!--                                     :class="{ 'pointer-events-none': current_page === last_page }">-->
                <!--                                    <span class="sr-only">Next</span>-->
                <!--                                    <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true"-->
                <!--                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">-->
                <!--                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"-->
                <!--                                              stroke-width="2" d="m1 9 4-4-4-4"/>-->
                <!--                                    </svg>-->
                <!--                                </div>-->
                <!--                            </li>-->
                <!--                        </ul>-->
                <!--                    </nav>-->
                <!--                </div>-->
            </div>
            <div v-else>
                <p class="text-center text-gray-500 dark:text-gray-400">カートは現在空です。</p>
            </div>
        </div>
    </ClientAuthenticatedLayout>
</template>

<script setup lang="ts">
import ClientAuthenticatedLayout from '@/Layouts/ClientAuthenticatedLayout.vue';
import {defineProps, onMounted} from "vue";
import {useToast} from "vue-toast-notification";
import BlueButton from "@/Components/Button/BlueButton.vue";
import {useForm} from "vee-validate";
import {object} from "yup";

type CartType = {
    purchase_target_id: number;
    name: string;
    price: number;
    quantity: number;
}

const props = defineProps<{
    cart: CartType[]
    // purchase_targets: PurchaseTargetType[]
    // params: ParamType,
    // current_page: number,
    // last_page: number
}>()

const schema = object({
    // name: string(),
    // jan_code: string().max(13, 'JANコードは13桁以下で入力してください'),
    // is_active: string(),
});

const {handleSubmit, errors, values, setFieldValue} = useForm({
    validationSchema: schema,
    initialValues: {
        // name: props.params.name,
        // jan_code: props.params.jan_code,
        // is_active: props.params.is_active,
    }
});

onMounted(() => {
    const toastMessage = sessionStorage.getItem('toastMessage');
    if (toastMessage) {
        useToast().success(toastMessage);
        sessionStorage.removeItem('toastMessage');
    }
});

// const buildUrlWithParams = (page: number) => {
//     let params = {page: page}
//     if (values.name) params['name'] = values.name;
//     if (values.jan_code) params['jan_code'] = values.jan_code;
//     if (values.is_active) params['is_active'] = values.is_active;
//     return route('purchase_target.list', params);
// };
//
// const clear = () => router.get(route('purchase_target.list'));
//
// const search = () => router.get(buildUrlWithParams(1));
//
// const goPage = page => router.get(buildUrlWithParams(page));
//
// const previousPage = () => {
//     if (props.current_page > 1) goPage(props.current_page - 1);
// }
//
// const nextPage = () => {
//     if (props.current_page < props.last_page) goPage(props.current_page + 1);
// }
//
// const goCreate = () => {
//     router.get(route('purchase_target.create'));
// }

</script>

<style scoped>

</style>
