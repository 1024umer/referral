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
                        <v-file-input accept="image/*" v-model="form.image" label="Thumbnail"
                            :error-messages="errors.image"></v-file-input>
                        <div v-if="res && res.image">
                            <img width="100" :src="res.image_url" />
                        </div>
                    </v-col>
                    <v-col cols="6">
                        <v-file-input accept="image/*" v-model="form.detail_image" label="Detail Image"
                            :error-messages="errors.detail_image"></v-file-input>
                        <div v-if="res && res.detail_image">
                            <img width="100" :src="res.detail_image.full_url" />
                        </div>
                    </v-col>
                    <v-col cols="6">
                        <v-select multiple :error-messages="errors.category_id" item-title="name" item-value="id"
                            label="Category" :items="categories" v-model="form.category_id"></v-select>
                    </v-col>
                    <v-col cols="6">
                        <v-textarea :counter="255" label="Description" no-resize rows="1"
                            v-model="form.description"></v-textarea>
                    </v-col>
                    <v-col cols="12" sm="12" md="12">
                        <ckeditor :editor="editor" v-model="form.long_description" :config="editorConfig"></ckeditor>
                    </v-col>
                    <v-col cols="3">
                        <v-checkbox v-model="form.is_active" label="Is Active?"></v-checkbox>
                    </v-col>
                    <v-col cols="3">
                        <v-checkbox v-model="form.is_featured" label="Is Featured?"></v-checkbox>
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
const categoryservice = new service('categories')
const itemtypeservice = new service('blogs')
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import UploadAdapter from '../../plugins/ckeditor-adapter';
export default {
    data() {
        return {
            editor: ClassicEditor,
            editorConfig: {
                extraPlugins: [
                    function (editor) {
                        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                            return new UploadAdapter(loader);
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
                    title: 'Blogs',
                    exact: true,
                    disabled: false,
                    to: { name: "auth.blogs.listing" },
                },
            ],
            form: {
                category_id: [],
                title: '',
                slug: '',
                description: '',
                long_description: '',
                image: undefined,
                detail_image: undefined,
                is_active: true,
                is_featured: true,
                id: 0,
            },
            loading: false,
            errors: {
                category_id: [],
                description: '',
                slug: '',
                long_description: '',
                title: [],
                image: [],
                detail_image: [],
            }
        }
    },
    methods: {
        async insertRecord() {
            this.resetErrors()
            this.loading = true
            var formData = new FormData();
            formData.append('title', this.form.title);
            if (this.form.image) {
                formData.append('image', this.form.image[0]);
            }
            if (this.form.detail_image) {
                formData.append('detail_image', this.form.detail_image[0]);
            }
            formData.append('description', this.form.description);
            formData.append('long_description', this.form.long_description);
            formData.append('slug', this.form.slug);
            formData.append('category_id', JSON.stringify(this.form.category_id));
            formData.append('is_active', (this.form.is_active == true ? 1 : 0));
            formData.append('is_featured', (this.form.is_featured == true ? 1 : 0));

            if (this.form.id > 0) {
                formData.append('id', this.form.id);
                var res = await itemtypeservice.update(formData, this.form.id)
            } else {
                var res = await itemtypeservice.create(formData)
            }
            if (!res.status) {
                if (res.data.category_id) {
                    this.errors.category_id = res.data.category_id
                }
                if (res.data.title) {
                    this.errors.title = res.data.title
                }
                if (res.data.slug) {
                    this.errors.slug = res.data.slug
                }
                if (res.data.description) {
                    this.errors.description = res.data.description
                }
                if (res.data.long_description) {
                    this.errors.long_description = res.data.long_description
                }
                if (res.data.image) {
                    this.errors.image = res.data.image
                }
                if (res.data.detail_image) {
                    this.errors.detail_image = res.data.detail_image
                }
            } else {
                this.$router.push({ name: "auth.blogs.listing" });
            }
            this.loading = false
        },
        resetErrors() {
            this.errors = {
                category_id: [],
                image: [],
                detail_image: [],
                slug: [],
                description: [],
                long_description: [],
                title: [],
            }
        },
    },
    watch: {
        'form.title': function () {
            var Text = this.form.title;
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g, '-')
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
                to: { name: "auth.blogs.add", params: { id: this.$route.params.id } },
            })
            var res = await itemtypeservice.get(this.$route.params.id)
            this.res = res;
            this.form = {
                title: (res.title ? res.title : ''),
                slug: (res.slug ? res.slug : ''),
                description: (res.description ? res.description : ''),
                long_description: (res.long_description ? res.long_description : ''),
                category_id: (res.category_id ? JSON.parse(res.category_id) : []),
                is_active: (res.is_active == 0 ? false : true),
                is_featured: (res.is_featured == 0 ? false : true),
                id: this.$route.params.id,
                parent_id: 0,
            }
        } else {
            this.breadcrumbs.push({
                title: 'Add',
                exact: true,
                disabled: true,
                to: { name: "auth.blogs.add" },
            })
        }
    },
}
</script>