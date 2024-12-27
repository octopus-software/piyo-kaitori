<script setup lang="ts">
import ClientAuthenticatedLayout from '@/Layouts/ClientAuthenticatedLayout.vue';
import {Head, router} from '@inertiajs/vue3';
</script>

<template>
    <Head>
        <title>Dashboard</title>
    </Head>

    <ClientAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>
        <p class="font-semibold text-green-600 text-lg">買取依頼者用のダッシュボード</p>
        <ul>
            <li class="text-blue-600 hover:text-blue-300 cursor-pointer" @click="router.get(route('debug.logout'))">・ログアウトする</li>
        </ul>
    </ClientAuthenticatedLayout>
</template>
