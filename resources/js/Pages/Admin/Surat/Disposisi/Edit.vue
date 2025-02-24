<template>
    <Head title="Disposisi" />
  
    <admin-layout>
      <template #breadcrumbs>
        <Breadcrumb :breadcrumbs="breadcrumbs" />
      </template>
      
      <template #page-title>
        <h2 class="text-dark-7 text-lg font-medium mr-auto pb-5">Bukti Tanda Tangan Secara Digital:</h2>
      </template>
  
      <pengajuan-form
        http-method="put"
        :action-uri="route('admin.surat.disposisi.update', [pengajuan.slug])"
        :pengajuan="pengajuan"
        :user-access="userAccess"
       />
  
    </admin-layout>
  </template>
  
  <script>
    import { Head, useForm } from '@inertiajs/inertia-vue3';
    import AdminLayout from '@/Layouts/AdminLayout.vue';
    import Breadcrumb from '@/Layouts/Breadcrumb.vue';
    import PengajuanForm from '@/Pages/Admin/Surat/Disposisi/Form.vue';
  
    export default {
      name: 'MasterPengajuanCreate',
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
        },
        pengajuan: {
          type: Object,
          default: () => null
        }
      }
    }
  </script>