<template>
    <ClientAuthenticatedLayout>
        <div class="relative overflow-x-auto">

            <!-- 検索フィルター -->
            <div
                class="block w-full mb-4 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">検索フォーム</h5>
                <!--                <p class="font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>-->
                <div class="mx-auto">
                    <div class="flex">
                        <div class="mb-5 p-2 w-[50%]">
                            <label for="jan_code"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">JANコード</label>
                            <input type="text" :value="values.jan_code" id="jan_code"
                                   @input="(e) => setFieldValue('jan_code', e.target.value)"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="" required/>
                        </div>
                        <div class="mb-5 p-2 w-[50%]">
                            <label for="is_active"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">買取ステータス</label>
                            <select :value="values.status" id="is_active"
                                    @input="(e) => setFieldValue('status', e.target.value)"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                <option value=""></option>
                                <option value="1">未承認</option>
                                <option value="2">承認済み</option>
                                <option value="3">発送済み</option>
                                <option value="4">取引完了</option>
                            </select>
                        </div>
                    </div>
                    <BlueButton text="検索する" @click="search"/>
                    <OrangeButton text="条件をクリア" @click="clear"/>
                </div>
            </div>

            <!-- オファーリスト -->
            <div v-if="purchase_offers.length !== 0">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 w-[10%]">
                            依頼日
                        </th>
                        <th scope="col" class="px-6 py-3 w-[30%]">
                            買取品概略
                        </th>
                        <th scope="col" class="px-6 py-3 w-[20%]">
                            買取合計金額
                        </th>
                        <th scope="col" class="px-6 py-3 w-[20%]">
                            ステータス
                        </th>
                        <th scope="col" class="px-6 py-3 w-[20%]">
                            商品発送日
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(purchase_offer, index) in purchase_offers" :key="index"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100">
                        <td class="px-6 py-4 font-medium whitespace-nowrap dark:text-white">
                            <div class="flex inline-block">
                                <svg @click="goEdit(purchase_offer.id)" class="cursor-pointer mr-4 w-6 h-6 text-blue-800 dark:text-white hover:text-blue-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                </svg>
                                <p>{{ purchase_offer.offer_date }}</p> <!-- ユーザーの名前などを表示する -->
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p>{{ purchase_offer.summary }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p>{{ purchase_offer.total_price }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <!--                            <p v-else-if="purchase_offer.status === 3">発送済み</p>-->
                            <!--                            <p v-else-if="purchase_offer.status === 4">完了</p>-->
                            <span v-if="purchase_offer.status === 1"
                                  class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">未承認</span>
                            <span v-if="purchase_offer.status === 2"
                                  class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">承認済み</span>
                            <span v-if="purchase_offer.status === 3"
                                  class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">発送済み</span>
                            <span v-if="purchase_offer.status === 4"
                                  class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">取引完了</span>
                        </td>
                        <td v-if="purchase_offer.shipped_date" class="px-6 py-4">
                            <p>{{ purchase_offer.shipped_date }}</p>
                        </td>
                        <td v-else class="px-6 py-4">
                            <p class="text-red-600">未発送</p>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div v-if="last_page !== 1">
                    <nav aria-label="Page navigation example" class="mt-4">
                        <ul class="flex items-center -space-x-px h-8 text-sm">
                            <li>
                                <div @click="previousPage"
                                     class="flex cursor-pointer items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                     :class="{ 'pointer-events-none': current_page === 1 }">
                                    <span class="sr-only">Previous</span>
                                    <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2" d="M5 1 1 5l4 4"/>
                                    </svg>
                                </div>
                            </li>
                            <li v-for="page in $page.props.last_page" :key="page">
                                <div @click="goPage(page)"
                                     :aria-current="page === $page.props.current_page ? 'page' : null"
                                     class="flex cursor-pointer items-center justify-center px-3 h-8 leading-tight"
                                     :class="{
                            'text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white': page === current_page,
                            'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white': page !== current_page
                        }">{{ page }}
                                </div>
                            </li>
                            <li>
                                <div @click="nextPage"
                                     class="flex cursor-pointer items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                     :class="{ 'pointer-events-none': current_page === last_page }">
                                    <span class="sr-only">Next</span>
                                    <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div v-else>
                <p class="text-center text-gray-500 dark:text-gray-400">該当するユーザーが見つかりませんでした</p>
            </div>
        </div>
    </ClientAuthenticatedLayout>
</template>

<script setup lang="ts">
import {defineProps, onMounted} from "vue";
import {useToast} from "vue-toast-notification";
import {router} from '@inertiajs/vue3';
import BlueButton from "@/Components/Button/BlueButton.vue";
import OrangeButton from "@/Components/Button/OrangeButton.vue";
import {object, string} from "yup";
import {useForm} from "vee-validate";
import ClientAuthenticatedLayout from "@/Layouts/ClientAuthenticatedLayout.vue";

type ParamType = {
    user_name: string;
    jan_code: string;
    status: number;
}

type PurchaseTargetType = {
    target_id: number;
    target_name: string;
    price: number;
    max_quantity: number;
    evidence_url: string;
}

type PurchaseOfferType = {
    id: number;
    user_id: number;
    user_name: string;
    status: number;
    summary: string
    total_price: string;
    offer_date: string;
    detail: PurchaseTargetType[]
}

const props = defineProps<{
    purchase_offers: PurchaseOfferType[]
    params: ParamType,
    current_page: number,
    last_page: number
}>()

const schema = object({
    user_name: string(),
    jan_code: string().max(13, 'JANコードは13桁以下で入力してください'),
    status: string(),
});

const {handleSubmit, errors, values, setFieldValue} = useForm({
    validationSchema: schema,
    initialValues: {
        user_name: props.params.user_name,
        jan_code: props.params.jan_code,
        status: props.params.status,
    }
});

onMounted(() => {
    const toastMessage = sessionStorage.getItem('toastMessage');
    if (toastMessage) {
        useToast().success(toastMessage);
        sessionStorage.removeItem('toastMessage');
    }
});

const buildUrlWithParams = (page: number) => {
    let params = {page: page}
    if (values.user_name) params['user_name'] = values.user_name;
    if (values.jan_code) params['jan_code'] = values.jan_code;
    if (values.status) params['status'] = values.status;
    return route('client.purchase_offer.list', params);
};

const clear = () => router.get(route('client.purchase_offer.list'));

const search = () => router.get(buildUrlWithParams(1));

const goPage = page => router.get(buildUrlWithParams(page));

const previousPage = () => {
    if (props.current_page > 1) goPage(props.current_page - 1);
}

const nextPage = () => {
    if (props.current_page < props.last_page) goPage(props.current_page + 1);
}

const goEdit = (id: number) => {
    router.get(route('client.purchase_offer.edit', {id: id}))
}

</script>

<style scoped>

</style>
