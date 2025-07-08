<template>
  <Head title="Surat Masuk" />

  <admin-layout>
    <template #breadcrumbs>
      <Breadcrumb :breadcrumbs="breadcrumbs" />
    </template>
    
    <!-- <template #page-title>
      <h2 class="text-dark-7 text-lg font-medium mr-auto">Surat Masuk</h2>
    </template> -->

    <template #page-title>
      <h2 class="text-dark-7 text-lg font-medium mr-auto">Disposisi</h2>
    </template>

    <datatables
      ref="datatables"
      class="pt-4"
      :route-uri="route('admin.surat.masuk.table')"
      v-model:columns="columns"
      table-class="w-full table-auto border-collapse text-black"
      thead-class="bg-white text-black border-b-2 border-black"
      search-class="border-b border-0 border-black bg-white text-black placeholder-gray-500 focus:outline-none focus:border-b focus:border-0 focus:ring-0"
      loader-type="bar"
      loading-bar-class="bg-blue-600"
      disable-skeleton-loader
      disable-pagination-label
      disable-rows-per-page
      reload-button-class="focus:outline-none p-3 text-center shadow-md rounded-md font-semibold text-white bg-blue-600 focus:ring-4 focus:ring-blue-600"
      search-label="Cari Surat" >
      <template #label.no-record>
        <div class="py-2">Tidak ada data untuk ditampilkan.</div>
      </template>
      <template #label.no-result>
        <div class="py-2">Tidak ada data yang sesuai dengan kriteria pencarian.</div>
      </template>
      <template #icon.search>
        <svg class="w-4 h-4 absolute left-2.5 top-3.5 pointer-events-none text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
      </template>
      <template #label.reload-button>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 stroke-current" viewBox="0 0 16 16">
          <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
          <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
        </svg>
      </template>
      <template #after.reload-button>
        <Link v-if="hasAccess('module.surat.masuk.index', $page.props.currentUser.jabatan.hak_akses)" :href="route('admin.surat.masuk.create')" class="p-3 text-center shadow-md rounded-md font-semibold text-white bg-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-300">
          <div class="flex content-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 md:w-3 md:h-3 stroke-current" viewBox="0 0 16 16">
              <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"/>
            </svg>
            <span class="hidden md:inline-flex ml-2">Pengajuan Surat Baru</span>
          </div>
        </Link>
      </template>

      <template #grid.content.body.action="{ row }">
        <div class="flex flex-row justify-center space-x-4">
          <Link v-if="hasAccess('module.surat.masuk.edit', $page.props.currentUser.jabatan.hak_akses)" :href="route('admin.surat.masuk.edit', {pengajuan: row.slug})">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 stroke-current text-blue-600" viewBox="0 0 16 16">
              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>
          </Link>
          <button v-if="hasAccess('module.surat.masuk.delete', $page.props.currentUser.jabatan.hak_akses)" type="button" class="appearance-none outline-none focus:border-transparent focus:outline-none bg-transparent" @click.prevent="confirmDeleteRow(row)">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 stroke-current text-red-600" viewBox="0 0 16 16">
              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
              <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
            </svg>
          </button>
        </div>
      </template>

      <template #table.cell.content.action="{ row }">
        <div class="flex flex-row justify-center space-x-4">
          <!-- <Link v-if="hasAccess('module.surat.masuk.edit', $page.props.currentUser.jabatan.hak_akses)" :href="route('admin.surat.masuk.edit', {pengajuan: row.slug})">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 stroke-current text-blue-600" viewBox="0 0 16 16">
              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>
          </Link> -->
          <button v-if="hasAccess('module.surat.masuk.delete', $page.props.currentUser.jabatan.hak_akses)" type="button" class="appearance-none outline-none focus:border-transparent focus:outline-none bg-transparent" @click.prevent="confirmDeleteRow(row)">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 stroke-current text-red-600" viewBox="0 0 16 16">
              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
              <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
            </svg>
          </button>
        </div>
      </template>

      <template #table.cell.content.Status="{ row }">
        <div class="flex flex-row justify-center space-x-1">
          <template v-if="row.status == 0">
            <button 
              @click.prevent="confirmResponse(row)"
              class="flex items-center space-x-2 px-3 py-2 bg-green-600 text-white rounded-md hover:bg-green-700"
            >
              <svg xmlns="http://www.w3.org/2000/svg" width="16" cheight="16" viewBox="0 0 8 8">
                <path fill="currentColor" d="M5 0v2C1 2 0 4.05 0 7c.52-1.98 2-3 4-3h1v2l3-3.16L5 0z"/>
              </svg>
              <span>Tanggapi</span>
            </button>
          </template>
          <template v-else-if="row.status == 1">
            <button 
              @click.prevent="confirmAccept(row)"
              class="flex items-center gap-2 px-2 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-400"
            >
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              Disposisi
            </button>
          </template>
        </div>
      </template>

      <template #table.cell.content.fileSurat="{ row }">
        <div align="center">
          <button 
            @click="openModal(row)"
            class="btn btn-primary">
            <img :src="baseUrl + '/img/file.png'" alt="file" class="w-6 h-6">
          </button>

          <!-- Modal -->
          <transition name="modal-fade">
            <div 
              v-if="showModalFile" 
              class="fixed inset-0 flex justify-center items-center z-50"
              @click.self="closeModal"
            >
              <div 
                class="bg-white rounded-lg shadow-lg overflow-hidden relative flex flex-col"
                style="width: 90%; max-width: 1200px; height: 80vh;"
              >
                <!-- Modal Header -->
                <div class="flex justify-between items-center px-5 py-3 border-b bg-gray-100">
                  <h3 class="text-lg font-semibold">Pratinjau</h3>
                  <button 
                    @click="closeModal" 
                    class="text-gray-500 hover:text-red-500 text-2xl"
                  >
                    &times;
                  </button>
                </div>

                <!-- Modal Body -->
                <div class="p-4 flex-1 overflow-auto bg-gray-50">
                  <div v-if="isPdf" class="w-full h-full">
                    <embed
                      :src="`${baseUrl}/storage/${currentRow.file_surat}`"
                      type="application/pdf"
                      class="w-full h-full border border-gray-300"
                    />
                  </div>
                  <div v-else class="w-full h-full">
                    <iframe
                      :src="`https://view.officeapps.live.com/op/embed.aspx?src=${encodeURIComponent(`${baseUrl}/storage/${currentRow.file_surat}`)}`"
                      class="w-full h-full border border-gray-300"
                      frameborder="0"
                    ></iframe>
                  </div>
                </div>

                <!-- Modal Footer -->
                <template v-if="currentRow.status == 0">
                  <div class="flex justify-end p-4 border-t bg-gray-100">
                    <button 
                      @click.prevent="confirmResponse(currentRow)"
                      class="flex items-center space-x-2 px-3 py-2 bg-green-600 text-white rounded-md hover:bg-green-700"
                    >
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 8 8">
                        <path fill="currentColor" d="M5 0v2C1 2 0 4.05 0 7c.52-1.98 2-3 4-3h1v2l3-3.16L5 0z"/>
                      </svg>
                      <span>Tanggapi</span>
                    </button>
                  </div>
                </template>
                <template v-else-if="currentRow.status == 1">
                  <div class="flex justify-end p-4 border-t bg-gray-100">
                    <button 
                      @click.prevent="confirmAccept(currentRow)"
                      class="flex items-center gap-2 px-2 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-400"
                    >
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                      Disposisi
                    </button>
                  </div>
                </template>

              </div>
            </div>
          </transition>
        </div>
      </template>
    </datatables>

    <dialog-modal :show="showModal" @close="showModal = false">
      <div class="flex flex-col space-y-6 p-10 items-center">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128" class="w-20 h-20 fill-current text-yellow-500">
          <path d="M70.335 30.683c-1.569-2.719-3.878-4.278-6.337-4.278s-4.764 1.556-6.333 4.274l-34.6 59.94c-1.569 2.719-1.765 5.5-.536 7.628s3.734 3.348 6.871 3.348h69.2c3.138 0 5.643-1.22 6.871-3.348s1.035-4.907-.534-7.624zm31.484 65.452c-.456.785-1.627 1.237-3.216 1.237H29.4c-1.589 0-2.76-.452-3.214-1.237s-.26-2.029.536-3.406l34.6-59.94c.794-1.375 1.769-2.163 2.676-2.163s1.886.79 2.68 2.167l34.6 59.939c.798 1.377.994 2.616.541 3.403z"/>
          <path d="M64 78.144a2.11 2.11 0 0 0 2.111-2.111V48.24a2.111 2.111 0 0 0-4.222 0v27.793A2.11 2.11 0 0 0 64 78.144z"/>
          <circle cx="64" cy="86.506" r="3.734"/>
        </svg>
        <p class="text-center md:text-lg">
          Apakah Anda yakin untuk menghapus surat ini? Surat yang telah dihapus tidak dapat dikembalikan.
        </p>
        <div class="w-full pt-5">
          <div class="flex flex-row justify-center space-x-4">
            <button type="button" class="py-3 px-6 text-center shadow-md rounded-md font-semibold text-white bg-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-300 disabled:cursor-not-allowed" @click.prevent="showModal = false" :disabled="form.processing">
              Batal
            </button>
            <button type="button" class="py-3 px-6 text-center shadow-md rounded-md font-semibold text-white bg-red-500 focus:outline-none focus:ring-4 focus:ring-red-300 disabled:cursor-not-allowed" @click.prevent="deleteRow()" :disabled="form.processing">
              Hapus
            </button>
          </div>
        </div>
      </div>
    </dialog-modal>

    <dialog-modal :show="modalTanggapi" @close="modalTanggapi = false">
      <div class="flex flex-col space-y-6 p-10 items-center">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128" class="w-20 h-20 fill-current text-yellow-500">
          <path d="M70.335 30.683c-1.569-2.719-3.878-4.278-6.337-4.278s-4.764 1.556-6.333 4.274l-34.6 59.94c-1.569 2.719-1.765 5.5-.536 7.628s3.734 3.348 6.871 3.348h69.2c3.138 0 5.643-1.22 6.871-3.348s1.035-4.907-.534-7.624zm31.484 65.452c-.456.785-1.627 1.237-3.216 1.237H29.4c-1.589 0-2.76-.452-3.214-1.237s-.26-2.029.536-3.406l34.6-59.94c.794-1.375 1.769-2.163 2.676-2.163s1.886.79 2.68 2.167l34.6 59.939c.798 1.377.994 2.616.541 3.403z"/>
          <path d="M64 78.144a2.11 2.11 0 0 0 2.111-2.111V48.24a2.111 2.111 0 0 0-4.222 0v27.793A2.11 2.11 0 0 0 64 78.144z"/>
          <circle cx="64" cy="86.506" r="3.734"/>
        </svg>
        <p class="text-center md:text-lg">
          Apakah anda yakin untuk mengajukan surat ini?
        </p>

        <div class="w-full">
          <label for="perihal_surat" class="block text-sm font-medium text-gray-700">Perihal Surat</label>
          <textarea :class="{ 'w-full p-3 mt-2 border rounded-md disabled:bg-gray-200': true, 'border-red-400': form.errors.perihal_surat }"  :readonly="true" v-model="form.perihal_surat" rows="3" class="h-30" disabled/>
          <span v-if="form.errors.perihal_surat" class="text-red-400 italic">{{ form.value.errors.perihal_surat }}</span>
        </div>

        <div class="w-full">
          <label for="no_agenda" class="block text-sm font-medium text-gray-700">No Agenda</label>
          <input type="text" :class="{ 'w-full p-3 mt-2 border rounded-md disabled:bg-gray-200': true, 'border-red-400': form.errors.no_agenda }" :disabled="form.processing" v-model="form.no_agenda">
          <span v-if="form.errors.no_agenda" class="text-red-400 italic">{{ form.value.errors.no_agenda }}</span>
        </div>
        
        <div class="w-full">
          <label for="catatan_kasi_tuud" class="block text-sm font-medium text-gray-700">Disposisi Kasi TUUD</label>
          <textarea :class="{ 'w-full p-3 mt-2 border rounded-md disabled:bg-gray-200': true, 'border-red-400': form.errors.catatan_kasi_tuud }" :disabled="form.processing"  v-model="form.catatan_kasi_tuud" rows="4" class="h-40"/>
          <span v-if="form.errors.catatan_kasi_tuud" class="text-red-400 italic">{{ form.value.errors.catatan_kasi_tuud }}</span>
        </div>

        <div class="w-full">
          <label for="posisi_surat" class="block text-sm font-medium text-gray-700">Ajukan Surat Kepada</label>
          <select v-model="form.posisi_surat" :class="{ 'w-full p-3 mt-2 border rounded-md disabled:bg-gray-200': true, 'border-red-400': form.errors.posisi_surat }" :disabled="form.processing">     
            <option value="Kepala">KEPALA</option>
            <option value="Waka">WAKIL KEPALA</option>
          </select>
          <span v-if="form.errors.posisi_surat" class="text-red-400 italic">{{ form.value.errors.posisi_surat }}</span>
        </div>

        <div class="w-full">
          <label for="sifat_surat" class="block text-sm font-medium text-gray-700">Sifat Surat</label>
          <select v-model="form.sifat_surat" :class="{ 'w-full p-3 mt-2 border rounded-md disabled:bg-gray-200': true, 'border-red-400': form.errors.sifat_surat }" :disabled="form.processing">     
            <option value="Segera">SEGERA</option>
            <option value="Biasa">BIASA</option>
          </select>
          <span v-if="form.errors.sifat_surat" class="text-red-400 italic">{{ form.value.errors.sifat_surat }}</span>
        </div>

        <div class="w-full pt-5">
          <div class="flex flex-row justify-center space-x-4">
            <button type="button" class="py-3 px-6 text-center shadow-md rounded-md font-semibold text-white bg-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-300 disabled:cursor-not-allowed" @click.prevent="modalTanggapi = false" :disabled="form.processing">
              Batal
            </button>
            <button type="button" class="py-3 px-6 text-center shadow-md rounded-md font-semibold text-white bg-green-500 focus:outline-none focus:ring-4 focus:ring-red-300 disabled:cursor-not-allowed" @click.prevent="responseRequest()" :disabled="form.processing">
              Ajukan
            </button>
          </div>
        </div>
      </div>
    </dialog-modal>

    <dialog-modal :show="modalAccept" @close="modalAccept = false">
      <div class="flex flex-col space-y-6 p-10 items-center">
        <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128" class="w-20 h-20 fill-current text-yellow-500">
          <path d="M70.335 30.683c-1.569-2.719-3.878-4.278-6.337-4.278s-4.764 1.556-6.333 4.274l-34.6 59.94c-1.569 2.719-1.765 5.5-.536 7.628s3.734 3.348 6.871 3.348h69.2c3.138 0 5.643-1.22 6.871-3.348s1.035-4.907-.534-7.624zm31.484 65.452c-.456.785-1.627 1.237-3.216 1.237H29.4c-1.589 0-2.76-.452-3.214-1.237s-.26-2.029.536-3.406l34.6-59.94c.794-1.375 1.769-2.163 2.676-2.163s1.886.79 2.68 2.167l34.6 59.939c.798 1.377.994 2.616.541 3.403z"/>
          <path d="M64 78.144a2.11 2.11 0 0 0 2.111-2.111V48.24a2.111 2.111 0 0 0-4.222 0v27.793A2.11 2.11 0 0 0 64 78.144z"/>
          <circle cx="64" cy="86.506" r="3.734"/>
        </svg> -->
        <svg xmlns="http://www.w3.org/2000/svg" width="170" height="170" viewBox="0 0 48 48">
          <path fill="#D1C4E9" d="M38 7H10c-1.1 0-2 .9-2 2v6c0 1.1.9 2 2 2h28c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2zm0 12H10c-1.1 0-2 .9-2 2v6c0 1.1.9 2 2 2h28c1.1 0 2-.9 2-2v-6c0-1.1-.9-2-2-2zm0 12H10c-1.1 0-2 .9-2 2v6c0 1.1.9 2 2 2h28c1.1 0 2-.9 2-2v-6c0-1.1-.9-2-2-2z"/>
          <circle cx="38" cy="38" r="10" fill="#43A047"/>
          <path fill="#DCEDC8" d="M42.5 33.3L36.8 39l-2.7-2.7l-2.1 2.2l4.8 4.8l7.8-7.8z"/>
        </svg>

        <div class="w-full">
          <label for="catatan_kasi_tuud" class="block text-sm font-medium text-gray-700">Disposisi Kasi TUUD</label>
          <textarea :class="{ 'w-full p-3 mt-2 border rounded-md disabled:bg-gray-200': true, 'border-red-400': form.errors.catatan_kasi_tuud }"  :readonly="true" v-model="form.catatan_kasi_tuud" rows="3" class="h-20" disabled/>
          <span v-if="form.errors.catatan_kasi_tuud" class="text-red-400 italic">{{ form.value.errors.catatan_kasi_tuud }}</span>
        </div>

        <div class="w-full">
          <span class="text-black font-medium">Diteruskan Kepada <span class="text-red-400">*</span></span>
          <input
            list="disposisiList"
            v-model="form.asal_surat"
            :class="{
              'rounded-md focus:ring-1 w-full p-4 mt-2 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100 border border-gray-300': true,
              'border-red-400': form.errors.asal_surat
            }"
            placeholder="Pilih disposisi"
          />
          <datalist id="disposisiList">
            <option v-for="option in disposisiOptions" :key="option.value" :value="option.value">
              {{ option.label }}
            </option>
          </datalist>
          <span v-if="form.errors.asal_surat" class="text-red-400 italic">{{ form.errors.asal_surat }}</span>
        </div>

        <div class="w-full">
          <span class="text-black font-medium">Disposisi <span class="text-red-400">*</span></span>
            <select-search
              clearable
              :class="{ 'rounded-md focus:ring-1 w-full p-3 mt-2 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.rencana_aksi }"
              v-model="form.rencana_aksi"
              :disabled="form.processing"
              :options="rencanaAksiOptions">
            </select-search>
          <span v-if="form.errors.rencana_aksi" class="text-red-400 italic">{{ form.value.errors.rencana_aksi }}</span>
        </div>

        <div class="w-full flex flex-row gap-1">
          <!-- Kolom Catatan (kiri, lebih lebar) -->
          <div class="w-3/4">
            <label for="catatan_ka" class="block text-sm font-medium text-gray-700">Catatan</label>
            <textarea
              :class="{
                'w-full p-3 mt-2 border rounded-md disabled:bg-gray-200': true,
                'border-red-400': form.errors.catatan_ka  
              }"
              :disabled="form.processing"
              v-model="form.catatan_ka"
              rows="6"
              class="h-40"
            />
            <span v-if="form.errors.catatan_ka" class="text-red-400 italic">{{ form.value.errors.catatan_ka }}</span>
          </div>

          <!-- Kolom Paraf (kanan, lebih sempit) -->
          <div class="w-3/4">
            <label class="block text-sm font-medium text-gray-700">Paraf</label>
            <div class="w-full p-12 mt-2 rounded-md bg-white text-center">
              <div v-if="form.parafPreview" v-html="form.parafPreview"></div>
            </div>
          </div>
        </div>

        <div class="w-full pt-5">
          <div class="flex flex-row justify-center space-x-4">
            <button type="button" class="py-3 px-6 text-center shadow-md rounded-md font-semibold text-white bg-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-300 disabled:cursor-not-allowed" @click.prevent="modalAccept = false" :disabled="form.processing">
              Batal
            </button>
            <button type="button" class="py-3 px-6 text-center shadow-md rounded-md font-semibold text-white bg-green-500 focus:outline-none focus:ring-4 focus:ring-red-300 disabled:cursor-not-allowed" @click.prevent="acceptRequest()" :disabled="form.processing">
              Simpan
            </button>
            <button
              type="button"
              class="py-3 px-6 text-center shadow-md rounded-md font-semibold text-white bg-blue-500 focus:outline-none focus:ring-4 focus:ring-red-300 disabled:cursor-not-allowed"
              @click.prevent="showPasswordModal = true"
              :disabled="form.processing"
            >
              Paraf
            </button>
          </div>
        </div>
      </div>
    </dialog-modal>

    <dialog-modal :show="modalAcceptWakarumkit" @close="modalAcceptWakarumkit = false">
      <div class="flex flex-col space-y-6 p-10 items-center">
        <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128" class="w-20 h-20 fill-current text-yellow-500">
          <path d="M70.335 30.683c-1.569-2.719-3.878-4.278-6.337-4.278s-4.764 1.556-6.333 4.274l-34.6 59.94c-1.569 2.719-1.765 5.5-.536 7.628s3.734 3.348 6.871 3.348h69.2c3.138 0 5.643-1.22 6.871-3.348s1.035-4.907-.534-7.624zm31.484 65.452c-.456.785-1.627 1.237-3.216 1.237H29.4c-1.589 0-2.76-.452-3.214-1.237s-.26-2.029.536-3.406l34.6-59.94c.794-1.375 1.769-2.163 2.676-2.163s1.886.79 2.68 2.167l34.6 59.939c.798 1.377.994 2.616.541 3.403z"/>
          <path d="M64 78.144a2.11 2.11 0 0 0 2.111-2.111V48.24a2.111 2.111 0 0 0-4.222 0v27.793A2.11 2.11 0 0 0 64 78.144z"/>
          <circle cx="64" cy="86.506" r="3.734"/>
        </svg> -->
        <svg xmlns="http://www.w3.org/2000/svg" width="170" height="170" viewBox="0 0 48 48">
          <path fill="#D1C4E9" d="M38 7H10c-1.1 0-2 .9-2 2v6c0 1.1.9 2 2 2h28c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2zm0 12H10c-1.1 0-2 .9-2 2v6c0 1.1.9 2 2 2h28c1.1 0 2-.9 2-2v-6c0-1.1-.9-2-2-2zm0 12H10c-1.1 0-2 .9-2 2v6c0 1.1.9 2 2 2h28c1.1 0 2-.9 2-2v-6c0-1.1-.9-2-2-2z"/>
          <circle cx="38" cy="38" r="10" fill="#43A047"/>
          <path fill="#DCEDC8" d="M42.5 33.3L36.8 39l-2.7-2.7l-2.1 2.2l4.8 4.8l7.8-7.8z"/>
        </svg>

        <div class="w-full">
          <label for="catatan_kasi_tuud" class="block text-sm font-medium text-gray-700">Disposisi Kasi TUUD</label>
          <textarea :class="{ 'w-full p-3 mt-2 border rounded-md disabled:bg-gray-200': true, 'border-red-400': form.errors.catatan_kasi_tuud }"  :readonly="true" v-model="form.catatan_kasi_tuud" rows="3" class="h-20" disabled/>
          <span v-if="form.errors.catatan_kasi_tuud" class="text-red-400 italic">{{ form.value.errors.catatan_kasi_tuud }}</span>
        </div>

        <div class="w-full">
          <span class="text-black font-medium">Diteruskan Kepada <span class="text-red-400">*</span></span>
          <input
            list="disposisiList"
            v-model="form.asal_surat"
            :class="{
              'rounded-md focus:ring-1 w-full p-4 mt-2 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100 border border-gray-300': true,
              'border-red-400': form.errors.asal_surat
            }"
            placeholder="Pilih disposisi"
          />
          <datalist id="disposisiList">
            <option v-for="option in disposisiOptions" :key="option.value" :value="option.value">
              {{ option.label }}
            </option>
          </datalist>
          <span v-if="form.errors.asal_surat" class="text-red-400 italic">{{ form.errors.asal_surat }}</span>
        </div>

        <div class="w-full">
          <span class="text-black font-medium">Disposisi <span class="text-red-400">*</span></span>
            <select-search
              clearable
              :class="{ 'rounded-md focus:ring-1 w-full p-3 mt-2 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.rencana_aksi }"
              v-model="form.rencana_aksi"
              :disabled="form.processing"
              :options="rencanaAksiOptions">
            </select-search>
          <span v-if="form.errors.rencana_aksi" class="text-red-400 italic">{{ form.value.errors.rencana_aksi }}</span>
        </div>

        <div class="w-full flex flex-row gap-1">
          <!-- Kolom Catatan (kiri, lebih lebar) -->
          <div class="w-3/4">
            <label for="catatan_ka" class="block text-sm font-medium text-gray-700">Catatan</label>
            <textarea
              :class="{
                'w-full p-3 mt-2 border rounded-md disabled:bg-gray-200': true,
                'border-red-400': form.errors.catatan_ka  
              }"
              :disabled="form.processing"
              v-model="form.catatan_ka"
              rows="6"
              class="h-40"
            />
            <span v-if="form.errors.catatan_ka" class="text-red-400 italic">{{ form.value.errors.catatan_ka }}</span>
          </div>

          <!-- Kolom Paraf (kanan, lebih sempit) -->
          <div class="w-3/4">
            <label class="block text-sm font-medium text-gray-700">Paraf</label>
            <div class="w-full p-12 mt-2 rounded-md bg-white text-center">
              <div v-if="form.parafPreview" v-html="form.parafPreview"></div>
            </div>
          </div>
        </div>

        <div class="w-full pt-5">
          <div class="flex flex-row justify-center space-x-4">
            <button type="button" class="py-3 px-6 text-center shadow-md rounded-md font-semibold text-white bg-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-300 disabled:cursor-not-allowed" @click.prevent="modalAccept = false" :disabled="form.processing">
              Batal
            </button>
            <button type="button" class="py-3 px-6 text-center shadow-md rounded-md font-semibold text-white bg-green-500 focus:outline-none focus:ring-4 focus:ring-red-300 disabled:cursor-not-allowed" @click.prevent="acceptRequest()" :disabled="form.processing">
              Simpan
            </button>
            <button
              type="button"
              class="py-3 px-6 text-center shadow-md rounded-md font-semibold text-white bg-blue-500 focus:outline-none focus:ring-4 focus:ring-red-300 disabled:cursor-not-allowed"
              @click.prevent="showPasswordModal = true"
              :disabled="form.processing"
            >
              Paraf
            </button>
          </div>
        </div>
      </div>
    </dialog-modal>
    
    <dialog-modal :show="showPasswordModal" @close="showPasswordModal = false">
      <div class="p-6">
        <h2 class="text-lg font-bold mb-4">Konfirmasi Paraf</h2>
        <label class="block text-sm font-medium text-gray-700">Masukkan Password</label>
        <input
          type="password"
          v-model="parafPassword"
          class="w-full p-3 mt-2 border rounded-md focus:ring-indigo-500"
          placeholder="Password"
        />
        <div class="mt-6 flex justify-end gap-3">
          <button @click="showPasswordModal = false" class="px-4 py-2 bg-gray-400 text-white rounded-md">
            Batal
          </button>
          <button @click="verifyParafPassword" class="px-4 py-2 bg-green-600 text-white rounded-md">
            Paraf
          </button>
        </div>
        <p v-if="wrongPassword" class="text-red-500 italic mt-2">Password salah.</p>
      </div>
    </dialog-modal>
  
  </admin-layout>
