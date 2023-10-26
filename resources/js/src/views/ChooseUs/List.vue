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
            <!-- <v-btn  color="success" link :to="{ name: 'auth.chooseus.add' }">Add Category</v-btn> -->
        </v-col>
        <v-col cols="12">
            <v-row>
                <v-col>
                    <v-text-field v-model="search" label="Search" single-line hide-details></v-text-field>
                </v-col>
            </v-row>
            <v-data-table-server v-model:items-per-page="itemsPerPage" :headers="headers" :items-length="totalItems"
                :items="serverItems" :loading="loading" item-value="id" loading-text="Loading"
                @update:options="loadItems">
                <template v-slot:item.role_id="{ item }">
                    {{ item.selectable.role.title }}
                </template>
                <template v-slot:item.actions="{ item }">
                    <v-btn link :to="{ name: 'auth.chooseus.edit', params: { id: item.selectable.id } }" color="info" density="comfortable" size="small"
                        icon="mdi-pencil-plus"></v-btn>
                </template>
            </v-data-table-server>
        </v-col>
    </v-row>
</template>
<script>
import service from "@services/auth/default";
const itemtypeservice = new service('chooseus')

import Swal from "sweetalert2";
export default {
    data() {
        return {
            roles: [],
            role_id: 0,
            breadcrumbs: [
                {
                    title: 'Dashboard',
                    to: { name: "auth.panel" },
                    disabled: false,
                    exact: true,
                },
                {
                    title: 'Why Choose Us',
                    exact: true,
                    disabled: true,
                    to: { name: "auth.chooseus.listing" },
                },
            ],
            serverItems: [],
            totalItems: 0,
            loading: false,
            itemsPerPage: 10,
            search: '',
            headers: [
                {
                    title: "ID",
                    align: "start",
                    sortable: true,
                    key: "id",
                },
                {
                    title: "Title",
                    align: "start",
                    sortable: true,
                    key: "title",
                },
                {
                    title: "Description",
                    align: "start",
                    sortable: true,
                    key: "description",
                },
                {
                    title: "Actions",
                    sortable: false,
                    key: "actions",
                },
            ]
        }
    },
    methods: {
        async loadItems({ page, itemsPerPage, sortBy }) {
            this.loading = true;
            this.serverItems = []
            var query = "";
            query += "?page=" + page;
            try {
                if (sortBy.length > 0) {
                    query += "&sortCol=" + sortBy[0].key;
                    query += "&sortByDesc=" + sortBy[0].order;
                }
            } catch (ex) { }
            query += "&perpage=" + itemsPerPage;
            if (this.search != "") {
                query += "&search=" + this.search;
            }
            if(this.role_id>0){
                query += "&role_id=" + this.role_id;
            }
            const data = await itemtypeservice.getlist(query);
            this.serverItems = data.data;
            try {
                this.totalItems = data.meta.total;
            } catch (ex) {
                this.totalItems = 0
            }
            this.loading = false;
        },
    },
    watch: {
        $route() {
            this.loadItems({ page: 1, itemsPerPage: 10 });
        },
        itemsPerPage() {
            this.loadItems({ page: 1, itemsPerPage: 10 });
        },
        search() {
            this.loadItems({ page: 1, itemsPerPage: 10 });
        },
        role_id(){
            this.loadItems({ page: 1, itemsPerPage: 10 });
        }
    },
    async mounted() {
        this.loadItems({ page: 1, itemsPerPage: 10 });
    },
}
</script>