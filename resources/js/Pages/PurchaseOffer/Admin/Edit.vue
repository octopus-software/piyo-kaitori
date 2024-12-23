<template>
    <AuthenticatedLayout>
        <div class="relative overflow-x-auto">
            <div
                class="block w-full mb-4 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">買取オファー編集</h5>
                <!--                <p class="font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>-->
                <div class="mx-auto">
                    <div class="flex">
                        <div class="mb-5 p-2 w-[50%]">
                            <label for="name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">買取依頼者名</label>
                            <input type="text" :value="purchase_offer.user_name" id="name" disabled
                                   class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-1000 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required/>
                        </div>
                        <div class="mb-5 p-2 w-[50%]">
                            <label for="offer_date"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">買取依頼日</label>
                            <input type="date" :value="purchase_offer.offer_date" id="offer_date" disabled
                                   class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-1000 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required/>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-5 p-2 w-[50%]">
                            <label for="status"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">買取ステータス</label>
                            <select v-if="purchase_offer.status === 1 || purchase_offer.status === 2" :value="purchase_offer.status" id="status"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                <option value="1">未承認</option>
                                <option value="2">承認済み</option>
                            </select>
                            <select v-if="purchase_offer.status === 3 || purchase_offer.status === 4" :value="purchase_offer.status" id="status"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                <option value="3">発送済み</option>
                                <option value="4">完了</option>
                            </select>
                        </div>
                        <div v-if="purchase_offer.send_date" class="mb-5 p-2 w-[50%]">
                            <label for="send_date"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">商品発送日</label>
                            <input type="date" :value="purchase_offer.send_date" id="send_date" disabled
                                   class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-1000 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required/>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-5 p-2">
                            <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">買取対象品一覧</p>
                            <table class="min-w-full border border-gray-300 divide-y divide-gray-200 shadow-md rounded-lg overflow-hidden">
                                <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">商品名</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">JANコード</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">買取希望金額</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">買取希望個数</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">買取合計金額</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                <tr
                                    v-for="(purchase_target, index) in purchase_offer.purchase_targets"
                                    :key="index"
                                    class="hover:bg-gray-50 transition"
                                >
                                    <td class="px-4 py-2 text-sm text-gray-900">{{ purchase_target.name }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-900">{{ purchase_target.jan_code }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-900">{{ purchase_target.price }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-900">{{ purchase_target.amount }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-900">{{ purchase_target.total_price }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="px-4 py-2 text-sm text-gray-900">{{ purchase_offer.total_price }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

<!--                    <div class="flex">-->
<!--                        <div class="mb-5 p-2 w-[100%]">-->
<!--                            <div class="inline-flex items-center">-->
<!--                                <label class="relative flex items-center p-3 -mt-5 rounded-full cursor-pointer"-->
<!--                                       htmlFor="description">-->
<!--                                    <input type="checkbox" :checked="user.is_active" v-model="user.is_active"-->
<!--                                           class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-gray-900 checked:bg-gray-900 checked:before:bg-gray-900 hover:before:opacity-10"-->
<!--                                           id="description"/>-->
<!--                                    <span-->
<!--                                        class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100"><svg-->
<!--                                        xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"-->
<!--                                        fill="currentColor" stroke="currentColor" stroke-width="1"><path-->
<!--                                        fill-rule="evenodd"-->
<!--                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"-->
<!--                                        clip-rule="evenodd"></path></svg></span>-->
<!--                                </label>-->
<!--                                <label class="mt-px font-light text-gray-700 cursor-pointer select-none"-->
<!--                                       htmlFor="description">-->
<!--                                    <div>-->
<!--                                        <p class="block font-sans text-base antialiased font-medium leading-relaxed text-blue-gray-900">-->
<!--                                            現在取引中である-->
<!--                                        </p>-->
<!--                                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-gray-700">-->
<!--                                            チェックの入っていないユーザーの買取オファーは非表示となります。-->
<!--                                        </p>-->
<!--                                    </div>-->
<!--                                </label>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->

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
import BlueButton from "../../../Components/Button/BlueButton.vue";
import GrayButton from "../../../Components/Button/GrayButton.vue";
import DeleteButton from "../../../Components/Button/DeleteButton.vue";
import {router} from '@inertiajs/vue3';
import {defineProps} from 'vue';

type PurchaseTargetType = {
    id: number;
    name: string;
    jan_code: string;
    price: string;
    amount: string;
    total_price: string;
    evidence_url: string;
}

type PurchaseOfferType = {
    id: number;
    user_id: number;
    user_name: string;
    status: number;
    offer_date: string;
    send_date: string;
    total_price: string;
    purchase_targets: PurchaseTargetType[]
}

const toast = useToast();
const props = defineProps<{
    purchase_offer: PurchaseOfferType
}>();

console.log(props.purchase_offer)

const goBack = () => {
    router.get(route('purchase_offer.list'));
}

// const updateUser = async () => {
//     try {
//         await router.put(route('user.update', user.value.id), {
//             is_active: user.value.is_active,
//         });
//         toast.success('データが更新されました');
//     } catch (error) {
//         toast.error(error.response.data.message);
//     }
// };

// const deleteUser = async (): Promise<void> => {
//     try {
//         await router.delete(route('user.delete', user.value.id));
//         sessionStorage.setItem('toastMessage', 'データが削除されました');
//         // Inertia.visit(route('user.list'));
//     } catch (error) {
//         const toast = useToast();
//         toast.error(error.response.data.message);
//     }
// };

</script>

<style scoped>

</style>
