<template>
  <v-app
    dark
  >
    <div class="panel panel-default">
        <div class="panel-heading">
            <v-toolbar
              color="red"
              dense
              fixed
              clipped-left
              app
            >
              <v-toolbar-side-icon @click="drawer = !drawer"></v-toolbar-side-icon>
              <v-toolbar-title class="mr-5 align-center">
                <router-link :to="{ name: 'home' }"><span class="title">JS GURU</span></router-link>
              </v-toolbar-title>
              <v-spacer></v-spacer>
              <v-layout row align-center style="max-width: 650px; flex: inherit;">
                <nav>
                    <ul class="list-inline">
                        <li v-if="!$auth.check()" class="pull-right">
                            <router-link :to="{ name: 'login' }">Login</router-link>
                        </li>
                        <li v-if="!$auth.check()" class="pull-right">
                            <router-link :to="{ name: 'register' }">Register</router-link>
                        </li>
                        <li v-if="$auth.check()" class="pull-right">
                            <a href="#" @click.prevent="$auth.logout()">Logout</a>
                        </li>
                    </ul>
                </nav>
              </v-layout>
            </v-toolbar>
        </div>
        <div class="panel-body">
            <router-view :drawer="drawer"></router-view>
        </div>
    </div>
  </v-app>
</template>
<script>
    import 'vuetify/dist/vuetify.min.css';
    export default {
        data() {
            return {
                drawer: true,
            }
        },
    }
</script>
<style scoped>
    ul.list-inline > li.pull-right {
        padding: 0 20px;
    }
</style>