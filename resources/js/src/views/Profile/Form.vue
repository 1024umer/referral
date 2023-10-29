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
                        <div v-if="res && res.image">
                            <v-img height="25%" width="25%" alt="Avatar" :src="res.image_url"></v-img>
                        </div>
                    </v-col>

                    <v-col cols="6">
                        <v-file-input
                            v-model="form.signature"
                            label="Signature"
                            required
                            :error-messages="errors.signature"
                        ></v-file-input>
                        <div v-if="res && res.signature">
                            <v-img height="50%" width="50%" alt="Avatar" :src="res.signature.full_url"></v-img>
                        </div>
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
const itemtypeservice = new service('profiles')
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
                name: '',
                email: '',
                password: '',
                image: [],
                signature:[],
                id: 0,
            },
            loading: false,
            errors: {
                name: [],
                email: [],
                password: [],
                image: [],
                signature:[],
            }
        }
    },
    methods: {
        async insertRecord() {
            this.resetErrors();
            this.loading = true;
            var formData = new FormData();
            formData.append('name', this.form.name);
            formData.append('email', this.form.email);

            if (this.form.id > 0) {
                formData.append('id', this.form.id);
            }
            const passwordValue = this.form.password !== undefined ? this.form.password : '';
            if (passwordValue !== '') {
                formData.append('password', passwordValue);
            }
            if (this.form.image && this.form.image.length > 0) {
                formData.append('image', this.form.image[0]);
            }
            if (this.form.signature && this.form.signature.length > 0) {
                formData.append('signature', this.form.signature[0]);
            }

            try {
                var res = await itemtypeservice.update(formData, this.form.id);
                if (!res.status) {
                    if (res.data.name) {
                        this.errors.name = res.data.name;
                    }
                    if (res.data.email) {
                        this.errors.email = res.data.email;
                    }
                    if (res.data.image) {
                        this.errors.image = res.data.image;
                    }
                    if (res.data.signature) {
                        this.errors.signature = res.data.signature;
                    }
                    if (res.data.password) {
                        this.errors.password = res.data.password;
                    }
                } else {
                    this.$router.push({ name: "auth.users.listing" });
                }
            } catch (error) {
                console.error(error);
            }

            this.loading = false;
        },
        onFileChange(event) {
            this.form.thumbnail = event.target.files[0];
        },
        resetErrors() {
            this.errors = {
                name: [],
                email: [],
                password: [],
                image: [],
                signature:[],
            };
        }
    },
    watch: {
        
    },
    async mounted() {
    try {
        const res = await itemtypeservice.get();
        this.res = res;
        this.form = {
            name: (res.name ? res.name : ''),
            email: (res.email ? res.email : ''),
            role_id: (res.role_id ? res.role_id : ''),
            id: (res.id ? res.id : 0),
        };

        if (this.form.id > 0) {
            this.breadcrumbs.push({
                title: 'Edit',
                exact: true,
                disabled: true,
                to: { name: "auth.users.add", params: { id: this.form.id } },
            });
        } 
    } catch (error) {
        console.error(error);
    }
},

}
</script>