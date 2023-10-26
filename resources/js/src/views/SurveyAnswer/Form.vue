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
                        <v-text-field v-model="form.answer" :counter="255" label="Answer" required
                            :error-messages="errors.answer"></v-text-field>
                    </v-col>
                    <v-col cols="6">
                        <v-select :error-messages="errors.survey_id" item-text="name" item-title="name" item-value="id"
                            label="Survey" :items="surveys" v-model="form.survey_id"></v-select>
                    </v-col>
                    <v-col cols="6">
                        <v-select :error-messages="errors.survey_question_id" item-text="question" item-title="question"
                            item-value="id" label="Question" :items="categories"
                            v-model="form.survey_question_id"></v-select>

                    </v-col>
                    <v-col cols="3">
                        <v-checkbox v-model="form.is_correct" label="Is Correct?"></v-checkbox>
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
const surveys = new service('surveys')
const categoryservice = new service('surveys-questions')
const itemtypeservice = new service('surveys-answers')
export default {
    data() {
        return {
            surveys: [],
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
                    title: 'Answer',
                    exact: true,
                    disabled: false,
                    to: { name: "auth.surveyanswers.listing" },
                },
            ],
            form: {
                survey_id: [],
                answer: '',
                is_correct: true,
                survey_question_id: [],
                id: 0,
            },
            loading: false,
            errors: {
                survey_id: [],
                survey_question_id: [],
                answer: [],
            }
        }
    },
    methods: {
        async insertRecord() {
            this.resetErrors()
            this.loading = true
            var formData = new FormData();
            formData.append('answer', this.form.answer);
            formData.append('survey_id', this.form.survey_id);
            formData.append('survey_question_id', this.form.survey_question_id);
            formData.append('is_correct', (this.form.is_correct == true ? 1 : 0));

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
                if (res.data.survey_question_id) {
                    this.errors.survey_question_id = res.data.survey_question_id
                }
                if (res.data.answer) {
                    this.errors.answer = res.data.answer
                }

            } else {
                this.$router.push({ name: "auth.surveyanswers.listing" });
            }
            this.loading = false
        },
        resetErrors() {
            this.errors = {
                survey_id: [],
                survey_question_id: [],
                answer: [],
            }
        },
    },
    watch: {

    },
    async mounted() {
        this.surveys = await surveys.getlist('').then(e => e.data.map(item => ({ id: item.id, name: item.name })));
        this.categories = await categoryservice.getlist('').then(e => e.data.map(item => ({ id: item.id, question: item.question })));

        this.otherVideos = await itemtypeservice.getlist('').then(e => e.data)
        if (this.$route.params.id) {
            this.form.id = this.$route.params.id
            this.breadcrumbs.push({
                title: 'Edit',
                exact: true,
                disabled: true,
                to: { name: "auth.surveyanswers.add", params: { id: this.$route.params.id } },
            })
            var res = await itemtypeservice.get(this.$route.params.id)
            this.form = {
                answer: (res.answer ? res.answer : ''),
                survey_id: (res.question.survey.name ? res.question.survey.name : ''),
                survey_question_id: (res.question.question ? res.question.question : ''),
                is_correct: (res.is_correct == 0 ? false : true),
                id: this.$route.params.id,
            }
        } else {
            this.breadcrumbs.push({
                title: 'Add',
                exact: true,
                disabled: true,
                to: { name: "auth.surveyanswers.add" },
            })
        }
    },
}
</script>