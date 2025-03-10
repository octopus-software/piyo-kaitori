<script setup lang="ts">
import {Head, Link} from '@inertiajs/vue3';
import {defineProps} from 'vue';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import BlueButton from "@/Components/Button/BlueButton.vue";
import OrangeButton from "@/Components/Button/OrangeButton.vue";
import {router} from '@inertiajs/vue3';

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
    companies: {
        user_id: number;
        name: string;
        email: string;
        address: string;
        representative_name: string;
        tel: string;
        line_id: string;
        secondhand_dealer_license_number: string
        send_address: string
    };
}>();

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <Head title="Welcome"/>
    <div
        class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 bg-[url('/images/piyo-kaitori-bg.jpg')] bg-cover bg-center">
        <img
            id="background"
            class="absolute top-0"
            src="/images/piyo-kaitori-bg.jpg"
        />
        <div
            class="relative min-h-screen flex flex-col items-center selection:bg-[#FF2D20] selection:text-white"
        >
            <div class="relative w-full max-w-xl px-6 lg:max-w-7xl">
                <header
                    class="card bg-gray-50 grid grid-cols-2 items-center gap-2 py-2 px-6 lg:grid-cols-3 mt-4 rounded-lg shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
                    <div class="flex lg:justify-center lg:col-start-2">
                        <ApplicationLogo class="w-20 h-20 fill-current text-black dark:text-white"/>
                    </div>
                    <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="$page.props.auth.user.role === 1 ? route('admin.dashboard') : route('client.dashboard')"
                            class="rounded-md text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            マイページへ移動
                        </Link>

                        <template v-else>
                            <BlueButton text="ログイン" @click="router.get(route('login'))"/>
                            <OrangeButton text="ユーザー登録" @click="router.get(route('register'))"/>
                        </template>
                    </nav>
                </header>

                <main class="mt-6">
                    <div class="max-w-md bg-white shadow-md rounded-lg overflow-hidden">
                        <h2 class="text-center p-3 text-black">運営団体情報</h2>
                        <table class="w-full text-sm text-left text-gray-500 border border-gray-200">
                            <tbody>
                            <tr class="bg-gray-50 border-b">
                                <th class="px-4 py-3 text-gray-700 w-1/3">企業名</th>
                                <td class="px-4 py-3 text-gray-900">{{ companies[0].name }}</td>
                            </tr>
                            <tr class="border-b">
                                <th class="px-4 py-3 text-gray-700">代表者</th>
                                <td class="px-4 py-3 text-gray-900">{{ companies[0].representative_name }}</td>
                            </tr>
                            <tr class="bg-gray-50 border-b">
                                <th class="px-4 py-3 text-gray-700 w-1/3">Eメール</th>
                                <td class="px-4 py-3 text-gray-900">{{ companies[0].email }}</td>
                            </tr>
                            <tr class="border-b">
                                <th class="px-4 py-3 text-gray-700">住所</th>
                                <td class="px-4 py-3 text-gray-900">{{ companies[0].address }}</td>
                            </tr>
                            <tr class="bg-gray-50 border-b">
                                <th class="px-4 py-3 text-gray-700 w-1/3">電話番号</th>
                                <td class="px-4 py-3 text-gray-900">{{ companies[0].tel }}</td>
                            </tr>
                            <tr class="border-b">
                                <th class="px-4 py-3 text-gray-700">LINE ID</th>
                                <td class="px-4 py-3 text-gray-900">{{ companies[0].line_id }}</td>
                            </tr>
                            <tr class="bg-gray-50 border-b">
                                <th class="px-4 py-3 text-gray-700 w-1/3">古物商許可番号</th>
                                <td class="px-4 py-3 text-gray-900">第{{ companies[0].secondhand_dealer_license_number }}号</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>
