<template>
    <Head title="Ajukan Surat Baru" />
  
    <admin-layout>
      <template #breadcrumbs>
        <Breadcrumb :breadcrumbs="breadcrumbs" />
      </template>
      
      <template #page-title>
        <h2 class="text-dark-7 text-lg font-medium mr-auto pb-5">Pengajuan Surat Baru</h2>
      </template>
  
      <pengajuan-form
        http-method="post"
        :action-uri="route('admin.surat.masuk.store')"
        :user-access="userAccess"
       />
  
    </admin-layout>
  </template>
  
  <script>
    import { Head, useForm } from '@inertiajs/inertia-vue3';
    import AdminLayout from '@/Layouts/AdminLayout.vue';
    import Breadcrumb from '@/Layouts/Breadcrumb.vue';
    import PengajuanForm from '@/Pages/Admin/Surat/SuratMasuk/Form.vue';
  
    export default {
      name: 'MasterSuratMasukCreate',
      components: {
        Head,
        AdminLayout,
        Breadcrumb,
        PengajuanForm,
      },
      props: {
        breadcrumbs: {
          type: Array
        },
        userAccess: {
          type: Array,
          default: () => []
        }
      }
    }
  </script>