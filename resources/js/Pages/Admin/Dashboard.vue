<template>
  <Head title="Dashboard" />

  <admin-layout>
    <template #breadcrumbs>
      <Breadcrumb :breadcrumbs="breadcrumbs" />
    </template>
    <div class="pt-5">
      <span class="text-black font-bold text-lg">Dashboard Manajemen Surat</span>
    

      <div class="flex flex-col pt-5 md:flex-row space-y-4 md:space-y-0 md:space-x-8">
        <div class="flex-1 flex flex-col space-y-2 box-content h-16 w-auto p-4 border-2 rounded-md">      
          <strong class="text-black font-bold text-base">Surat Diproses</strong>
          <div class="flex flex-row">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="25" viewBox="0 0 20 20">
              <mask id="lineMdEmailArrowDownTwotone0">
                <g fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                  <path stroke-dasharray="64" stroke-dashoffset="64" d="M4 5h16c0.55 0 1 0.45 1 1v12c0 0.55 -0.45 1 -1 1h-16c-0.55 0 -1 -0.45 -1 -1v-12c0 -0.55 0.45 -1 1 -1Z">
                    <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.6s" values="64;0"/>
                  </path>
                  <path stroke-dasharray="24" stroke-dashoffset="24" d="M3 6.5l9 5.5l9 -5.5">
                    <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.6s" dur="0.2s" values="24;0"/>
                  </path>
                  <path fill="#fff" fill-opacity="0" stroke="none" d="M12 11l-8 -5h16l-8 5Z">
                    <animate fill="freeze" attributeName="fill-opacity" begin="1.2s" dur="0.15s" values="0;0.3"/>
                  </path>
                  <path fill="#000" fill-opacity="0" stroke="none" d="M19 13c3.31 0 6 2.69 6 6c0 3.31 -2.69 6 -6 6c-3.31 0 -6 -2.69 -6 -6c0 -3.31 2.69 -6 6 -6Z">
                    <set fill="freeze" attributeName="fill-opacity" begin="0.8s" to="1"/>
                  </path>
                  <path stroke-dasharray="6" stroke-dashoffset="6" d="M19 16v5">
                    <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.8s" dur="0.2s" values="6;0"/>
                  </path>
                  <path stroke-dasharray="4" stroke-dashoffset="4" d="M19 21l2 -2M19 21l-2 -2">
                    <animate fill="freeze" attributeName="stroke-dashoffset" begin="1s" dur="0.2s" values="4;0"/>
                  </path>
                </g>
              </mask>
              <rect width="24" height="24" fill="currentColor" mask="url(#lineMdEmailArrowDownTwotone0)"/>
            </svg>
            <span class="ml-2 text-black text-xl font-bold">{{ surat.proses }}</span>
          </div>
        </div>

        <div class="flex-1 flex flex-col space-y-2 box-content h-16 w-auto p-4 border-2 rounded-md">      
          <strong class="text-black font-bold text-base">JumlahSurat Selesai</strong>
          <div class="flex flex-row">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="25" viewBox="0 0 20 20">
              <mask id="lineMdEmailArrowUp0">
                <g fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                  <path stroke-dasharray="64" stroke-dashoffset="64" d="M4 5h16c0.55 0 1 0.45 1 1v12c0 0.55 -0.45 1 -1 1h-16c-0.55 0 -1 -0.45 -1 -1v-12c0 -0.55 0.45 -1 1 -1Z">
                    <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.6s" values="64;0"/>
                  </path>
                  <path stroke-dasharray="24" stroke-dashoffset="24" d="M3 6.5l9 5.5l9 -5.5">
                    <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.6s" dur="0.2s" values="24;0"/>
                  </path>
                  <path fill="#000" fill-opacity="0" stroke="none" d="M19 13c3.31 0 6 2.69 6 6c0 3.31 -2.69 6 -6 6c-3.31 0 -6 -2.69 -6 -6c0 -3.31 2.69 -6 6 -6Z">
                    <set fill="freeze" attributeName="fill-opacity" begin="0.8s" to="1"/></path><path stroke-dasharray="6" stroke-dashoffset="6" d="M19 21v-5">
                    <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.8s" dur="0.2s" values="6;0"/>
                  </path>
                  <path stroke-dasharray="4" stroke-dashoffset="4" d="M19 16l2 2M19 16l-2 2">
                    <animate fill="freeze" attributeName="stroke-dashoffset" begin="1s" dur="0.2s" values="4;0"/>
                  </path>
                </g>
              </mask>
              <rect width="24" height="24" fill="currentColor" mask="url(#lineMdEmailArrowUp0)"/>
            </svg>
            <span class="ml-2 text-black text-xl font-bold">{{ surat.selesai }}</span>
          </div>
        </div>

        <div class="flex-1 flex flex-col space-y-2 box-content h-16 w-auto p-4 border-2 rounded-md">
          <strong class="text-black font-bold text-base">Jumlah Seluruh Surat</strong>
          <div class="flex flex-row">      
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="25" viewBox="0 0 20 20">
              <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                <path stroke-dasharray="64" stroke-dashoffset="64" d="M6 5h16c0.55 0 1 0.45 1 1v12c0 0.55 -0.45 1 -1 1h-16c-0.55 0 -1 -0.45 -1 -1v-12c0 -0.55 0.45 -1 1 -1Z">
                  <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.6s" values="64;0"/>
                </path>
                <path stroke-dasharray="36" stroke-dashoffset="36" d="M19 23h-17c-0.55 0 -1 -0.45 -1 -1v-13">
                  <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.3s" dur="0.3s" values="36;0"/>
                </path>
                <path stroke-dasharray="24" stroke-dashoffset="24" d="M5 6.5l9 5.5l9 -5.5">
                  <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.6s" dur="0.2s" values="24;0"/>
                </path> 
              </g>
            </svg>
            <span class="ml-2 text-black text-xl font-bold">{{ surat.total }}</span>
          </div>
        </div>
      </div> 
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
        surat: {
          type: Object,
          required: true
        }
      },
    }
</script>