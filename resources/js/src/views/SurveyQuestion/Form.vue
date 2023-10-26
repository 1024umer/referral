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
                        <v-text-field v-model="form.question" :counter="255" label="Question" required
                            :error-messages="errors.question"></v-text-field>
                    </v-col>
                    <v-col cols="6">
                        <v-select :error-messages="errors.survey_id" item-text="name" item-title="name" item-value="id"
                            label="Survey" :items="surveys" v-model="form.survey_id"></v-select>
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
const categoryservice = new service('surveys')
const itemtypeservice = new service('surveys-questions')
export default {
    data() {
        return {
            surveys: [],
            otherVideos: [],
            breadcrumbs: [
                {
                    title: 'Dashboard',
                    to: { name: "auth.panel" },
                    disabled: false,
                    exact: true,
                },
                {
                    title: 'Question',
                    exact: true,
                    disabled: false,
                    to: { name: "auth.surveyquestions.listing" },
                },
            ],
            form: {
                survey_id: [],
                question: '',
                id: 0,
            },
            loading: false,
            errors: {
                survey_id: [],
                question: [],
            }
        }
    },
    methods: {
        async insertRecord() {
            this.resetErrors()
            this.loading = true
            var formData = new FormData();
            formData.append('question', this.form.question);
            formData.append('survey_id', this.form.survey_id);
            if (this.form.id > 0) {
                formData.append('id', this.form.id);
                var res = await itemtypeservice.update(formData, this.form.id)
            } else {
                var res = await itemtypeservice.create(formData)
            }
            if (!res.status) {
                if (res.data.survey_id) {
                    this.errors.survey_id = res.data.survey_id
                }
                if (res.data.question) {
                    this.errors.question = res.data.question
                }
            } else {
                this.$router.push({ name: "auth.surveyquestions.listing" });
            }
            this.loading = false
        },
        resetErrors() {
            this.errors = {
                survey_id: [],
                question: [],
            }
        },
    },
    watch: {
    },
    async mounted() {
        this.surveys = await categoryservice.getlist('').then(e => e.data)
        this.otherVideos = await itemtypeservice.getlist('').then(e => e.data)
        if (this.$route.params.id) {
            this.form.id = this.$route.params.id
            this.breadcrumbs.push({
                title: 'Edit',
                exact: true,
                disabled: true,
                to: { name: "auth.surveyquestions.add", params: { id: this.$route.params.id } },
            })
            var res = await itemtypeservice.get(this.$route.params.id)
            this.form = {
                question: (res.question ? res.question : ''),
                survey_id: (res.survey_id ? res.survey_id : ''),
                id: this.$route.params.id,
            }
        } else {
            this.breadcrumbs.push({
                title: 'Add',
                exact: true,
                disabled: true,
                to: { name: "auth.surveyquestions.add" },
            })
        }
    },
}
</script>