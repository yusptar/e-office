<template>
  <div class="flex min-h-screen-95">
    <!-- BEGIN: Content -->
    <div class="rounded-30px px-4 max-w-4xl shadow-md my-6 mx-auto py-0 md:px-6 min-w-0 min-h-full flex-1 pb-10 bg-white">
      <!-- BEGIN: Top Bar -->
      <div class="flex items-center relative border-b border-dark-3" style="height: 67px;">
        <!-- BEGIN: Breadcrumb -->
        <slot name="breadcrumbs">
          <Breadcrumb :breadcrumbs="breadcrumbs" />
        </slot>
        <!-- END: Breadcrumb -->
      </div>
      <!-- END: Top Bar -->

      <!-- BEGIN: Keterangan Tanda Tangan Elektronik -->
      <img src="/img/logorst-panjang.png" alt="BIOS Webservice" class="mx-auto max-w-full h-auto">
      <h5 class="text-center font-bold mt-4 mb-2">KETERANGAN TANDA TANGAN ELEKTRONIK PERSURATAN</h5>

      <div class="hash">
        <p><strong>Data Surat</strong></p>
      </div>
      <hr>
      <table class="w-full border-collapse border border-gray-300 mt-2">
        <thead>
          <tr class="bg-gray-200">
            <th class="border border-gray-300 px-3 py-2 w-1/3">No Surat</th>
            <th class="border border-gray-300 px-3 py-2 w-1/3">Perihal</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="border border-gray-300 px-3 py-2">{{ sertf.no_surat }}</td>
            <td class="border border-gray-300 px-3 py-2">{{ sertf.perihal_surat }}</td>
          </tr>
        </tbody>
      </table>
      <br>
      <div class="hash">
        <p><strong>Surat ini telah ditandatangani oleh:</strong></p>
      </div>
      <br> 
      <table class="w-full mt-2">
        <tbody>
          <tr>
            <td class="px-3 py-2">{{ sertf.posisi_surat }} Rumah Sakit Tk.II dr.Soepraoen</td>
          </tr>
        </tbody>
      </table>
      <hr class="my-4">
      <div class="timestamp text-center">
        <p>
          Ditandatangani pada: 
          <span v-if="ket_tte.tgl_signed === '0000-00-00 00:00:00'">(Masih Dalam Proses Penandatanganan)</span>
          <span v-else>{{ ket_tte.tgl_signed }}</span>
        </p>
      </div>
      <!-- END: Keterangan Tanda Tangan Elektronik -->
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from "vue";
import Breadcrumb from "@/Layouts/Breadcrumb.vue";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
  name: 'AdminLayout',
  components: {
    Breadcrumb
  },
  props: {
    httpMethod: {
      type: String,
      default: 'post',
      validator(value) {
        return ['get', 'post', 'put', 'patch', 'delete'].includes(value);
      },
    },
    actionUri: {
      type: String,
      default: '',
    },
    pengajuan: {
      type: Object,
      default: null,
    },
  },
  setup(props) {
    const sertf = useForm({
      no_surat: '',
      asal_surat: '',
      tujuan_surat: '',
      no_agenda: '',
      perihal_surat: '',
      sifat_surat: '',
      jenis_surat: '',
      kategori_surat: '',
      posisi_surat: '',
      file_surat: '',
    });

    onMounted(() => {
      if (props.pengajuan) {
        Object.assign(sertf, props.pengajuan);
      }
    });

    return {
      sertf
    };
  }
};
</script>
