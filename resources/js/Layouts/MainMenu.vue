<template>
  <ul>
    <li v-for="menu in $page.props.mainMenu">
      <div>
        <Link v-if="!menu.children && hasAccess(menu.access, $page.props.currentUser.jabatan.hak_akses)" 
          :href="menu.route === '#' ? '#' : route(menu.route)" 
          :class="{ 'h-12 flex items-center pl-5 mb-1 relative rounded-full': true, 'text-white bg-dark-1': menu.active, 'text-gray-300 hover:bg-dark-3': !menu.active }">
          
          <!-- Ganti ikon di sini -->
          <slot :name="'icon-menu-' + menu.uniqid">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16">
              <path fill="currentColor" d="M15 5.5a4.5 4.5 0 1 1-9 0a4.5 4.5 0 0 1 9 0Zm-4-2a.5.5 0 0 0-1 0V5H8.5a.5.5 0 0 0 0 1H10v1.5a.5.5 0 0 0 1 0V6h1.5a.5.5 0 0 0 0-1H11V3.5Zm1 9.5v-2.207c.349-.099.683-.23 1-.393V13a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h2.022a5.57 5.57 0 0 0 0 1H3a1 1 0 0 0-1 1v.74l5 2.692l.544-.293c.344.22.714.402 1.104.542l-1.41.76a.5.5 0 0 1-.475 0L2 8.875V13a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1Z"/>
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