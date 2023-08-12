<script setup>
import UserLayout from '@/Layouts/UserLayout.vue';
import DeleteUserForm from '../Profile/Partials/DeleteUserForm.vue';
import UpdatePasswordForm from '../Profile/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from '../Profile/Partials/UpdateProfileInformationForm.vue';
import { Head, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;
</script>

<template>
    <Head title="Profile" />

    <UserLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <UpdateProfileInformationForm
                    :must-verify-email="mustVerifyEmail"
                    :status="status"
                    class="max-w-xl"
                />
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <UpdatePasswordForm class="max-w-xl" />
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <DeleteUserForm class="max-w-xl" />
            </div>
        </div>
    </UserLayout>
</template>
