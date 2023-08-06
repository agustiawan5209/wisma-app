<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    jenkel: '',
    alamat: '',
    no_hp: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
        onError:(err)=> console.log(err)
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Register" />

        <form @submit.prevent="submit" class="">
            <div>
                <InputLabel class="" for="name" value="Name" />

                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                    autocomplete="name" />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel class="" for="email" value="Email" />

                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>
            <div class="mt-4">
                <InputLabel class="" for="no_hp" value="Nomor HP" />

                <TextInput id="no_hp" type="number" class="mt-1 block w-full" v-model="form.no_hp" required
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.no_hp" />
            </div>
            <div class="mt-4">
                <InputLabel class="" for="alamat" value="Alamat" />

                <TextInput id="alamat" type="text" class="mt-1 block w-full" v-model="form.alamat" required
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.alamat" />
            </div>
            <div class="mt-4">
                <InputLabel value="Jenis Kelamin" />

                <select id="countries" v-model="form.jenkel"
                    class="bg-white border  text-gray-900 text-sm rounded-lg  block w-full p-2.5 border-indigo-600" >
                    <option selected>----</option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                <InputError :message="form.errors.jenkel" />

            </div>
            <div class="mt-4">
                <InputLabel class="" for="password" value="Password" />

                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                    autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel class="" for="password_confirmation" value="Confirm Password" />

                <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                    v-model="form.password_confirmation" required autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Sudah Daftar?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Daftar
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
