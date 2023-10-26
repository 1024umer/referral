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
                        <v-file-input accept="image/*" v-model="form.image" label="Image"></v-file-input>
                    </v-col>
                    <v-col cols="6">
                        <v-textarea label="Description" no-resize rows="1" v-model="form.description"></v-textarea>
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
const itemtypeservice = new service('additional-services')
export default {
    data() {
        return {
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
                    title: 'Additional Services',
                    exact: true,
                    disabled: false,
                    to: { name: "auth.additional.listing" },
                },
            ],
            form: {
                title: '',
                description: '',
                image: undefined,
                is_active: true,
                id: 0,
            },
            loading: false,
            errors: {
                title: [],
                image:[],
                description:[],
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
            formData.append('category_id', JSON.stringify(this.form.category_id));
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
                if (res.data.image) {
                    this.errors.image = res.data.image
                }
            } else {
                this.$router.push({ name: "auth.additional.listing" });
            }
            this.loading = false
        },
        resetErrors() {
            this.errors = {
                iamge: [],
                title: [],
                description:[],
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
                to: { name: "auth.additional.add", params: { id: this.$route.params.id } },
            })
            var res = await itemtypeservice.get(this.$route.params.id)
            this.form = {
                title: (res.title ? res.title : ''),
                description: (res.description ? res.description : ''),
                is_active: (res.is_active == 0 ? false : true),
                id: this.$route.params.id,
            }
            if (res.image) {
            this.form.image = res.image;
        }
        } else {
            this.breadcrumbs.push({
                title: 'Add',
                exact: true,
                disabled: true,
                to: { name: "auth.additional.add" },
            })
        }
    },
}
</script>