<script setup lang="ts">
import {initFlowbite} from 'flowbite'
import {onMounted} from "vue";
import {router} from '@inertiajs/vue3';

onMounted(() => {
    initFlowbite();
})
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <!-- Page Content -->
            <main>
                <aside id="sidebar-multi-level-sidebar"
                       class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
                       aria-label="Sidebar">
                    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
                        <ul class="space-y-2 font-medium">
                            <li @click="router.get(route('client.dashboard'))"
                                class="cursor-pointer flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <svg class="w-6 h-6 text-gray-500 group-hover:text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M5 3a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H5Zm14 18a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h4ZM5 11a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2H5Zm14 2a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h4Z"/>
                                </svg>

                                <span class="ms-3">ダッシュボード</span>
                            </li>
                            <li @click="router.get(route('client.my_cart.list'))"
                                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group cursor-pointer">
                                <svg class="w-6 h-6 text-gray-500 group-hover:text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M4 4a1 1 0 0 1 1-1h1.5a1 1 0 0 1 .979.796L7.939 6H19a1 1 0 0 1 .979 1.204l-1.25 6a1 1 0 0 1-.979.796H9.605l.208 1H17a3 3 0 1 1-2.83 2h-2.34a3 3 0 1 1-4.009-1.76L5.686 5H5a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                                </svg>

                                <span class="flex-1 ms-3 whitespace-nowrap">マイカート</span>
                            </li>
                            <li @click="router.get(route('client.purchase_offer.list'))"
                                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group cursor-pointer">
                                <svg class="w-6 h-6 text-gray-500 group-hover:text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M8 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h2a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2Zm6 1h-4v2H9a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2h-1V4Zm-6 8a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1Zm1 3a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z" clip-rule="evenodd"/>
                                </svg>

                                <span class="flex-1 ms-3 whitespace-nowrap">買取オファー</span>
                            </li>
                            <li @click="router.get(route('client.purchase_target.list'))"
                               class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group cursor-pointer">
                                <svg class="w-6 h-6 text-gray-500 dark:text-white group-hover:text-gray-900"
                                     aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                          d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                                          clip-rule="evenodd"/>
                                </svg>

                                <span class="flex-1 ms-3 whitespace-nowrap">買取対象</span>
                            </li>

                            <!-- アカウント情報 -->

                            <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $page.props.auth.user.name }}<span class="text-base">　様</span></h5>
                                <p class="text-blue-600 hover:text-blue-300 cursor-pointer" @click="router.get(route('client.user.edit', {id: $page.props.auth.user.id}))">プロフィールを編集</p>
                                <p class="text-blue-600 hover:text-blue-300 cursor-pointer" @click="router.get(route('debug.logout'))">ログアウト</p>
                            </div>
                        </ul>
                    </div>
                </aside>

                <div class="p-4 sm:ml-64">
                    <slot/>
                </div>
            </main>
        </div>
    </div>
</template>
