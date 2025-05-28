<template>
  <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-cover bg-center">
    
    <Link href="/">
        <logo-image class="w-1 h-1" />
    </Link>

    <!-- <div class="flex flex-row w-full sm:max-w-md items-center justify-center">
      <slot name="title">
        <span class="font-extrabold tracking-wide text-lg">E-Office</span>
      </slot>
    </div> -->

    <div class="w-full sm:max-w-md mt-6 px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-lg">
      <slot />
    </div>

    <small class="mt-5 tracking-wide text-white">{{ new Date().getFullYear() }} &copy; Unit SIMRS Rumkit Tk.II dr.Soepraoen. All Rights Reserved.</small>
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
