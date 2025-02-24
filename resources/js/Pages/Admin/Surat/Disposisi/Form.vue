<template>
  <form @submit.prevent="submit()">
    <div class="flex flex-col space-y-4">
      <!-- <div class="flex flex-col space-y-4">
        <div v-if="pengajuan && file_path" class="mt-4">
          <div v-if="file_path.endsWith('.pdf')">
            <span class="text-black font-medium">File yang Diunggah:</span>
            <embed :src="file_path" width="70%" height="400px" type="application/pdf" class="border border-gray-300" />
          </div>
          <div v-else-if="file_path.endsWith('.doc') || file_path.endsWith('.docx')">
            <span class="text-black font-medium">File yang Diunggah:</span>
            <iframe :src="`https://view.officeapps.live.com/op/embed.aspx?src=${encodeURIComponent(file_path)}`" width="70%" height="400px" class="border border-gray-300"></iframe>
          </div>
        </div>
      </div> -->
      <div v-if="qrCodeUrl" class="flex flex-col items-center mt-4">
        <span class="text-black font-medium"></span>
        <a :href="qrCodeUrl" target="_blank" class="text-blue-500 underline mt-2"> 
          <qrcode-vue :value="qrCodeUrl" :size="500" class="mt-2" />
        </a>
      </div>
    </div>
  </form>
</template>

<script>
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import QrcodeVue from 'qrcode.vue';

export default {
  name: 'MasterSuratMasukForm',
  components: {
    QrcodeVue,
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
    sertifikasi: {
      type: Object,
      default: null,
    },
  },
  setup(props) {
    const form = useForm({
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

    const file_path = ref('');
    const qrCodeUrl = ref('');

    onMounted(() => {
      if (props.pengajuan) {
        Object.assign(form, props.pengajuan);
        file_path.value = `${window.baseUrl}/storage/${props.pengajuan.file_surat}`;
        generateQrCode(props.pengajuan.id); // Buat QR Code dari ID surat
      }
    });

    function submit() {
      form.transform((data) => ({
        ...data,
        file_surat: form.file_surat,
        _method: props.httpMethod,
      })).post(props.actionUri, {
        onSuccess: (response) => {
          if (response.props.id) {
            generateQrCode(response.props.id); // Buat QR Code setelah sukses
          }
        },
      });
    }

    function generateQrCode() {
      qrCodeUrl.value = `${window.baseUrl}/${props.pengajuan.slug}/sertifikasi`;
    }

    function onFileChange(evt) {
      let files = evt.target.files || evt.dataTransfer.files;
      if (!files.length) return;

      form.file_surat = files[0];
      file_path.value = URL.createObjectURL(files[0]);
    }

    return {
      form,
      file_path,
      qrCodeUrl,
      submit,
      onFileChange,
    };
  }
};
</script>
