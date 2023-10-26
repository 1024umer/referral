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
                            v-model="form.slug"
                            :counter="255"
                            label="Slug"
                            required
                            :error-messages="errors.slug"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="6">
                        <v-checkbox v-model="form.is_active" label="Is Active?"></v-checkbox>
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
const itemtypeservice = new service('case-categories')
export default {
    data() {
        return {
            breadcrumbs: [
                {
                    title: 'Dashboard',
                    to: { name: "auth.panel" },
                    disabled: false,
                    exact: true,
                },
                {
                    title: 'Case Categories',
                    exact: true,
                    disabled: false,
                    to: { name: "auth.casecategories.listing" },
                },
            ],
            form: {
                name: '',
                slug: '',
                id: 0,
                parent_id: 0,
                is_active: true
            },
            loading: false,
            errors: {
                name: [],
                slug: [],
            }
        }
    },
    methods: {
        async insertRecord(){
            this.resetErrors()
            this.loading = true
            var formData = new FormData();
            formData.append('is_active', (this.form.is_active==true?1:0));
            formData.append('name', this.form.name);
            formData.append('slug', this.form.slug);
            formData.append('parent_id', this.form.parent_id);
            if (this.form.id > 0) {
                formData.append('id', this.form.id);
                var res = await itemtypeservice.update(formData, this.form.id)
            } else {
                var res = await itemtypeservice.create(formData)
            }
            if (!res.status) {
                if (res.data.name) {
                    this.errors.name = res.data.name
                }
                if (res.data.slug) {
                    this.errors.slug = res.data.slug
                }
            } else {
                this.$router.push({ name: "auth.casecategories.listing" });
            }
            this.loading = false
        },
        resetErrors(){
            this.errors = {
                name: [],
                slug: [],
            }
        }
    },
    watch: {
        'form.name': function(){
            var Text = this.form.name;
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g,'-')
            this.form.slug = Text;  
        }
    },
    async mounted() {
        if (this.$route.params.id) {
            this.form.id = this.$route.params.id
            this.breadcrumbs.push({
                title: 'Edit',
                exact: true,
                disabled: true,
                to: { name: "auth.casecategories.add", params: { id: this.$route.params.id } },
            })
            var res = await itemtypeservice.get(this.$route.params.id)
            this.form = {
                name: (res.name ? res.name : ''),
                slug: (res.slug ? res.slug : ''),
                id: this.$route.params.id,
                parent_id: 0,
                is_active: (res.is_active==0?false:true)
            }
        }else{
            this.breadcrumbs.push({
                title: 'Add',
                exact: true,
                disabled: true,
                to: { name: "auth.casecategories.add" },
            })
        }
    },
}
</script>