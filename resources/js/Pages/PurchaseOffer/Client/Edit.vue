<template>
    <ClientAuthenticatedLayout>
        <div class="relative overflow-x-auto">
            <div
                class="block w-full mb-4 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">買取オファー編集</h5>
                <!--                <p class="font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>-->
                <div class="mx-auto">
                    <div v-if="Object.keys(serverErrors).length"
                         class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>
                            <li v-for="(messages, field) in serverErrors" :key="field">
                                <span v-for="message in messages" :key="message">{{ message }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="flex">
                        <div class="mb-5 p-2 w-[50%]">
                            <label for="offer_date"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">買取依頼日</label>
                            <input type="date" :value="purchase_offer.offer_date" id="offer_date" disabled
                                   class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-1000 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required/>
                        </div>
                        <div class="mb-5 p-2 w-[50%]">
                            <label for="status"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">買取ステータス</label>
                            <select :value="purchase_offer.status" id="status"
                                    @input="(e) => setFieldValue('status', e.target.value)"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                <option v-if="purchase_offer.status === 1" value="1">
                                    未承認
                                </option>
                                <option v-if="purchase_offer.status === 2 || purchase_offer.status === 3" value="2">
                                    承認済み
                                </option>
                                <option v-if="purchase_offer.status === 2 || purchase_offer.status === 3" value="3">
                                    発送済み
                                </option>
                                <option v-if="purchase_offer.status === 4" value="4">
                                    取引完了
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-5 p-2 w-[50%]">
                            <label for="shipped_date"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">商品発送日</label>
                            <input type="date" :value="purchase_offer.shipped_date" id="shipped_date"
                                   :disabled="purchase_offer.status === 1 || purchase_offer.status === 4"
                                   @input="(e) => setFieldValue('shipped_date', e.target.value)"
                                   class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-1000 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   :class="{'bg-gray-200': purchase_offer.status === 1 || purchase_offer.status === 4, 'bg-gray-50': purchase_offer.status === 2 || purchase_offer.status === 3}"
                                   required/>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-5 p-2">
                            <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">買取対象品一覧</p>
                            <table
                                class="min-w-full border border-gray-300 divide-y divide-gray-200 shadow-md rounded-lg overflow-hidden">
                                <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">商品名</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">JANコード</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">買取希望金額</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">買取希望個数</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">備考欄</th>
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
                                    <td class="px-4 py-2 text-sm text-gray-900">{{ purchase_target.quantity }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-900">{{ purchase_target.remarks }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-900">{{ purchase_target.total_price }}</td>

                                </tr>
                                <tr>
                                    <td></td>
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

                    <OrangeButton v-if="props.purchase_offer.status >= 2" text="買取依頼書を発行する" @click="generatePurchaseOfferForm"/>
                    <BlueButton text="更新する" @click="updatePurchaseOfferStatus"/>
                    <DeleteButton v-if="purchase_offer.status === 1" text="削除する" :onclick="deletePurchaseOffer"/>
                    <GrayButton text="戻る" @click="goBack"/>
                </div>
            </div>
        </div>
    </ClientAuthenticatedLayout>
</template>

<script setup lang="ts">
import {useToast} from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import BlueButton from "@/Components/Button/BlueButton.vue";
import GrayButton from "@/Components/Button/GrayButton.vue";
import DeleteButton from "@/Components/Button/DeleteButton.vue";
import {router} from '@inertiajs/vue3';
import {defineProps, ref} from 'vue';
import {useForm} from "vee-validate";
import {date, number, object} from "yup";
import ClientAuthenticatedLayout from "@/Layouts/ClientAuthenticatedLayout.vue";
import OrangeButton from "@/Components/Button/OrangeButton.vue";

type PurchaseTargetType = {
    id: number;
    name: string;
    jan_code: string;
    price: string;
    quantity: string;
    total_price: string;
    remarks: string;
}

type PurchaseOfferType = {
    id: number;
    user_id: number;
    user_name: string;
    status: number;
    offer_date: string;
    shipped_date: string;
    total_price: string;
    purchase_targets: PurchaseTargetType[]
}

const serverErrors = ref({});
const toast = useToast();
const props = defineProps<{
    purchase_offer: PurchaseOfferType
}>();

const schema = object({
    status: number(),
    shipped_date: date().nullable(),
});

const {handleSubmit, errors, values, setFieldValue} = useForm({
    validationSchema: schema,
    initialValues: {
        status: props.purchase_offer.status,
        shipped_date: props.purchase_offer.shipped_date,
    }
});

const goBack = () => {
    router.get(route('client.purchase_offer.list'));
}

const deletePurchaseOffer = () => {
    const toast = useToast() as { success: (message: string, options?: Record<string, any>) => void; };
    router.delete(route('client.purchase_offer.delete', {id: props.purchase_offer.id}), {
        onSuccess: () => {
            toast.success('買取オファーを削除しました', {duration: 5000})
            serverErrors.value = {};
        },
        onError: (errors) => {
            serverErrors.value = errors;
        }
    });
}

const updatePurchaseOfferStatus = () => {
    const toast = useToast() as { success: (message: string, options?: Record<string, any>) => void; };
    router.put(route('client.purchase_offer.update.status', {id: props.purchase_offer.id}), {
        status: values.status,
        shipped_date: values.shipped_date,
    }, {
        headers: {
            'Content-Type': 'application/json'
        },
        onSuccess: () => {
            toast.success('買取オファーのステータスを更新しました', {duration: 5000})
            serverErrors.value = {};
        },
        onError: (errors) => {
            serverErrors.value = errors;
        },
    });
};

/**
 * 買取依頼書発行のAPIコール
 */
const generatePurchaseOfferForm = () => {
    const pdfUrl = route('client.export_pdf', {
        purchase_offer_id: props.purchase_offer.id,
        purchase_method: 2,
        transaction_method: 2
    });
    window.open(pdfUrl, '_blank'); // 新しいタブでPDFを開く
};

const resetServerErrors = () => {
    serverErrors.value = {};
};

</script>

<style scoped>

</style>
