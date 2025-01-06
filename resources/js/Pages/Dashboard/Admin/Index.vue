<script setup lang="ts">
import AdminAuthenticatedLayout from '@/Layouts/AdminAuthenticatedLayout.vue';
import {Head, router} from '@inertiajs/vue3';
</script>

<template>
    <Head>
        <title>Dashboard</title>
    </Head>

    <AdminAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>
        <p class="font-semibold text-red-600 text-lg">管理者用のダッシュボード</p>
        <ul>
            <li class="text-blue-600 hover:text-blue-300 cursor-pointer" @click="router.get(route('debug.logout'))">・ログアウトする</li>
        </ul>
    </AdminAuthenticatedLayout>
</template>
