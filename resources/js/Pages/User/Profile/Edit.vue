<script setup>
import UserLayout from '@/Layouts/UserLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head, usePage } from '@inertiajs/vue3';

const props = defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    user:{
        type: Object,
        default:()=>({})
    }
});

</script>

<template>
    <Head title="Profile" />

    <UserLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <UpdateProfileInformationForm
                    :must-verify-email="mustVerifyEmail"
                    :status="status"
                    :user="user"
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
