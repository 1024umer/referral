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
                        <v-text-field v-model="form.title" :counter="255" label="Title" required
                            :error-messages="errors.title"></v-text-field>
                    </v-col>
                    <v-col cols="6">
                        <v-file-input accept="image/*" v-model="form.image" label="Thumbnail"></v-file-input>
                    </v-col>
                    <v-col cols="12" sm="12" md="12">
                        <ckeditor :editor="editor" v-model="form.description" :config="editorConfig"></ckeditor>
                    </v-col>
                    <v-col cols="6">
                        <v-text-field v-model="form.location" :counter="255" label="Loaction" required
                            :error-messages="errors.location"></v-text-field>
                    </v-col>
                    <v-col cols="3">
                        <v-text-field type="date" v-model="form.date" :counter="255" label="Date" required
                            :error-messages="errors.date"></v-text-field>
                    </v-col>
                    <v-col cols="3">
                        <v-text-field type="time" v-model="form.time" :counter="255" label="Time" required
                            :error-messages="errors.time"></v-text-field>
                    </v-col>
                    <v-col cols="3">
                        <v-checkbox v-model="form.is_active" label="Is Active?"></v-checkbox>
                    </v-col>
                    <v-col cols="12">
                        <v-btn @click="insertRecord" :disabled="loading" :loading="loading"
                            :loading-text="(form.id > 0 ? 'Updating' : 'Inserting')" color="success">{{
                                form.id > 0 ? 'Update' : 'Insert' }} Record</v-btn>
                    </v-col>
                </v-row>
            </form>
        </v-col>
    </v-row>
</template>
<script>
import service from "@services/auth/default";
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import UploadAdapter from '../../plugins/ckeditor-adapter';
const itemtypeservice = new service('events')
export default {
    data() {
        return {
            editor: ClassicEditor,
            editorConfig: {
                extraPlugins: [
                    function (editor){
                        editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
                            return new UploadAdapter( loader );
                        };
                    }
                ],
            },
            breadcrumbs: [
                {
                    title: 'Dashboard',
                    to: { name: "auth.panel" },
                    disabled: false,
                    exact: true,
                },
                {
                    title: 'Event',
                    exact: true,
                    disabled: false,
                    to: { name: "auth.events.listing" },
                },
            ],
            form: {
                title: '',
                time: '',
                date: '',
                description: '',
                location: '',
                image: undefined,
                is_active: true,
                id: 0,
            },
            loading: false,
            errors: {
                title: [],
                time: [],
                date: [],
                location: [],
                description:[],
                image:[],
            }
        }
    },
    methods: {
        async insertRecord() {
            this.resetErrors()
            this.loading = true
            var formData = new FormData();
            formData.append('title', this.form.title);
            formData.append('location', this.form.location);
            formData.append('date', this.form.date);
            formData.append('time', this.form.time);

            if(this.form.image){
                formData.append('image', this.form.image[0]);
            }
            formData.append('description', this.form.description);
            formData.append('is_active', (this.form.is_active==true?1:0));

            if (this.form.id > 0) {
                formData.append('id', this.form.id);
                var res = await itemtypeservice.update(formData, this.form.id)
            } else {
                var res = await itemtypeservice.create(formData)
            }
            if (!res.status) {
                if (res.data.title) {
                    this.errors.title = res.data.title
                }
                if (res.data.description) {
                    this.errors.description = res.data.description
                }
                if (res.data.date) {
                    this.errors.date = res.data.date
                }
                if (res.data.time) {
                    this.errors.time = res.data.time
                }
                if (res.data.location) {
                    this.errors.location = res.data.location
                }
                if (res.data.image) {
                    this.errors.image = res.data.image
                }
            } else {
                this.$router.push({ name: "auth.events.listing" });
            }
            this.loading = false
        },
        resetErrors() {
            this.errors = {
                description:[],
                long_description:[],
                iamge: [],
                title: [],
                slug:[],
            }
        },
    },
    watch: {
    },
    async mounted() {
        if (this.$route.params.id) {
            this.form.id = this.$route.params.id
            this.breadcrumbs.push({
                title: 'Edit',
                exact: true,
                disabled: true,
                to: { name: "auth.events.add", params: { id: this.$route.params.id } },
            })
            var res = await itemtypeservice.get(this.$route.params.id)
            this.form = {
                title: (res.title ? res.title : ''),
                description: (res.description ? res.description : ''),
                date: (res.date ? res.date : ''),
                time: (res.time ? res.time : ''),
                location: (res.location ? res.location : ''),
                is_active: (res.is_active == 0 ? false : true),
                image: (res.image ? res.image : ''),
                id: this.$route.params.id,
            }
        } else {
            this.breadcrumbs.push({
                title: 'Add',
                exact: true,
                disabled: true,
                to: { name: "auth.events.add" },
            })
        }
    },
}
</script>