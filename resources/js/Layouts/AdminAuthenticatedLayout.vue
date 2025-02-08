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
                            <li @click="router.get(route('admin.dashboard'))"
                                class="cursor-pointer flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <svg class="w-6 h-6 text-gray-500 dark:text-white group-hover:text-gray-900"
                                     aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M13.5 2c-.178 0-.356.013-.492.022l-.074.005a1 1 0 0 0-.934.998V11a1 1 0 0 0 1 1h7.975a1 1 0 0 0 .998-.934l.005-.074A7.04 7.04 0 0 0 22 10.5 8.5 8.5 0 0 0 13.5 2Z"/>
                                    <path
                                        d="M11 6.025a1 1 0 0 0-1.065-.998 8.5 8.5 0 1 0 9.038 9.039A1 1 0 0 0 17.975 13H11V6.025Z"/>
                                </svg>

                                <span class="ms-3">ダッシュボード</span>
                            </li>

                            <li @click="router.get(route('admin.user.list'))"
                                class="flex cursor-pointer items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <svg class="w-6 h-6 text-gray-500 dark:text-white group-hover:text-gray-900"
                                     aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                          d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z"
                                          clip-rule="evenodd"/>
                                </svg>

                                <span class="ms-3">買取依頼者</span>
                            </li>
                            <li @click="router.get(route('admin.purchase_target.list'))"
                                class="flex cursor-pointer items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <svg class="w-6 h-6 text-gray-500 dark:text-white group-hover:text-gray-900"
                                     aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                          d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                                          clip-rule="evenodd"/>
                                </svg>

                                <span class="flex-1 ms-3 whitespace-nowrap">買取対象</span>
                            </li>
                            <li @click="router.get(route('admin.purchase_offer.list'))"
                                class="flex cursor-pointer items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <svg class="w-6 h-6 text-gray-500 dark:text-white group-hover:text-gray-900"
                                     aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12.268 6A2 2 0 0 0 14 9h1v1a2 2 0 0 0 3.04 1.708l-.311 1.496a1 1 0 0 1-.979.796H8.605l.208 1H16a3 3 0 1 1-2.83 2h-2.34a3 3 0 1 1-4.009-1.76L4.686 5H4a1 1 0 0 1 0-2h1.5a1 1 0 0 1 .979.796L6.939 6h5.329Z"/>
                                    <path
                                        d="M18 4a1 1 0 1 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 1 0 2 0V8h2a1 1 0 1 0 0-2h-2V4Z"/>
                                </svg>

                                <span class="flex-1 ms-3 whitespace-nowrap">買取オファー</span>
                            </li>

                            <!-- アカウント情報 -->

                            <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $page.props.auth.user.name }}<span class="text-base">　様</span></h5>
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
