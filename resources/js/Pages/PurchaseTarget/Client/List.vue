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
                            <label for="name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">買取商品名</label>
                            <input type="text" :value="values.name" id="name"
                                   @input="(e) => setFieldValue('name', e.target.value)"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            />
                        </div>
                        <div class="mb-5 p-2 w-[50%]">
                            <label for="jan_code"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">JANコード</label>
                            <input type="text" :value="values.jan_code" id="jan_code"
                                   @input="(e) => setFieldValue('jan_code', e.target.value)"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder=""
                            />
                        </div>
                    </div>
                    <BlueButton text="検索する" @click="handleSubmit(search)"/>
                    <OrangeButton text="条件をクリア" @click="clear"/>
                </div>
            </div>

            <div v-if="purchase_targets.length !== 0">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 w-[10%]">
                            商品画像
                        </th>
                        <th scope="col" class="px-6 py-3 w-[30%]">
                            商品名
                        </th>
                        <th scope="col" class="px-6 py-3 w-[20%]">
                            JANコード
                        </th>
                        <th scope="col" class="px-6 py-3 w-[20%]">
                            買取希望数 (現在 / 上限)
                        </th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(purchase_target, index) in purchase_targets" :key="index"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 cursor-pointer">
                        <td class="px-6 py-4">
                            <img v-if="purchase_target.image_url" :src="purchase_target.image_url" alt="商品画像">
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white hover:text-blue-700">
                            {{ purchase_target.name }}
                            <!-- ユーザーの名前などを表示する -->
                        </td>
                        <td class="px-6 py-4">
                            {{ purchase_target.jan_code }}
                        </td>
                        <td class="px-6 py-4">
                            {{ purchase_target.current_quantity }} / {{ purchase_target.max_quantity }}
                        </td>
                        <td>
                            <button v-if="purchase_target.current_quantity < purchase_target.max_quantity" data-modal-target="add-cart-modal"
                                    data-modal-toggle="add-cart-modal"
                                    :data-purchase-target-id="purchase_target.id"
                                    :data-purchase-target-name="purchase_target.name"
                                    :data-current-quantity="purchase_target.current_quantity"
                                    :data-max-quantity="purchase_target.max_quantity"
                                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button"
                            >
                                カートに追加する
                            </button>
                            <button v-else class="block text-white bg-gray-400 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button"
                            >
                                カートに追加する
                            </button>
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
                <p class="text-center text-gray-500 dark:text-gray-400">該当する商品が見つかりませんでした</p>
            </div>
        </div>

        <div id="add-cart-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            下記の買取商品をカートに追加します
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="add-cart-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <p>買取商品名：<span id="name"></span></p>
                        <label for="price"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">買取希望価格</label>
                        <input type="number" min=1 name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               :class="{ 'bg-red-100': errors.max_quantity, 'border-red-300': errors.max_quantity }" />
                        <label for="quantity"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">買取希望個数</label>
                        <input type="number" name="quantity" id="quantity" :max="modalPurchaseMaxQuantity - modalPurchaseCurrentQuantity" min=1 class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               :class="{ 'bg-red-100': errors.max_quantity, 'border-red-300': errors.max_quantity }" />

                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
<!--                        <button data-modal-hide="add-cart-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>-->
<!--                        <button data-modal-hide="add-cart-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>-->
                    </div>
                </div>
            </div>
        </div>
    </ClientAuthenticatedLayout>
</template>

<script setup lang="ts">
import ClientAuthenticatedLayout from '@/Layouts/ClientAuthenticatedLayout.vue';
import {defineProps, InputHTMLAttributes, onMounted, ref} from "vue";
import {useToast} from "vue-toast-notification";
import BlueButton from "@/Components/Button/BlueButton.vue";
import OrangeButton from "@/Components/Button/OrangeButton.vue";
import {router} from "@inertiajs/vue3";
import {useForm} from "vee-validate";
import {object, string} from "yup";

