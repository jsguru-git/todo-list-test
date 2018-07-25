<!-- <template>
    <div>
        <div class="alert alert-danger" v-if="error && !success">
            <p>There was an error, unable to complete registration.</p>
        </div>
        <div class="alert alert-success" v-if="success">
            <p>Registration completed. You can now <router-link :to="{name:'login'}">sign in.</router-link></p>
        </div>
        <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">
            <div class="form-group" v-bind:class="{ 'has-error': error && errors.name }">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-control" v-model="name" required>
                <span class="help-block" v-if="error && errors.name">{{ errors.name }}</span>
            </div>
            <div class="form-group" v-bind:class="{ 'has-error': error && errors.email }">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
                <span class="help-block" v-if="error && errors.email">{{ errors.email }}</span>
            </div>
            <div class="form-group" v-bind:class="{ 'has-error': error && errors.password }">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" v-model="password" required>
                <span class="help-block" v-if="error && errors.password">{{ errors.password }}</span>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
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
                <v-form autocomplete="off" @submit.prevent="register" method="post">
                  <v-toolbar dark color="primary">
                    <v-toolbar-title>Register form</v-toolbar-title>
                  </v-toolbar>
                  <v-alert :value="error && !success" color="error" icon="warning" transition="scale-transition">There was an error, unable to complete registration.</v-alert>
                  <v-alert :value="success" color="success" icon="new_releases" transition="scale-transition">Registration completed. You can now <router-link :to="{name:'login'}">sign in.</router-link></v-alert>
                  <v-card-text>
                      <v-text-field prepend-icon="person" name="name" label="name" type="text" v-model="name" required></v-text-field>
                      <span class="help-block" v-if="error && errors.name">{{ errors.name }}</span>
                      <v-text-field prepend-icon="person" name="email" label="email" type="email" placeholder="user@example.com" v-model="email" required></v-text-field>
                      <span class="help-block" v-if="error && errors.email">{{ errors.email }}</span>
                      <v-text-field id="password" prepend-icon="lock" name="password" label="Password" type="password" v-model="password" required></v-text-field>
                      <span class="help-block" v-if="error && errors.password">{{ errors.password }}</span>
                  </v-card-text>
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" type="submit">Submit</v-btn>
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
                name: '',
                email: '',
                password: '',
                error: false,
                errors: {},
                success: false
            };
        },
        methods: {
            register(){
                var app = this
                this.$auth.register({
                    data: {
                        name: app.name,
                        email: app.email,
                        password: app.password
                    }, 
                    success: function () {
                        app.success = true
                    },
                    error: function (resp) {
                        app.error = true;
                        app.errors = resp.response.data.errors;
                    },
                    redirect: null
                });                
            }
        }
    }
</script>