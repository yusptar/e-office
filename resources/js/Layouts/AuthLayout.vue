<template>
  <div class="min-h-screen flex flex-col justify-center items-center bg-cover bg-center px-4 py-6">
    
    <!-- Logo -->
    <Link href="/" class="mb-4">
      <logo-image class="w-48 h-48 sm:w-20 sm:h-20 md:w-64 md:h-64" />
    </Link>

    <!-- Title -->
    <div class="text-center mb-4">
      <slot name="title">
        <h1 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-800">E-Office</h1>
      </slot>
    </div>

    <!-- Card -->
    <div class="w-full sm:max-w-md px-6 py-6 bg-white shadow-md rounded-lg">
      <slot />
    </div>

    <!-- Footer -->
    <small class="mt-6 text-center text-xs text-gray-400">
      {{ new Date().getFullYear() }} &copy; Rumkit Tk.II dr. Soepraoen. All Rights Reserved.
    </small>
  </div>
</template>

<script>
  import { Link } from '@inertiajs/inertia-vue3';
  import LogoImage from '@/Layouts/LogoImage.vue';

  export default {
    name: 'AuthLayout',
    components: {
      Link,
      LogoImage
    }
  }
</script>
