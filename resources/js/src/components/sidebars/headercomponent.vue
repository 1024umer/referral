<template>
    <div class="no-print" v-if="loggedIn">
        <v-app-bar density="compact" color="primary">
            <template v-slot:prepend>
                <v-btn exact :to="{ name: 'auth.users.listing' }" :link="true" icon="mdi-vuetify"></v-btn>
            </template>
            <!-- <v-toolbar-title>Credit CRM</v-toolbar-title> -->
            <v-btn>Categories <v-icon>mdi-menu-down</v-icon>
                <v-menu max-width="200px" activator="parent" open-on-hover>
                    <v-list>
                        <v-list-item exact :to="{ name: 'auth.categories.listing' }" :link="true">
                            <v-list-item-title>Blog Category</v-list-item-title>
                        </v-list-item>
                        <v-list-item exact :to="{ name: 'auth.casecategories.listing' }" :link="true">
                            <v-list-item-title>Case Category</v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-menu>
            </v-btn>
            <v-btn>Home <v-icon>mdi-menu-down</v-icon>
                <v-menu max-width="200px" activator="parent" open-on-hover>
                    <v-list>
                        <v-list-item exact :to="{ name: 'auth.feedbacks.listing' }" :link="true">
                            <v-list-item-title>Feedbacks</v-list-item-title>
                        </v-list-item>
                        <v-list-item exact :to="{ name: 'auth.faqs.listing' }" :link="true">
                            <v-list-item-title>FAQs</v-list-item-title>
                        </v-list-item>
                        <v-list-item exact :to="{ name: 'auth.chooseus.listing' }" :link="true">
                            <v-list-item-title>Why Choose Us</v-list-item-title>
                        </v-list-item>
                        <v-list-item exact :to="{ name: 'auth.additional.listing' }" :link="true">
                            <v-list-item-title>Additional Services</v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-menu>
            </v-btn>
            <v-btn :to="{ name: 'auth.blogs.listing' }" :link="true">Blogs</v-btn>
            <v-btn :to="{ name: 'auth.services.listing' }" :link="true">Services</v-btn>
            <v-btn :to="{ name: 'auth.events.listing' }" :link="true">Events</v-btn>
            <v-btn :to="{ name: 'auth.cases.listing' }" :link="true">Case Studies</v-btn>
            <v-btn :to="{ name: 'auth.contacts.listing' }" :link="true">Contacts</v-btn>
            <v-btn>Quiz <v-icon>mdi-menu-down</v-icon>
                <v-menu max-width="200px" activator="parent" open-on-hover>
                    <v-list>
                        <v-list-item exact :to="{ name: 'auth.surveys.listing' }" :link="true">
                            <v-list-item-title>Survey</v-list-item-title>
                        </v-list-item>
                        <v-list-item exact :to="{ name: 'auth.surveyquestions.listing' }" :link="true">
                            <v-list-item-title>Questions</v-list-item-title>
                        </v-list-item>
                        <v-list-item exact :to="{ name: 'auth.surveyanswers.listing' }" :link="true">
                            <v-list-item-title>Answers</v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-menu>
            </v-btn>
            <v-spacer></v-spacer>

            <v-menu min-width="200px" rounded>
                <template v-slot:activator="{ props }">
                    <v-btn icon v-bind="props">
                        <v-avatar :image="user.image_url">
                        </v-avatar>
                    </v-btn>
                </template>
                <v-card>
                    <v-card-text>
                        <div class="mx-auto text-center">
                            <v-avatar :image="user.image_url"></v-avatar>
                            <h3>{{ user.name }}</h3>
                            <p class="text-caption mt-1">
                                {{ user.email }}
                            </p>
                            <v-divider class="my-3"></v-divider>
                            <v-btn rounded link :to="{ name: 'auth.users' }" variant="text">
                                Edit Account
                            </v-btn>
                            <v-divider class="my-3"></v-divider>
                            <v-btn rounded @click="logoutauthparent" variant="text">
                                Disconnect
                            </v-btn>
                        </div>
                    </v-card-text>
                </v-card>
            </v-menu>
        </v-app-bar>
    </div>
</template>
<script>
export default {
    name: "headercomponent",
    components: {
    },
    data: () => ({
        drawer: false,
        overlay: false,
        collapseOnScroll: true,
        items: [
            { title: '+ User', link: 'auth.users.add' },
            { title: '+ Brand', link: 'auth.brands.add' },
            { title: '+ Brief Form', link: 'auth.briefforms.add' },
            { title: '+ Setting', link: 'auth.settings.add', permission_name: 'm_flag-create' },
            { title: '+ Payment Link', link: 'auth.payments.add', permission_name: 'payment-create' },
        ],
        today_date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)
    }),
    methods: {
        logoutauthparent() {
            this.$store.commit("setLoginStatus", false);
            this.$store.commit("setAuthToken", "");
            this.$store.commit("setloggedInUser", {});
            this.$router.push({ name: "auth.login" });
        },
    },
    computed: {
        user() {
            return this.$store.getters.loggedInUser;
        },
        loggedIn() {
            return this.$store.getters.loggedIn;
        },
        permissions() {
            return this.$store.getters.getPermissions;
        },
        leadStatuses() {
            // return this.$store.getters.getLeadStatuses;
            return [{
                name: 'All',
                id: 0,
                bgClass: '',
                forGrid: false,
            }, ...this.$store.getters.getLeadStatuses]
        },
    },
    watch: {

    },
    mounted() {
    },
};
</script>