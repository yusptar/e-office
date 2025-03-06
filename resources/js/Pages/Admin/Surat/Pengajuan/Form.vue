<template>
  <form @submit.prevent="submit()">
    <div class="flex flex-col space-y-4">
      <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8">
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">No Surat <span class="text-red-400">*</span></span>
          <input type="text" :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-200': true, 'border-red-400': form.errors.no_surat }" v-model="form.no_surat" :disabled="form.processing">
          <span v-if="form.errors.no_surat" class="text-red-400 italic">{{ form.errors.no_surat }}</span>
        </div>
      </div>

      <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8">
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">Asal Surat<span class="text-red-400">*</span></span>
          <select-search
            clearable
            :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.asal_surat }"
            v-model="form.asal_surat"
            :disabled="form.processing"
            :options="disposisiOptions">
          </select-search>
          <span v-if="form.errors.asal_surat" class="text-red-400 italic">{{ form.errors.asal_surat }}</span>
        </div>
        <!-- <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">Asal Surat <span class="text-red-400">*</span></span>
          <input type="text" :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-200': true, 'border-red-400': form.errors.asal_surat }" v-model="form.asal_surat" :disabled="form.processing">
          <span v-if="form.errors.asal_surat" class="text-red-400 italic">{{ form.errors.asal_surat }}</span>
        </div> -->
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">Tujuan Surat <span class="text-red-400">*</span></span>
          <input type="text" :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-200': true, 'border-red-400': form.errors.tujuan_surat }" v-model="form.tujuan_surat" :disabled="form.processing">
          <span v-if="form.errors.tujuan_surat" class="text-red-400 italic">{{ form.errors.tujuan_surat }}</span>
        </div>
      </div>

      <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8">
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">No Agenda <span class="text-red-400">*</span></span>
          <input type="text" :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-200': true, 'border-red-400': form.errors.no_agenda }" v-model="form.no_agenda" :disabled="form.processing">
          <span v-if="form.errors.no_agenda" class="text-red-400 italic">{{ form.errors.no_agenda }}</span>
        </div>
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">Perihal Surat <span class="text-red-400">*</span></span>
          <input type="text" :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-200': true, 'border-red-400': form.errors.perihal_surat }" v-model="form.perihal_surat" :disabled="form.processing">
          <span v-if="form.errors.perihal_surat" class="text-red-400 italic">{{ form.errors.perihal_surat }}</span>
        </div>
      </div>

      <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8">
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">Sifat<span class="text-red-400">*</span></span>
          <select-search
            clearable
            :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.sifat_surat }"
            v-model="form.sifat_surat"
            :disabled="form.processing"
            :options="sifatOptions">
          </select-search>
          <span v-if="form.errors.sifat_surat" class="text-red-400 italic">{{ form.errors.sifat_surat }}</span>
        </div>
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">Jenis Surat<span class="text-red-400">*</span></span>
          <select-search
            clearable
            :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.jenis_surat }"
            v-model="form.jenis_surat"
            :disabled="form.processing"
            :options="jenisOptions">
          </select-search>
          <span v-if="form.errors.jenis_surat" class="text-red-400 italic">{{ form.errors.jenis_surat }}</span>
        </div>
      </div>
      <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8">
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">Kategori<span class="text-red-400">*</span></span>
          <select v-model="form.kategori_surat" :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-200': true, 'border-red-400': form.errors.kategori_surat }" :disabled="form.processing">
            <option value="" selected disabled>Kategori Surat</option>        
            <option value="Masuk">Masuk</option>
            <option value="Keluar">Keluar</option>
            <!-- <option value="Ref 3">REFERENSI 3</option>
            <option value="Ref 2">REFERENSI 2</option>
            <option value="Ref 1">REFERENSI 1</option> -->
          </select>
          <!-- <input type="text" :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-200': true, 'border-red-400': form.errors.kategori_surat }" v-model="form.kategori_surat" :disabled="form.processing"> -->
          <span v-if="form.errors.kategori_surat" class="text-red-400 italic">{{ form.errors.kategori_surat }}</span>
        </div>
        <!-- <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">Disposisi Akhir<span class="text-red-400">*</span></span>
          <select v-model="form.posisi_surat" :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-200': true, 'border-red-400': form.errors.posisi_surat }" :disabled="form.processing">
            <option value="" selected disabled>Pilih Disposisi Akhir</option>        
            <option value="Kepala">KEPALA</option>
            <option value="Waka">WAKIL KEPALA</option>
          </select>
          <span v-if="form.errors.posisi_surat" class="text-red-400 italic">{{ form.errors.posisi_surat }}</span>
        </div> -->
      </div>

      <div class="flex flex-col space-y-4">
        <div class="flex flex-col space-y-2">
          <span class="text-black font-medium">Upload File Surat </span>
          <input type="file" :class="{ 'rounded-md border border-black px-4 py-2 focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-200': true, 'border-red-400': form.errors.file_surat }" @change="onFileChange($event)" :disabled="form.processing">
          <progress v-if="form.progress" :value="form.progress.percentage" max="100">
            {{ form.progress.percentage }}%
          </progress>
          <span v-if="form.errors.file_surat" class="text-red-400 italic">{{ form.errors.file_surat }}</span>
        </div>
        <!-- <button @click="openModal">Lihat File Surat</button> -->

        <!-- Modal -->
        <!-- <div v-if="isModalOpen" class="modal">
          <div class="modal-content">
            <span class="close" @click="closeModal">&times;</span>
            <div v-if="file_path">
              <span class="text-black font-medium">File Surat yang Diunggah:</span>
              <embed :src="`/storage/${file_path}`" width="100%" height="500px" type="application/pdf" class="border border-gray-300" />
            </div>
          </div>
        </div> -->
        <div v-if="pengajuan && file_path" class="mt-4">
          <div v-if="file_path.endsWith('.pdf')">
            <span class="text-black font-medium">File yang Diunggah:</span>
            <embed :src="file_path" width="70%" height="400px" type="application/pdf" class="border border-gray-300" />
          </div>
          <div v-else-if="file_path.endsWith('.doc') || file_path.endsWith('.docx')">
            <span class="text-black font-medium">File yang Diunggah:</span>
            <iframe :src="`https://view.officeapps.live.com/op/embed.aspx?src=${encodeURIComponent(file_path)}`" width="70%" height="400px" class="border border-gray-300"></iframe>
          </div>
          <!-- <div v-else>
            <span class="text-red-500">Format file tidak didukung.</span>
          </div> -->
        </div>
      </div>
      <!-- <div v-if="qrCodeUrl" class="flex flex-col items-center mt-4">
        <span class="text-black font-medium">QR Code untuk Surat:</span>
        <a :href="qrCodeUrl" target="_blank" class="text-blue-500 underline mt-2"> 
          <qrcode-vue :value="qrCodeUrl" :size="150" class="mt-2" />
        </a>
      </div> -->
      <div class="flex flex-row justify-end space-x-4">
        <button type="button" class="py-3 px-6 text-center shadow-md rounded-md font-semibold text-white bg-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-300 disabled:cursor-not-allowed" @click.prevent="form.reset();form.clearErrors()" :disabled="form.processing">
          Back
        </button>
        <button type="submit" class="py-3 px-6 text-center shadow-md rounded-md font-semibold text-white bg-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-300 disabled:cursor-not-allowed" :disabled="form.processing">
          Save
        </button>
      </div>
    </div>
  </form>
