<template>
  <Head title="Pengajuan Surat" />

  <admin-layout>
    <template #breadcrumbs>
      <Breadcrumb :breadcrumbs="breadcrumbs" />
    </template>
    
    <template #page-title>
      <h2 class="text-dark-7 text-lg font-medium mr-auto pb-5">Verifikasi TTD Surat</h2>
    </template>

  </admin-layout>
</template>

<script>
  import { Head, useForm } from '@inertiajs/inertia-vue3';
  import AdminLayout from '@/Layouts/AdminLayout.vue';
  import Breadcrumb from '@/Layouts/Breadcrumb.vue';

  export default {
    name: 'MasterPengajuanCreate',
    components: {
      Head,
      AdminLayout,
      Breadcrumb,
    },
    props: {
      breadcrumbs: {
        type: Array
      },
      sertifikasi: {
        type: Object,
        default: () => null
      }
    }
  }
</script>