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
                        <v-text-field v-model="form.slug" :counter="255" label="Slug" required
                            :error-messages="errors.slug"></v-text-field>
                    </v-col>
                    <v-col cols="6">
                        <v-file-input accept="image/*" v-model="form.image" label="Thumbnail"></v-file-input>
                    </v-col>
                    <v-col cols="6">
                        <v-select multiple :error-messages="errors.case_categories_ids" item-title="name" item-value="id" label="Category"
                            :items="categories" v-model="form.case_categories_ids"></v-select>
                    </v-col>
                    <v-col cols="6">
                        <v-textarea :counter="255" label="Description" no-resize rows="1" v-model="form.description"></v-textarea>
                    </v-col>
                    <v-col cols="12" sm="12" md="12">
                        <ckeditor :editor="editor" v-model="form.long_description" :config="editorConfig"></ckeditor>
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
const categoryservice = new service('case-categories')
const itemtypeservice = new service('case-studies')
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import UploadAdapter from '../../plugins/ckeditor-adapter';
import Swal from 'sweetalert2';
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
            categories: [],
            otherVideos: [],
            breadcrumbs: [
                {
                    title: 'Dashboard',
                    to: { name: "auth.panel" },
                    disabled: false,
                    exact: true,
                },
                {
                    title: 'Case Study',
                    exact: true,
                    disabled: false,
                    to: { name: "auth.cases.listing" },
                },
            ],
            form: {
                case_categories_ids: [],
                title: '',
                slug: '',
                description: '',
                long_description: '',
                image: undefined,
                is_active: true,
                id: 0,
            },
            loading: false,
            errors: {
                case_categories_ids: [],
                description: '',
                slug: '',
                long_description: '',
                title: [],
            }
        }
    },
    methods: {
        async insertRecord() {
            this.resetErrors()
            this.loading = true
            var formData = new FormData();
            formData.append('title', this.form.title);
            if(this.form.image){
                formData.append('image', this.form.image[0]);
            }
            formData.append('description', this.form.description);
            formData.append('long_description', this.form.long_description);
            formData.append('slug', this.form.slug);
            formData.append('case_categories_ids', JSON.stringify(this.form.case_categories_ids));
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
                if (res.data.slug) {
                    this.errors.slug = res.data.slug
                }
                if (res.data.description) {
                    this.errors.description = res.data.description
                }
                if (res.data.case_categories_ids) {
                    this.errors.case_categories_ids = res.data.case_categories_ids
                }
                if (res.data.long_description) {
                    this.errors.long_description = res.data.long_description
                }
                if (res.data.image) {
                    this.errors.image = res.data.image
                }
                await Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please Fill Form Correctly',
                });
               
            }if (res.status) {
            await Swal.fire({
                icon: 'success',
                title: this.form.id > 0 ? 'Record Updated' : 'Record Created',
                text: this.form.id > 0 ? 'Record updated successfully.' : 'Record created successfully.',
            });
            this.$router.push({ name: "auth.cases.listing" });
        } 
            this.loading = false
        },
        resetErrors() {
            this.errors = {
                case_categories_ids:[],
                image: [],
                slug:[],
                description:[],
                long_description:[],
                title: [],
            }
        },
    },
    watch: {
        'form.title': function(){
            var Text = this.form.title;
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g,'-')
            this.form.slug = Text;  
        }
    },
    async mounted() {
        this.categories = await categoryservice.getlist('').then(e => e.data)
        this.otherVideos = await itemtypeservice.getlist('').then(e => e.data)
        if (this.$route.params.id) {
            this.form.id = this.$route.params.id
            this.breadcrumbs.push({
                title: 'Edit',
                exact: true,
                disabled: true,
                to: { name: "auth.cases.add", params: { id: this.$route.params.id } },
            })
            var res = await itemtypeservice.get(this.$route.params.id)
            this.form = {
                title: (res.title ? res.title : ''),
                slug: (res.slug ? res.slug : ''),
                image: (res.image ? res.image : ''),
                description: (res.description ? res.description : ''),
                long_description: (res.long_description ? res.long_description : ''),
                case_categories_ids: (res.case_categories_ids ? JSON.parse(res.case_categories_ids) : []),
                is_active: (res.is_active == 0 ? false : true),
                id: this.$route.params.id,
            }
        } else {
            this.breadcrumbs.push({
                title: 'Add',
                exact: true,
                disabled: true,
                to: { name: "auth.cases.add" },
            })
        }
    },
}
</script>