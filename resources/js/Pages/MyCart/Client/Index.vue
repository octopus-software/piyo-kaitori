<template>
    <ClientAuthenticatedLayout>
        <div class="relative overflow-x-auto">
            <!-- マイカート -->
            <div v-if="cart.length !== 0">
                <div
                    class="block w-full mb-4 p-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <table
                        class="min-w-full border border-gray-300 divide-y divide-gray-200 shadow-md rounded-lg overflow-hidden">
                        <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">商品名</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">買取希望金額</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">買取希望個数</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">備考欄</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">買取合計金額</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">買取合計金額</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                        <tr
                            v-for="(item, index) in cart"
                            :key="index"
                            class="hover:bg-gray-50 transition"
                        >
                            <td class="px-4 py-2 text-sm text-gray-900">{{ item.name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-900">{{ item.price }}</td>
                            <td class="px-4 py-2 text-sm text-gray-900">{{ item.quantity }}個</td>
                            <td v-if="item.remarks" class="px-4 py-2 text-sm">{{ item.remarks }}</td>
                            <td v-else></td>
                            <td class="px-4 py-2 text-sm text-gray-900">{{ item.total_price }}</td>
                            <td class="px-4 py-2 text-sm text-gray-900">
                                <RedButton text="カートから削除" @click="deleteCartItem(item.purchase_target_id)" />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="px-4 py-2 text-sm text-gray-900">{{ total_price }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="mt-6">
                        <p class="text-xl">カート合計金額：{{ total_price }}</p>
                    </div>
                    <BlueButton text="買取オファーを作成する" @click="storePurchaseOffer"/>
                </div>
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
import {router} from "@inertiajs/vue3";
import RedButton from "@/Components/Button/RedButton.vue";

type CartType = {
    purchase_target_id: number;
    name: string;
    price: number;
    quantity: number;
    remarks: string;
    total_price: number;
}

const props = defineProps<{
    cart: CartType[]
    total_price: number
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

const storePurchaseOffer = () => {
    const toast = useToast() as { success: (message: string, options?: Record<string, any>) => void;};
    router.post(route('client.purchase_offer.store'), {}, {
        headers: {
            'Content-Type': 'multipart/form-data'
        },
        onSuccess: () => toast.success('買取オファーを作成しました', {duration: 5000}),
        onError: (errors) => {
            // serverErrors.value = errors;
        },
    });
};

const deleteCartItem = (id: number) => {
    const toast = useToast() as { success: (message: string, options?: Record<string, any>) => void;};
    router.delete(route('client.cart.item.delete', {id: id}), {
        headers: {
            'Content-Type': 'multipart/form-data'
        },
        onSuccess: () => toast.success('カートアイテムを削除しました', {duration: 5000}),
        onError: (errors) => {
            // serverErrors.value = errors;
        },
    });
};

</script>

<style scoped>

</style>
