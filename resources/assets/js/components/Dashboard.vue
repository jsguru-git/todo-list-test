<template>
  <v-app
    id="inspire"
    dark
  >
    <v-navigation-drawer
      v-model="drawer"
      fixed
      clipped
      app
    >
      <v-list dense>
        <v-list-tile v-for="item in items" :key="item.text" @click="">
          <v-list-tile-action>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>
              {{ item.text }}
            </v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-subheader class="mt-3 grey--text text--darken-1">SUBSCRIPTIONS</v-subheader>
        <v-list>
          <v-list-tile v-for="item in items2" :key="item.text" avatar @click="">
            <v-list-tile-avatar>
              <img :src="`https://randomuser.me/api/portraits/men/${item.picture}.jpg`" alt="">
            </v-list-tile-avatar>
            <v-list-tile-title v-text="item.text"></v-list-tile-title>
          </v-list-tile>
        </v-list>
        <v-list-tile class="mt-3" @click="">
          <v-list-tile-action>
            <v-icon color="grey darken-1">add_circle_outline</v-icon>
          </v-list-tile-action>
          <v-list-tile-title class="grey--text text--darken-1">Browse Channels</v-list-tile-title>
        </v-list-tile>
        <v-list-tile @click="">
          <v-list-tile-action>
            <v-icon color="grey darken-1">settings</v-icon>
          </v-list-tile-action>
          <v-list-tile-title class="grey--text text--darken-1">Manage Subscriptions</v-list-tile-title>
        </v-list-tile>
      </v-list>
    </v-navigation-drawer>
    <v-content>
      <v-container>
        <TodoList></TodoList> 
      </v-container>
    </v-content>
  </v-app>
</template>
<script>
	import TodoList from './TodoList.vue';
	export default {
		components: {
			TodoList,
		},
		data: () => ({
	    items: [
	      { icon: 'trending_up', text: 'Most Popular' },
	      { icon: 'subscriptions', text: 'Subscriptions' },
	      { icon: 'history', text: 'History' },
	      { icon: 'featured_play_list', text: 'Playlists' },
	      { icon: 'watch_later', text: 'Watch Later' }
	    ],
	    items2: [
	      { picture: 28, text: 'Joseph' },
	      { picture: 38, text: 'Apple' },
	      { picture: 48, text: 'Xbox Ahoy' },
	      { picture: 58, text: 'Nokia' },
	      { picture: 78, text: 'MKBHD' }
	    ]
	  }),
	  props: {
	  	drawer: {
				default: true,
				type: Boolean
			}
	  }
  }
</script>