</template>

<script>
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import QrcodeVue from 'qrcode.vue';
import SelectSearch from '@/Components/Select/SelectSearch.vue';

export default {
  name: 'MasterSuratMasukForm',
  components: {
    QrcodeVue,
    SelectSearch
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
      // posisi_surat: '',
      file_surat: '',
    });

    const disposisiOptions = ref([
        { value: "Pangdam / Kakes", label: "Pangdam / Kakes" },
        { value: "Waka", label: "Waka" },
        { value: "Ketua Komite Medik", label: "Ketua Komite Medik" },
        { value: "SMF Gol IV", label: "SMF Gol IV" },
        { value: "Ka SPI", label: "Ka SPI" },
        { value: "Jangum", label: "Jangum" },
        { value: "Jangmed", label: "Jangmed" },
        { value: "Jangwat", label: "Jangwat" },
        { value: "Kaur Simak", label: "Kaur Simak" },
        { value: "Renproggar", label: "Renproggar" },
        { value: "Paku", label: "Paku" },
        { value: "Bendahara", label: "Bendahara" },
        { value: "Kabid Yanmed, Keperawatan & Penunjang", label: "Kabid Yanmed, Keperawatan & Penunjang" },
        { value: "Kabag Yanmed", label: "Kabag Yanmed" },
        { value: "Ka Instal Kabed", label: "Ka Instal Kabed" },
        { value: "Gadar", label: "Gadar" },
        { value: "Rehabmed", label: "Rehabmed" },
        { value: "Farmasi", label: "Farmasi" },
        { value: "Kabag Keperawatan", label: "Kabag Keperawatan" },
        { value: "Kasub Instal Watnap", label: "Kasub Instal Watnap" },
        { value: "Kasub Instal Watlan", label: "Kasub Instal Watlan" },
        { value: "Kabag Penunjang", label: "Kabag Penunjang" },
        { value: "Kasi Jangdiag", label: "Kasi Jangdiag" },
        { value: "Ka Radiologi", label: "Ka Radiologi" },
        { value: "Ka Lab", label: "Ka Lab" },
        { value: "Ka Lab PA", label: "Ka Lab PA" },
        { value: "Ka SIMRS", label: "Ka SIMRS" },
        { value: "Ka BPJS & Asuransi Lain", label: "Ka BPJS & Asuransi Lain" },
        { value: "Komite - Komite", label: "Komite - Komite" },
        { value: "Ka Humas, Pemasaran & Pengaduan", label: "Ka Humas, Pemasaran & Pengaduan" },
        { value: "Ka MPP / Case Manager", label: "Ka MPP / Case Manager" },
        { value: "Kaur Pam", label: "Kaur Pam" },
        { value: "Kaur Pers", label: "Kaur Pers" },
        { value: "Kaur Dal", label: "Kaur Dal" },
        { value: "PP Konstruksi", label: "PP Konstruksi" },
        { value: "Ka MCU", label: "Ka MCU" },
        { value: "Onkologi Terpadu", label: "Onkologi Terpadu" },
        { value: "Unit CSSD", label: "Unit CSSD" },
        { value: "Unit HD", label: "Unit HD" },
        { value: "Jantung Terpadu", label: "Jantung Terpadu" },
        { value: "ESWL & Endoscopy", label: "ESWL & Endoscopy" },
        { value: "Kabid Diklat Litbangkes/Komkordik", label: "Kabid Diklat Litbangkes/Komkordik" },
        { value: "Kabag Dik", label: "Kabag Dik" },
        { value: "Kasi Dik Dokter", label: "Kasi Dik Dokter" },
        { value: "Kasi Nakes Lain", label: "Kasi Nakes Lain" },
        { value: "Kabag Litbangkes", label: "Kabag Litbangkes" },
        { value: "Kasi Lat", label: "Kasi Lat" },
        { value: "Kasi Litbangkes", label: "Kasi Litbangkes" },
        { value: "Ka Primkop Kartika Rumkit", label: "Ka Primkop Kartika Rumkit" },
        { value: "Ketua Persit Anak Ranting 2", label: "Ketua Persit Anak Ranting 2" }
    ]);

    const sifatOptions = ref([
        { value: "Segera", label: "SEGERA" },
        { value: "Penting", label: "PENTING" },
        { value: "Rahasia", label: "RAHASIA" },
        { value: "Biasa", label: "BIASA" }
    ]);

    const jenisOptions = ref([
        { value: "Nota Dinas", label: "NOTA DINAS" },
        { value: "Surat Perintah", label: "SURAT PERINTAH" },
        { value: "Surat Keputusan", label: "SURAT KEPUTUSAN" },
        { value: "Surat Tugas", label: "SURAT TUGAS" },
        { value: "Surat Edaran", label: "SURAT EDARAN" },
        { value: "Surat Telegram Rahasia", label: "ST. RAHASIA" },
        { value: "Surat Eksternal", label: "SURAT EKSTERNAL" },
        { value: "Surat Internal", label: "SURAT INTERNAL" },
        { value: "Konsep Surat", label: "KONSEP SURAT" },
        { value: "Legalisasi", label: "LEGALISASI" }
    ]);

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
      disposisiOptions,
      sifatOptions,
      jenisOptions
    };
  }
};
</script>