const modalPurchaseTargetId = ref(0);
const modalPurchaseTargetName = ref('');
const modalPurchaseMaxQuantity = ref(0);
const modalPurchaseCurrentQuantity = ref(0);

type ParamType = {
    name?: string;
    jan_code?: string;
}

type PurchaseOfferType = {
    purchase_offer_id: number;
    user_id: number;
    user_name: string;
    price: number;
    quantity: number;
}

type PurchaseTargetType = {
    id: number;
    name: string;
    jan_code: string;
    image_url: string;
    is_active: boolean;
    max_quantity: number;
    current_quantity: number;
    purchase_offers: PurchaseOfferType[];
}

const props = defineProps<{
    purchase_targets: PurchaseTargetType[]
    params: ParamType,
    current_page: number,
    last_page: number
}>()

const schema = object({
    name: string(),
    jan_code: string().max(13, 'JANコードは13桁以下で入力してください'),
});

const {handleSubmit, errors, values, setFieldValue} = useForm({
    validationSchema: schema,
    initialValues: {
        name: props.params.name,
        jan_code: props.params.jan_code,
    }
});

onMounted(() => {
    const toastMessage = sessionStorage.getItem('toastMessage');
    if (toastMessage) {
        useToast().success(toastMessage);
        sessionStorage.removeItem('toastMessage');
    }

    const modalToggleButtons = document.querySelectorAll('[data-modal-toggle]');

    // 各ボタンにイベントリスナーを追加
    modalToggleButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modalId = button.getAttribute('data-modal-target');
            const modal = document.getElementById(modalId);

            // モーダル内の要素を更新
            if (modal) {
                modalPurchaseTargetId.value = Number(button.getAttribute('data-purchase-target-id')) || 0;
                modalPurchaseTargetName.value = button.getAttribute('data-purchase-target-name');
                modalPurchaseMaxQuantity.value = Number(button.getAttribute('data-max-quantity')) || 0;
                modalPurchaseCurrentQuantity.value = Number(button.getAttribute('data-current-quantity')) || 0;
                // let idDisplay = modal.querySelector('#id');
                let nameDisplay = modal.querySelector('#name');
                let priceDisplay: InputHTMLAttributes = modal.querySelector('input#price');
                let quantityDisplay: InputHTMLAttributes = modal.querySelector('input#quantity');
                // モーダル情報の更新
                if (nameDisplay) nameDisplay.innerHTML = modalPurchaseTargetName.value || ''; // ユーザーのメールを設定
                if (priceDisplay) priceDisplay.value = 0; // ユーザーのメールを設定
                if (quantityDisplay) quantityDisplay.value = 1; // ユーザーのメールを設定
            }
        });
    });
});

const buildUrlWithParams = (page: number) => {
    let params = {page: page}
    if (values.name) params['name'] = values.name;
    if (values.jan_code) params['jan_code'] = values.jan_code;
    return route('client.purchase_target.list', params);
};

const clear = () => router.get(route('client.purchase_target.list'));

const search = () => router.get(buildUrlWithParams(1));

const goPage = page => router.get(buildUrlWithParams(page));

const previousPage = () => {
    if (props.current_page > 1) goPage(props.current_page - 1);
}

const nextPage = () => {
    if (props.current_page < props.last_page) goPage(props.current_page + 1);
}

const openAddCartDialog = (purchase_target: PurchaseTargetType) => {
    console.log(purchase_target)
}


const addCart = async (purchase_target: PurchaseTargetType) => {
    console.log('add cart !!')
    // const toast = useToast() as { success: (message: string, options?: Record<string, any>) => void;};
    // await router.post(route('client.cart.store'), {
    //     purchase_target_id: purchase_target.id,
    //     name: purchase_target.name,
    // }, {
    //     headers: {
    //         'Content-Type': 'multipart/form-data'
    //     },
    //     onSuccess: () => toast.success('買取対象を更新しました', {duration: 5000}),
    //     onError: (errors) => {
    //         serverErrors.value = errors;
    //     },
    // });
};

</script>

<style scoped>

</style>
