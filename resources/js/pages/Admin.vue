<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Panel Admin',
        href: '/admin',
    },
];
</script>

<template>
    <Head title="Panel Admin" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <h1>👑 Bienvenido al Panel de Administración</h1>
            <p>Aquí van las herramientas exclusivas del administrador.</p>
        </div>
    </AppLayout>
</template>
