<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { Button } from "@/Components/ui/button";

const form = useForm({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
});

const submit = () => {
  form.post(route("register"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};
</script>

<template>
  <GuestLayout>
    <Head title="Register" />

    <form @submit.prevent="submit">
        <div>
            <p class="flex items-center justify-center mt-4 mb-6 text-xl text-muted-foreground">Create an account.</p>
        </div>
      <div>
        <InputLabel for="name" value="First and Last Legal Name" />

        <TextInput
          id="name"
          type="text"
          class="block w-full mt-1"
          v-model="form.name"
          required
          autofocus
          autocomplete="name"
        />

        <InputError class="mt-2" :message="form.errors.name" />
      </div>

      <div class="mt-4">
        <InputLabel for="email" value="Email" />

        <TextInput
          id="email"
          type="email"
          class="block w-full mt-1"
          v-model="form.email"
          required
          autocomplete="username"
        />

        <InputError class="mt-2" :message="form.errors.email" />
      </div>

      <div class="mt-4">
        <InputLabel for="password" value="Password" />

        <TextInput
          id="password"
          type="password"
          class="block w-full mt-1"
          v-model="form.password"
          required
          autocomplete="new-password"
        />

        <InputError class="mt-2" :message="form.errors.password" />
      </div>

      <div class="mt-4">
        <InputLabel for="password_confirmation" value="Confirm Password" />

        <TextInput
          id="password_confirmation"
          type="password"
          class="block w-full mt-1"
          v-model="form.password_confirmation"
          required
          autocomplete="new-password"
        />

        <InputError class="mt-2" :message="form.errors.password_confirmation" />
      </div>

      <div class="flex items-center justify-end mt-4 mb-4">
        <Link
          :href="route('login')"
          class="text-sm underline rounded-md text-muted-foreground hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:ring-offset-2"
        >
          Already registered?
        </Link>
      </div>
      <div>
        <Button
          type="submit"
          class="w-full mb-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Create an account
        </Button>
      </div>
      <div>
        <Button variant="outline" class="w-full bg-red-600"> Sign up with ItsMe </Button>
      </div>
    </form>
  </GuestLayout>
</template>
