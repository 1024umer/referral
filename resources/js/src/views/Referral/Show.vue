<template>
    <v-row>
      <v-col>
        <v-breadcrumbs :items="breadcrumbs">
          <template v-slot:prepend>
            <v-icon size="small" icon="mdi-home-city"></v-icon>
          </template>
          <template v-slot:divider>
            <v-icon>mdi-forward</v-icon>
          </template>
        </v-breadcrumbs>
      </v-col>
      <v-col cols="1">
        <v-btn color="success" link :to="{ name: 'auth.users.add' }">Add User</v-btn>
      </v-col>
      <v-col cols="12">
        <v-row>
          <v-col>
            <v-text-field v-model="search" label="Search" single-line hide-details></v-text-field>
          </v-col>
        </v-row>
        <v-table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>State</th>
              <th>Date of Birth</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in serverItems" :key="index">
              <td>{{ item.id || '' }}</td>
              <td>{{ item.full_name || '' }}</td>
              <td>{{ item.email || '' }}</td>
              <td>{{ item.state || '' }}</td>
              <td>{{ item.dob || '' }}</td>
            </tr>
          </tbody>
        </v-table>
      </v-col>
    </v-row>
  </template>
  
  <script>
  import service from "@services/auth/default";
  const itemtypeservice = new service('referrals-show');
  import Swal from "sweetalert2";
  
  export default {
    data() {
      return {
        breadcrumbs: [
          {
            title: 'Dashboard',
            to: { name: "auth.users.listing" },
            disabled: false,
            exact: true,
          },
          {
            title: 'Referral',
            exact: true,
            disabled: true,
            to: { name: "auth.referrals.listing" },
          },
        ],
        serverItems: [],
        search: '',
      };
    },
    methods: {
      async loadItems() {
        try {
          const response = await itemtypeservice.getLists(this.$route.params.id);
          if (response.data && Array.isArray(response.data)) {
            this.serverItems = response.data; // Assign the array of user objects
          } else {
            console.error('Data property is not an array in the response:', response);
            this.serverItems = [];
          }
        } catch (error) {
          console.error('Error loading data:', error);
          this.serverItems = [];
        }
      },
    },
    watch: {
      $route() {
        this.loadItems();
      },
    },
    async mounted() {
      this.loadItems();
    },
  };
  </script>