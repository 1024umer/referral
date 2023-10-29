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
        <div v-if="res && res.image">
            <v-img height="50%" width="50%" :src="res.image_url"></v-img>
        </div>
        <div class="pl-5 my-5" v-if="res && res.referral_url">
            <p>Referral Url</p>
            <v-btn>
                {{res.referral_url}}
            </v-btn><v-btn class="ml-5" color="primary" @click="copyTo(res.referral_url)"> Copy</v-btn>
        </div>
        <v-col cols="12">
            <form @submit.prevent="submit">
                <v-row>
                    <v-col cols="6">
                        <v-text-field
                            v-model="form.first_name"
                            :counter="255"
                            label="First Name"
                            required
                            :error-messages="errors.first_name"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="6">
                        <v-text-field
                            v-model="form.last_name"
                            :counter="255"
                            label="Last Name"
                            required
                            :error-messages="errors.last_name"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="6">
                        <v-text-field
                            v-model="form.dob"
                            :counter="255"
                            label="Date of Birth"
                            required
                            :error-messages="errors.dob"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="6">
                        <v-select
                        v-model="form.state"
                        :items="state"
                        label="State"
                        item-text="text" 
                        item-value="text"  
                        item-title="text"
                        ></v-select>
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
                    <v-col v-if="form && form.balance >= 0" cols="6">
                        <v-text-field
                            v-model="form.balance"
                            :counter="255"
                            label="Balance"
                            required
                            :error-messages="errors.balance"
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
                            v-model="form.profile_image"
                            :counter="255"
                            label="Profile Image"
                            required
                            :error-messages="errors.profile_image"
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
import { mapState } from 'vuex'; // Import mapState

export default {
    data() {
        return {
            isCopied: false,
            state: [
                { id: 1, text: 'Alabama' },
                { id: 2, text: 'Alaska' },
                { id: 3, text: 'Arizona' },
                { id: 4, text: 'Arkansas' },
                { id: 5, text: 'California' },
                { id: 6, text: 'Colorado' },
                { id: 7, text: 'Connecticut' },
                { id: 8, text: 'Delaware' },
                { id: 9, text: 'Florida' },
                { id: 10, text: 'Georgia' },
                { id: 11, text: 'Hawaii' },
                { id: 12, text: 'Idaho' },
                { id: 13, text: 'Illinois' },
                { id: 14, text: 'Indiana' },
                { id: 15, text: 'Iowa' },
                { id: 16, text: 'Kansas' },
                { id: 17, text: 'Kentucky' },
                { id: 18, text: 'Louisiana' },
                { id: 19, text: 'Maine' },
                { id: 20, text: 'Maryland' },
                { id: 21, text: 'Massachusetts' },
                { id: 22, text: 'Michigan' },
                { id: 23, text: 'Minnesota' },
                { id: 24, text: 'Mississippi' },
                { id: 25, text: 'Missouri' },
                { id: 26, text: 'Montana' },
                { id: 27, text: 'Nebraska' },
                { id: 28, text: 'Nevada' },
                { id: 29, text: 'New Hampshire' },
                { id: 30, text: 'New Jersey' },
                { id: 31, text: 'New Mexico' },
                { id: 32, text: 'New York' },
                { id: 33, text: 'North Carolina' },
                { id: 34, text: 'North Dakota' },
                { id: 35, text: 'Ohio' },
                { id: 36, text: 'Oklahoma' },
                { id: 37, text: 'Oregon' },
                { id: 38, text: 'Pennsylvania' },
                { id: 39, text: 'Rhode Island' },
                { id: 40, text: 'South Carolina' },
                { id: 41, text: 'South Dakota' },
                { id: 42, text: 'Tennessee' },
                { id: 43, text: 'Texas' },
                { id: 44, text: 'Utah' },
                { id: 45, text: 'Vermont' },
                { id: 46, text: 'Virginia' },
                { id: 47, text: 'Washington' },
                { id: 48, text: 'West Virginia' },
                { id: 49, text: 'Wisconsin' },
                { id: 50, text: 'Wyoming' },
            ],
            computed: {
                ...mapState(['state']), // Map the 'state' array
            },
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
                first_name: '',
                last_name: '',
                dob: '',
                state: '',
                balance: '',
                email: '',
                password: '',
                profile_image: [],
                id: 0,
            },
            loading: false,
            errors: {
                role_id: [],
                balance: [],
                first_name: [],
                last_name: [],
                dob: [],
                state: [],
                email: [],
                password: [],
                profile_image: [],
            }
        }
    },
    methods: {
        copyTo(text) {
    // Create a textarea element to hold the text
    const textarea = document.createElement("textarea");
    textarea.value = text;
    document.body.appendChild(textarea);

    // Select the text and copy it to the clipboard
    textarea.select();
    document.execCommand("copy");

    // Remove the textarea element
    document.body.removeChild(textarea);

    // Provide feedback to the user (you can use a message or alert)
    alert("Copied to clipboard");

    this.isCopied = true; // Set the flag to indicate that it has been copied
  },
        async insertRecord(){
            this.resetErrors()
            this.loading = true
            var formData = new FormData();
            formData.append('first_name', this.form.first_name);
            formData.append('last_name', this.form.last_name);
            formData.append('dob', this.form.dob);
            formData.append('state', this.form.state);
            formData.append('balance', this.form.balance);
            formData.append('email', this.form.email);
            formData.append('role_id', this.form.role_id);
            if (this.form.id > 0) {
                formData.append('id', this.form.id);
                if (this.form.password && this.form.password.length > 0) {
                    formData.append('password', this.form.password);
                }
                if (this.form.profile_image && this.form.profile_image.length > 0) {
                    formData.append('profile_image', this.form.profile_image[0]);
                }
                var res = await itemtypeservice.update(formData, this.form.id)
            } else {
                formData.append('password', this.form.password);
                formData.append('profile_image', this.form.profile_image);
                var res = await itemtypeservice.create(formData)
            }
            if (!res.status) {
                if (res.data.first_name) {
                    this.errors.first_name = res.data.first_name
                }
                if (res.data.last_name) {
                    this.errors.last_name = res.data.last_name
                }
                if (res.data.state) {
                    this.errors.state = res.data.state
                }
                if (res.data.dob) {
                    this.errors.dob = res.data.dob
                }
                if (res.data.email) {
                    this.errors.email = res.data.email
                }
                if (res.data.role_id) {
                    this.errors.role_id = res.data.role_id
                }
                if (res.data.profile_image) {
                    this.errors.profile_image = res.data.profile_image
                }
                if (res.data.password) {
                    this.errors.password = res.data.password
                }
                if (res.data.balance) {
                    this.errors.balance = res.data.balance
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
                first_name: [],
                last_name: [],
                state: [],
                dob: [],
                email: [],
                password: [],
                profile_image: [],
                balance: [],
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
            this.res =res;
            this.form = {
                first_name: (res.first_name ? res.first_name : ''),
                last_name: (res.last_name ? res.last_name : ''),
                dob: (res.dob ? res.dob : ''),
                state: (res.state ? res.state : ''),
                email: (res.email ? res.email : ''),
                role_id: (res.role_id ? res.role_id : ''),
                balance: (res.balance ? res.balance : ''),
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