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
                            v-model="form.title"
                            :counter="255"
                            label="Ttile"
                            required
                            :error-messages="errors.title"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="6">
                        <v-text-field
                            v-model="form.description"
                            :counter="255"
                            label="Description"
                            required
                            :error-messages="errors.description"
                        ></v-text-field>
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
const itemtypeservice = new service('chooseus')
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
                    title: 'Why Choose Us',
                    exact: true,
                    disabled: false,
                    to: { name: "auth.chooseus.listing" },
                },
            ],
            form: {
                title: '',
                description: '',
                id: 0,
            },
            loading: false,
            errors: {
                title: [],
                description: [],
            }
        }
    },
    methods: {
        async insertRecord(){
            this.resetErrors()
            this.loading = true
            var formData = new FormData();
            formData.append('title', this.form.title);
            formData.append('description', this.form.description);
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
            } else {
                this.$router.push({ name: "auth.chooseus.listing" });
            }
            this.loading = false
        },
        resetErrors(){
            this.errors = {
                title: [],
                description: [],
            }
        }
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
                to: { name: "auth.chooseus.edit", params: { id: this.$route.params.id } },
            })
            var res = await itemtypeservice.get(this.$route.params.id)
            console.log(res);
            this.form = {
                title: (res.title ? res.title : ''),
                description: (res.description ? res.description : ''),
                id: this.$route.params.id,
            }
        }else{
            this.breadcrumbs.push({
                title: 'Add',
                exact: true,
                disabled: true,
                to: { name: "auth.chooseus.add" },
            })
        }
    },
}
</script>