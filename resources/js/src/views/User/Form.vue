<template>
    <v-row>
        <v-col cols="12">
            <v-breadcrumbs :items="breadcrumbs">
                <template v-slot:prepend>
                    <v-icon size="small" icon="mdi-home-city"></v-icon>
                </template>
                <template v-slot:divider>
                    <v-icon>mdi-forward</v-icon>
                </template>
            </v-breadcrumbs>
        </v-col>
        <v-col cols="12">
            <form @submit.prevent="submit">
                <v-row>
                    <v-col cols="6">
                        <v-text-field
                            v-model="form.name"
                            :counter="255"
                            label="Name"
                            required
                            :error-messages="errors.name"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="6">
                        <v-text-field
                            v-model="form.email"
                            :counter="255"
                            label="Email"
                            required
                            :error-messages="errors.email"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            v-model="form.password"
                            label="Password"
                            type="password"
                            :error-messages="errors.password"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="6">
                        <v-file-input
                            v-model="form.image"
                            :counter="255"
                            label="Profile Image"
                            required
                            :error-messages="errors.image"
                            @change="onFileChange"
                        ></v-file-input>
                    </v-col>
                    <v-col cols="6">
                        <v-select :error-messages="errors.role_id" item-title="title" item-value="id" label="Role" :items="roles" v-model="form.role_id"></v-select>
                    </v-col>
                    <v-col cols="12">
                        <v-btn @click="insertRecord" :disabled="loading" :loading="loading" :loading-text="(form.id>0?'Updating':'Inserting')" color="success">{{ form.id>0?'Update':'Insert' }} Record</v-btn>
                    </v-col>
                </v-row>
            </form>
        </v-col>
    </v-row>
</template>
<script>
import service from "@services/auth/default";
const itemtypeservice = new service('users')
const rolesservice = new service('roles')
export default {
    data() {
        return {
            roles: [],
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
                    disabled: false,
                    to: { name: "auth.users.listing" },
                },
            ],
            form: {
                role_id: '',
                name: '',
                email: '',
                password: '',
                image: [],
                id: 0,
            },
            loading: false,
            errors: {
                role_id: [],
                name: [],
                email: [],
                password: [],
                image: [],
            }
        }
    },
    methods: {
        async insertRecord(){
            this.resetErrors()
            this.loading = true
            var formData = new FormData();
            formData.append('name', this.form.name);
            formData.append('email', this.form.email);
            formData.append('role_id', this.form.role_id);
            if (this.form.id > 0) {
                formData.append('id', this.form.id);
                if(this.form.password!=''){
                    formData.append('password', this.form.password);
                }
                var res = await itemtypeservice.update(formData, this.form.id)
            } else {
                formData.append('password', this.form.password);
                var res = await itemtypeservice.create(formData)
            }
            if (!res.status) {
                if (res.data.name) {
                    this.errors.name = res.data.name
                }
                if (res.data.email) {
                    this.errors.email = res.data.email
                }
                if (res.data.role_id) {
                    this.errors.role_id = res.data.role_id
                }
                if (res.data.image) {
                    this.errors.image = res.data.image
                }
                if (res.data.password) {
                    this.errors.password = res.data.password
                }
            } else {
                this.$router.push({ name: "auth.users.listing" });
            }
            this.loading = false
        },onFileChange(event) {
      this.form.thumbnail = event.target.files[0];
    },
        resetErrors(){
            this.errors = {
                role_id: [],
                name: [],
                email: [],
                password: [],
                image: [],
            }
        }
    },
    watch: {
        
    },
    async mounted() {
        this.roles = await rolesservice.getlist('').then(e=>e.data)
        if (this.$route.params.id) {
            this.form.id = this.$route.params.id
            this.breadcrumbs.push({
                title: 'Edit',
                exact: true,
                disabled: true,
                to: { name: "auth.users.add", params: { id: this.$route.params.id } },
            })
            var res = await itemtypeservice.get(this.$route.params.id)
            this.form = {
                name: (res.name ? res.name : ''),
                email: (res.email ? res.email : ''),
                role_id: (res.role_id ? res.role_id : ''),
                id: this.$route.params.id,
            }
        }else{
            this.breadcrumbs.push({
                title: 'Add',
                exact: true,
                disabled: true,
                to: { name: "auth.users.add" },
            })
        }
    },
}
</script>