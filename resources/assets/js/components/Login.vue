<!-- <template>
    <div>
        <div class="alert alert-danger" v-if="error">
            <p>There was an error, unable to sign in with those credentials.</p>
        </div>
        <form autocomplete="off" @submit.prevent="login" method="post">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" v-model="password" required>
            </div>
            <button type="submit" class="btn btn-default">Sign in</button>
        </form>
    </div>
</template> -->
<template>
  <v-app id="inspire">
    <v-content>
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md4>
            <v-card class="elevation-12">
                <v-form autocomplete="off" @submit.prevent="login" method="post">
                  <v-toolbar dark color="primary">
                    <v-toolbar-title>Login form</v-toolbar-title>
                  </v-toolbar>
                  <v-alert :value="error" color="error" icon="warning" transition="scale-transition">There was an error, unable to sign in with those credentials.</v-alert>
                  <v-card-text>
                      <v-text-field prepend-icon="person" name="login" label="Login" type="email" placeholder="user@example.com" v-model="email" required></v-text-field>
                      <v-text-field id="password" prepend-icon="lock" name="password" label="Password" type="password" v-model="password" required></v-text-field>
                  </v-card-text>
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" type="submit">Sign in</v-btn>
                  </v-card-actions>
                </v-form>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
  </v-app>
</template>
<script>
  export default {
    data(){
      return {
        email: null,
        password: null,
        error: false
      }
    },
    methods: {
      login(){
        var app = this
        this.$auth.login({
            params: {
              email: app.email,
              password: app.password
            }, 
            success: function (resp) {
                app.error = false;
            },
            error: function (resp) {
                app.error = true;
            },
            rememberMe: true,
            redirect: '/dashboard',
            fetchUser: true,
        });       
      },
    }
  } 
</script>