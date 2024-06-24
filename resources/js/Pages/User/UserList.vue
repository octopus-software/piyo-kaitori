<template>
    <AuthenticatedLayout>
        <div class="relative overflow-x-auto">

            <!-- 検索フィルター -->
            <div class="block w-full mb-4 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">検索フォーム</h5>
                <!--                <p class="font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>-->
                <div class="mx-auto">
                    <div class="flex">
                        <div class="mb-5 p-2 w-[50%]">
                            <label for="name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ユーザー名</label>
                            <input type="text" v-model="name" id="name"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required/>
                        </div>
                        <div class="mb-5 p-2 w-[50%]">
                            <label for="email"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Eメール</label>
                            <input type="email" v-model="email" id="email"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="" required/>
                        </div>
                    </div>
                    <BlueButton text="検索する" :onclick="search"/>
                    <OrangeButton text="条件をクリア" :onclick="clear"/>
                </div>
            </div>

            <!-- ユーザーリスト -->
            <div v-if="users.length !== 0">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 w-[40%]">
                            ユーザー名
                        </th>
                        <th scope="col" class="px-6 py-3 w-[60%]">
                            Eメール
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(user, index) in users" :key="index"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white hover:text-blue-700">
                            <a :href="`/user/${user.id}/edit`">{{ user.name }}</a> <!-- ユーザーの名前などを表示する -->
                        </td>
                        <td class="px-6 py-4">
                            {{ user.email }} <!-- ユーザーのメールアドレスなどを表示する -->
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
                                     class="flex cursor-pointer items-center justify-center px-3 h-8 leading-tight" :class="{
                            'text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white': page === current_page,
                            'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white': page !== current_page
                        }">{{ page }}</div>
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
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {onMounted, ref} from "vue";
import BlueButton from "../../Components/Button/BlueButton.vue";
import OrangeButton from "../../Components/Button/OrangeButton.vue";
import {useToast} from "vue-toast-notification";

const props = defineProps({
    users: {
        type: Object,
        required: true
    },
    params: {
        type: {
            name: String,
            email: String
        },
        required: true
    },
    current_page: {
        type: Number,
        required: true
    },
    last_page: {
        type: Number,
        required: true
    }
})

const name = ref(props.params.name)
const email = ref(props.params.email)

onMounted(() => {
    const toast = useToast();
    const toastMessage = sessionStorage.getItem('toastMessage');
    if (toastMessage) {
        toast.success(toastMessage);
        sessionStorage.removeItem('toastMessage');
    }
})

const clear = () => {
    name.value = ''
    email.value = ''
    location.href = `/user?page=1&name=${name.value}&email=${email.value}`;
}

const search = () => {
    location.href = `/user?page=1&name=${name.value}&email=${email.value}`;
}

const goPage = page => {
    let url = `/user?page=${page}`
    if (name.value) url += `&name=${name.value}`
    if (email.value) url += `&email=${email.value}`
    location.href = url
}

const previousPage = () => {
    if (props.current_page - 1 < 1) return;
    let url = `/user?page=${props.current_page - 1}`
    if (name.value) url += `&name=${name.value}`
    if (email.value) url += `&email=${email.value}`
    location.href = url
}

const nextPage = () => {
    if (props.current_page + 1 > props.last_page) return;
    let url = `/user?page=${props.current_page + 1}`
    if (name.value) url += `&name=${name.value}`
    if (email.value) url += `&email=${email.value}`
    location.href = url
}

</script>

<style scoped>

</style>
