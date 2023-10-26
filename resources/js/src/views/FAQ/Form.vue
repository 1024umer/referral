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
                    <v-col cols="12">
                        <v-text-field v-model="form.title" :counter="255" label="Title" required
                            :error-messages="errors.title"></v-text-field>
                    </v-col>
                    <v-col cols="6">
                        <v-text-field v-model="form.question" :counter="255" label="Question" required
                            :error-messages="errors.question"></v-text-field>
                    </v-col>
                    <v-col cols="6">
                        <v-text-field v-model="form.answer" :counter="255" label="Answer" required
                            :error-messages="errors.answer"></v-text-field>
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
const itemtypeservice = new service('faqs')
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
                    title: 'FAQs',
                    exact: true,
                    disabled: false,
                    to: { name: "auth.faqs.listing" },
                },
            ],
            form: {
                title:'',
                question:'',
                answer: '',
                is_active: true,
                id: 0,
            },
            loading: false,
            errors: {
                question:'',
                answer: '',
                title:'',
            }
        }
    },
    methods: {
        async insertRecord() {
            this.resetErrors()
            this.loading = true
            var formData = new FormData();
            formData.append('title', this.form.title);
            formData.append('question', this.form.question);
            formData.append('answer', this.form.answer);
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
                if (res.data.question) {
                    this.errors.question = res.data.question
                }
                if (res.data.answer) {
                    this.errors.answer = res.data.answer
                }
            } else {
                this.$router.push({ name: "auth.faqs.listing" });
            }
            this.loading = false
        },
        resetErrors() {
            this.errors = {
                question:'',
                answer: '',
                title: '',
            }
        },
    },
    watch: {

    },
    async mounted() {
        this.otherVideos = await itemtypeservice.getlist('').then(e => e.data)
        if (this.$route.params.id) {
            this.form.id = this.$route.params.id
            this.breadcrumbs.push({
                answer: 'Edit',
                exact: true,
                disabled: true,
                to: { name: "auth.blogs.add", params: { id: this.$route.params.id } },
            })
            var res = await itemtypeservice.get(this.$route.params.id)
            this.form = {
                title: (res.title ? res.title : ''),
                question: (res.question ? res.question : ''),
                answer: (res.answer ? res.answer : ''),
                is_active: (res.is_active == 0 ? false : true),
                id: this.$route.params.id,
            }
        } else {
            this.breadcrumbs.push({
                title: 'Add',
                exact: true,
                disabled: true,
                to: { name: "auth.faqs.add" },
            })
        }
    },
}
</script>