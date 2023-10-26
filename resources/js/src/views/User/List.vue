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
            <v-btn  color="success" link :to="{ name: 'auth.users.add' }">Add User</v-btn>
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
                    <v-btn link :to="{ name: 'auth.users.edit', params: { id: item.selectable.id } }" color="info" density="comfortable" size="small"
                        icon="mdi-pencil-plus"></v-btn>
                    <v-btn @click="deleteItem(item.selectable.id)" color="error" density="comfortable" size="small" icon="mdi-delete-outline"></v-btn>
                </template>
            </v-data-table-server>
        </v-col>
    </v-row>
</template>
<script>
import service from "@services/auth/default";
const itemtypeservice = new service('users')
const categoryservice = new service('roles')
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
                    title: 'Users',
                    exact: true,
                    disabled: true,
                    to: { name: "auth.users.listing" },
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
                    title: "Email",
                    align: "start",
                    sortable: true,
                    key: "email",
                },
                {
                    title: "Name",
                    align: "start",
                    sortable: true,
                    key: "name",
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
        async deleteItem(id) {
            const isConfirmed = await Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    return true;
                }
            });
            if (isConfirmed) {
                await itemtypeservice.delete({
                    id: id,
                });
                Swal.fire("Deleted!", "Your record has been deleted.", "success");
                this.loadItems({ page: 1, itemsPerPage: 10 });
            }
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
        const roles = await categoryservice.getlist('').then(e=>e.data)
        this.roles = [{id: 0, title: 'All'}, ...roles]
        this.loadItems({ page: 1, itemsPerPage: 10 });
    },
}
</script>