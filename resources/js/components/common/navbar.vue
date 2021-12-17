<template>
  <div class="relative flex flex-wrap items-center justify-between px-sm-2">
    <div class="container mx-auto flex flex-wrap items-center justify-between">
        <div class="w-full relative flex lg:w-auto lg:static lg:block lg:justify-start  px-2 px-sm-0">
          <a class="" href="/">
            <svg-vue icon="lfi-logo" class="w-36"></svg-vue>
          </a>
          <input class="ml-auto text-white cursor-pointer text-xl leading-none px-3 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"  v-on:click="toggleNavbar()" id="menu__toggle" type="checkbox" />
              <label class="menu__btn" for="menu__toggle">
              <span></span>
              </label>
        </div>
        <nav class="w-full lg:w-auto">
          <ul v-bind:class="{'hidden': !showMenu, 'block': showMenu}" 
            class="menu items-center w-full justify-between  md:w-auto lg:flex lg:flex-grow ">
            <li
              v-for="(list, listindex) in  nav_items"
              :key="listindex"
              class="group hover:bg-white relative md:leading-extra-loose">
                <a
                class="block md:inline-block px-4 py-3 no-underline text-white text-tiny uppercase font-semibold group-hover:text-primary"
                :href="url + '/'+ list.link">
                {{ list.display_name }}
                </a>
              <ul
                class="z-50 bg-white border-none shadow-2xl rounded-sm transform scale-0 group-hover:scale-100 absolute transition duration-150 ease-in-out origin-top w-full min-w-250 leading-normal">
                <li
                  v-for="(item, itemindex) in list.sub_menu"
                  :key="itemindex"
                  class="rounded-sm relative px-0 py-1 hover:bg-secondary bg-white hover:text-white">
                <button
                  class="w-full text-left flex items-center outline-none focus:outline-none text-primary text-tiny uppercase font-semibold hover:text-white">
                  <a class="px-3 py-3 flex-1" :href="url + '/'+ item.link.cached_url">
                    {{ item.display_name }}
                  </a>
                  <span class="submenu-arrow m-auto pr-2" v-if="item.sub_menu.length !== 0">
                    <svg
                      class="fill-current h-4 w-4 transition duration-150 ease-in-out"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20">
                      <path
                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                      />
                    </svg>
                  </span>
                </button>

                  <ul class="sub-menu md:bg-white border-none shadow-2xl rounded-sm absolute top-0 right-0 
                    transition duration-150 ease-in-out origin-top-left
                    w-full -left-1.5
                    ">
                    <li   
                      v-for="(item2, item2index) in item.sub_menu"
                      :key="item2index"
                      class="md:px-3 pt-2 pb-1 hover:bg-secondary text-primary hover:text-white text-tiny font-semibold ">
                      <a class=""  :href="url + '/'+ item2.link.cached_url">
                        {{ item2.display_name }}
                      </a>
                      <p class="text-xs my-2">{{ item2.summary }}</p>
                    </li>
                  </ul>
                </li>
              </ul>
            </li>
            <li 
              class="block mx-auto text-center bg-primary md:bg-transparent md:border-none lg:py-0 py-6 pl-4">
              <a href="/business-partner"
                class="inline btn-secondary text-tiny font-semibold ">
                <svg-vue icon="work" class="inline-block w-6 mb-1"></svg-vue>
                Business Partner
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
</template>

<script>

export default {
	name: 'Navbar',
	props: [
    'sourceItems',
    'url'
  ],
	data() {
		return {
            nav_items:{},
            showMenu: false
		}
	},

	created() {
    let self = this;
    let sourceItems=  JSON.parse(this.sourceItems);
    let items = [];
    if (typeof this.sourceItems !== 'undefined' && sourceItems.length){
      sourceItems.forEach(function (navItem){
        items.push({
          'display_name': navItem.display_name,
          'summary': navItem.summary,
          'link': (navItem.link.cached_url !== 'home' ? navItem.link.cached_url: ''),
          'sub_menu':(navItem.sub_menu.length ? self.menuIteration(navItem.sub_menu) : []),
        });
      });
    }
    this.nav_items = items;
    // console.log(this.nav_items);
    // console.log(sourceItems);
	},

  methods: {
    menuIteration(o) {
      let self = this;
        Object.keys(o).forEach(function (k) {
            if (o[k] !== null && typeof o[k] === 'object') {
                self.menuIteration(o[k]);
                return;
            }
            if (typeof o[k] === 'string') {
                o[k] = o[k].replace(/'/g, "''");
            }
        });
        return o;
    },
    toggleNavbar: function(){
      this.showMenu = !this.showMenu;
    },
	},
};

</script>