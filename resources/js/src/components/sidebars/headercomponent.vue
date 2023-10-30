<template>
    <div class="no-print" v-if="loggedIn">
        <v-app-bar density="compact" color="primary">
            <template v-slot:prepend>
                <v-btn exact :to="{ name: 'auth.panel' }" :link="true" icon="mdi-vuetify"></v-btn>
            </template>
            <!-- <v-toolbar-title>Credit CRM</v-toolbar-title> -->
            <v-btn exact :to="{ name: 'auth.users.listing' }">Users</v-btn>
            <v-btn exact :to="{ name: 'auth.referrals.listing' }">Referrals</v-btn>
            
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
                            <v-btn rounded link :to="{ name: 'auth.profiles' }" variant="text">
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