</template>

<script>
  import { ref, computed  } from "vue";               
  import { Head, Link, usePage, useForm } from '@inertiajs/inertia-vue3';
  import AdminLayout from '@/Layouts/AdminLayout.vue';
  import Breadcrumb from '@/Layouts/Breadcrumb.vue';
  import Datatables from '@/Components/Datatable/Datatables.vue';
  import DialogModal from '@/Components/Modal/DialogModal.vue';
  import SelectSearch from '@/Components/Select/SelectSearch.vue';

  export default {
    data() {
      return {
        showModalFile: false,
        currentRow: null,
        isPdf: false,
        baseUrl: `${baseUrl}`,
        showPasswordModal: false,
        parafPassword: '',
        wrongPassword: false,
        corrPassword: `${parafpw}`,
      }; 
    },
    methods: {
      verifyParafPassword() {
        const correctPassword = `${this.corrPassword}`; 

        if (this.parafPassword === correctPassword) {
          this.wrongPassword = false;
          this.addParaf();
          this.showPasswordModal = false;
          this.parafPassword = '';
        } else {
          this.wrongPassword = true;
        }
      },
      addParaf() {
        const parafImg = `<img src="${this.baseUrl}/img/paraf.png" alt="Paraf" style="height:65px; text-align:center;"/>`;
        this.form.paraf = 1; 
        this.form.parafPreview = parafImg;
      },
      openModal(row) {
        this.currentRow = row;
        this.isPdf = row.file_surat.endsWith('.pdf');
        this.showModalFile = true;
      },
      closeModal() {
        this.showModalFile = false;
        this.currentRow = null;
        this.isPdf = false;
      },
      adjustModalSize() {
        if (this.isPdf) {
          this.modalStyle = {
            width: '45%',
            height: '520px',
          };
        } else {
          this.modalStyle = {
            width: '45%',
            height: '520px',
          };
        }
      },
    },
    name: 'MasterSuratMasukIndex',
    components: {
      Head,
      Link,
      AdminLayout,
      Breadcrumb,
      Datatables,
      DialogModal,
      SelectSearch,
    },
    props: {
      breadcrumbs: {
        type: Array
      },
    },
    setup() {
      
      const datatables = ref(null);
      const formatTanggal = (tanggal) => {
        if (!tanggal) return '-';
        const date = new Date(tanggal);
        if (isNaN(date.getTime())) return '-'; 

        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0'); 
        const day = String(date.getDate()).padStart(2, '0');

        return `${day}-${month}-${year}`;
      };

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


      const rencanaAksiOptions = ref([
        { value: "Tindak Lanjuti", label: "Tindak Lanjuti" },
        { value: "Ajukan Saran & Pertimbangan", label: "Ajukan Saran & Pertimbangan" },
        { value: "Sebagai Referensi", label: "Sebagai Referensi" },
        { value: "Pedomani", label: "Pedomani" },
        { value: "UDL" , label: "UDL" },
        { value: "UDK", label: "UDK" },
        { value: "Edarkan", label: "Edarkan" },
        { value: "Pelajari dan Laporkan HalJol", label: "Pelajari dan Laporkan HalJol" },
        { value: "Buat Laporan Lanjutan", label: "Buat Laporan Lanjutan" },
        { value: "Monitor / Pantau Selanjutnya", label: "Monitor / Pantau Selanjutnya" },
        { value: "Arsipkan", label: "Arsipkan" },
        { value: "Ka Rumkit Hadir", label: "Ka Rumkit Hadir" },
        { value: "Agar diwakili", label: "Agar diwakili" },
        { value: "PP Konstruksi", label: "PP Konstruksi" }
      ]);

      const columns = ref([
        {
          uniqid: 'rowIndex',
          label: 'No',
          field: 'rowIndex',
          sortable: false,
          sortOrder: 'asc',
          align: 'center',
          classes: 'px-4 py-2 md:py-4 text-center md:text-center',
          headerClass: 'text-center p-4'
        },
        {
          uniqid: 'tanggalSurat',
          label: 'Tanggal',
          field: (row) => formatTanggal(row.tanggal_surat),
          sortable: false,
          sortOrder: 'asc',
          align: 'center',
          classes: 'px-4 py-2 md:py-4 text-center md:text-center',
          headerClass: 'text-center p-4'
        },
        {
          uniqid: 'nomerSurat',
          label: 'Nomer Surat',
          field: 'no_surat',
          sortable: false,
          sortOrder: 'asc',
          align: 'center',
          classes: 'px-4 py-2 md:py-4 text-left md:text-center',
          headerClass: 'text-center p-4'
        },
        // {
        //   uniqid: 'kategoriSurat',
        //   label: 'Kategori',
        //   field: 'kategori_surat',
        //   sortable: false,
        //   sortOrder: 'asc',
        //   align: 'center',
        //   classes: 'px-4 py-2 md:py-4 text-left md:text-center',
        //   headerClass: 'text-center p-4'
        // },
        {
          uniqid: 'jenisSurat',
          label: 'Jenis',
          field: 'jenis_surat',
          sortable: false,
          sortOrder: 'asc',
          align: 'center',
          classes: 'px-4 py-2 md:py-4 text-left md:text-center',
          headerClass: 'text-center p-4'
        },
        // {
        //   uniqid: 'sifatSurat',
        //   label: 'Sifat',
        //   field: 'sifat_surat',
        //   sortable: false,
        //   sortOrder: 'asc',
        //   align: 'center',
        //   classes: 'px-4 py-2 md:py-4 text-left md:text-center',
        //   headerClass: 'text-center p-4'
        // },
        // {
        //   uniqid: 'asalSurat',
        //   label: 'Asal Surat',
        //   field: 'asal_surat',
        //   sortable: false,
        //   sortOrder: 'asc',
        //   align: 'center',
        //   classes: 'px-4 py-2 md:py-4 text-left md:text-center',
        //   headerClass: 'text-center p-4'
        // },
        {
          uniqid: 'asalSurat',
          label: 'Asal Surat',
          field: 'ruangan_val',
          sortable: false,
          sortOrder: 'asc',
          align: 'center',
          classes: 'px-4 py-2 md:py-4 text-left md:text-center',
          headerClass: 'text-center p-4'
        },
        {
          uniqid: 'perihalSurat',
          label: 'Perihal',
          field: 'perihal_surat',
          sortable: false,
          sortOrder: 'asc',
          align: 'center',
          classes: 'px-4 py-2 md:py-4 text-left md:text-center',
          headerClass: 'text-center p-4'
        },
        {
          uniqid: 'fileSurat',
          label: 'File',
          field: (row) => row.file_surat,
          sortable: false,
          sortOrder: 'asc',
          align: 'center',
          classes: 'px-4 py-2 md:py-4 text-left md:text-center',
          headerClass: 'text-center p-4'
        },
        // {
        //   uniqid: 'posisiSurat',
        //   label: 'Disposisi Akhir',
        //   field: 'posisi_surat',
        //   sortable: false,
        //   sortOrder: 'asc',
        //   align: 'center',
        //   classes: 'px-4 py-2 md:py-4 text-left md:text-center',
        //   headerClass: 'text-center p-4'
        // },
        {
          uniqid: 'Status',
          label: 'Status',
          field: (row) => row.status,
          sortable: false,
          sortOrder: 'asc',
          align: 'center',
          classes: 'px-4 py-2 md:py-4 text-left md:text-center',
          headerClass: 'text-center p-4'
        },
        {
          uniqid: 'action',
          label: 'Action',
          field: 'id',
          sortable: false,
          align: 'center',
          classes: 'px-4 py-2 md:py-4 text-center',
          headerClass: 'text-center p-4'
        }
      ]);

      const form = useForm({
        posisi_surat: "", 
        asal_surat: "",
        catatan_ka: "",
        catatan_kasi_tuud: "",
        rencana_aksi: "",
        slug: "",
        paraf: null,
        parafPreview: '',
      })

      const showModal = ref(false)
      const modalTanggapi = ref(false)
      const modalAccept = ref(false)
      const modalAcceptWakarumkit = ref(false)

      function confirmDeleteRow(row) {
        form.value = row
        showModal.value = true
      }

      function confirmResponse(row) {
        form.posisi_surat = row.posisi_surat
        form.catatan_kasi_tuud = row.catatan_kasi_tuud
        ? `Kepada Yth. WAKA/KA, ${row.catatan_kasi_tuud}`
        : "Kepada Yth. WAKA/KA, ";
        form.perihal_surat = row.perihal_surat
        form.no_agenda = row.no_agenda
        form.sifat_surat = row.sifat_surat
        form.slug = row.slug 
        modalTanggapi.value = true
      }

      function confirmAccept(row) {
        form.catatan_ka = row.catatan_ka || ''
        form.catatan_kasi_tuud = row.catatan_kasi_tuud || ''
        form.asal_surat = String(row.asal_surat || '')
        form.rencana_aksi = String(row.rencana_aksi || '')
        form.slug = row.slug || ''

        if (String(row.paraf) === "1") {
          form.parafPreview = `<img src="${baseUrl}/img/paraf.png" alt="Paraf" style="height:60px;" />`
        } else {
          form.parafPreview = ''
        }
        modalAccept.value = true
      }

      function deleteRow() {
        form.delete(route('admin.surat.masuk.destroy', { pengajuan: form.value.slug }), {
          onSuccess: () => {
            form.reset()
            showModal.value = false
            datatables.value.getData()
          }
        });
      }

      function responseRequest(){
        form.put(route('admin.surat.masuk.tanggapi', { pengajuan: form.slug }), {
          onSuccess: () => {
            form.reset()
            modalTanggapi.value = false
            datatables.value.getData()
          }
        });
      }

      function acceptRequest(){
        form.put(route('admin.surat.masuk.persetujuan', { pengajuan: form.slug }), {
          onSuccess: () => {
            form.reset()
            modalAccept.value = false
            datatables.value.getData()
          }
        });
      }
  
      return {
        datatables,
        columns,
        form,
        showModal,
        modalTanggapi,
        modalAccept,
        modalAcceptWakarumkit,
        confirmDeleteRow,
        deleteRow,
        confirmResponse,
        responseRequest,
        confirmAccept,
        acceptRequest,
        disposisiOptions,
        rencanaAksiOptions,
       
      }
    }
  }
</script>

<style>
.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0);
  z-index: 1050;
  display: flex;
  justify-content: center;
  align-items: center;
}
.modal-dialog {
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}
.modal-fade-enter-active,
.modal-fade-leave-active {
  transition: opacity 0.3s;
}
.modal-fade-enter,
.modal-fade-leave-to {
  opacity: 0;
}
.btn-close {
  background: none;
  border: none;
  font-size: 1.5rem;
  color: #000;
  cursor: pointer;
}
.btn-close:hover {
  color: #dc3545;
}
</style>