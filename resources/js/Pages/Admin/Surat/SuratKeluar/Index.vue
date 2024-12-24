<template>
    <Head title="Surat Masuk" />
  
    <admin-layout>
      <template #breadcrumbs>
        <Breadcrumb :breadcrumbs="breadcrumbs" />
      </template>
      <div class="pt-5">
        <span class="text-black font-bold text-base">Proses Pengembangan Halaman Surat Keluar</span>
      </div>
    </admin-layout>
  </template>
  
  <script>
      import { ref } from "vue";
      import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
      import AdminLayout from '@/Layouts/AdminLayout.vue';
      import Breadcrumb from '@/Layouts/Breadcrumb.vue';
      import DialogModal from '@/Components/Modal/DialogModal.vue';
  
      export default {
        name: 'TransaksiPenagihanIndex',
        components: {
          Head,
              Link,
              AdminLayout,
              Breadcrumb,
              DialogModal,
          },
        props: {
          breadcrumbs: {
            type: Array
          },
        },
      }
  </script>