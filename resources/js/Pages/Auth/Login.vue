<script setup>
import { Button } from "@/Components/ui/button";
import { Input } from "@/Components/ui/input";
import { Label } from "@/Components/ui/label";

import { Head, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import Checkbox from "@/Components/Checkbox.vue";

defineProps({
  canResetPassword: {
    type: Boolean,
  },
  status: {
    type: String,
  },
});

const form = useForm({
  email: "",
  password: "",
  remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
  <Head title="Log in" />

  <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
    {{ status }}
  </div>

  <form @submit.prevent="submit">
    <div class="w-full lg:grid lg:grid-cols-2 lg:min-h-screen xl:min-h-screen">
      <div class="flex items-center justify-center py-12">
        <div class="mx-auto grid w-[350px] gap-6">
          <div class="grid gap-2 text-center">
            <h1 class="text-3xl font-bold">Login</h1>
            <p class="text-balance text-muted-foreground">
              Enter your email below to login to your account
            </p>
          </div>
          <form @submit.prevent="submit">
            <div class="grid gap-4">
              <div class="grid gap-2">
                <Label for="email">Email</Label>
                <Input id="email" type="email" v-model="form.email" required autofocus />
                <InputError class="mt-2" :message="form.errors.email" />
              </div>
              <div class="grid gap-2">
                <div class="flex items-center">
                  <Label for="password">Password</Label>
                  <a
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="inline-block ml-auto text-sm underline hover:text-muted-foreground"
                  >
                    Forgot your password?
                  </a>
                </div>
                <Input
                  id="password"
                  type="password"
                  class="block w-full mt-1"
                  v-model="form.password"
                  required
                  autocomplete="current-password"
                />
              </div>
              <InputError class="mt-2" :message="form.errors.password" />

              <div class="block mt-4">
                <label class="flex items-center">
                  <Checkbox name="remember" v-model:checked="form.remember" />
                  <span class="text-sm text-gray-600 ms-2">Remember me</span>
                </label>
              </div>

              <Button
                type="submit"
                class="w-full"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
              >
                Login
              </Button>
              <Button variant="outline" class="w-full"> Login with Google </Button>
            </div>
          </form>
          <div class="mt-4 text-sm text-center">
            Don't have an account?
            <a href="register" class="underline hover:text-muted-foreground">
              Register
            </a>
          </div>
        </div>
      </div>
      <div class="hidden bg-muted lg:block">
        <img
          src="https://picsum.photos/1920/1080"
          alt="Image"
          width="1920"
          height="1080"
          class="h-full w-full object-cover dark:brightness-[0.2] dark:grayscale"
        />
      </div>
    </div>
  </form>
</template>
