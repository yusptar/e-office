<template>
  <ul>
    <li v-for="menu in $page.props.mainMenu">
      <div>
        <Link v-if="!menu.children && hasAccess(menu.access, $page.props.currentUser.jabatan.hak_akses)" 
          :href="menu.route === '#' ? '#' : route(menu.route)" 
          :class="{ 'h-12 flex items-center pl-5 mb-1 relative rounded-full': true, 'text-white bg-dark-1': menu.active, 'text-gray-300 hover:bg-dark-3': !menu.active }">
          
          <!-- Ganti ikon di sini -->
          <slot :name="'icon-menu-' + menu.uniqid">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2zm0 2v12h16V6H4zm8 3h2v3h3v2h-3v3h-2v-3H9v-2h3V9z"/>
            </svg>
          </slot>
          
          <div class="w-full ml-3 flex items-center"> {{ menu.text }} </div>
        </Link>

        <SubMenu v-else :menu="menu">
          <template v-slot:[scopedHeaderSlotName(menu.uniqid)]="slotData">
            <slot :name="'icon-menu-' + menu.uniqid" v-bind="slotData" />
          </template>
        </SubMenu>
      </div>
    </li>
  </ul>
</template>


<script>
  import { usePage, Link } from '@inertiajs/inertia-vue3';
  import SubMenu from "@/Layouts/SubMenu.vue";
  
  export default {
    name: 'MainMenu',
    components: {
      Link,
      SubMenu,
    },
    setup() {
      function scopedHeaderSlotName(uniqid) {
        return 'icon-menu-' + uniqid
      }

      return {
        scopedHeaderSlotName,
      }
    }
  }
</script>