<template>
	<div>
		<v-container class="grey lighten-5 loginscreen col-md-6 ">
			<!-- <v-card
				class="d-flex align-content-center flex-wrap "
				style="padding: 22px"
				outlined
			> -->
				<v-row>
					<v-col>
						<h1 class="text-center">Please Login</h1>
					</v-col>
					<v-col md="12">
						<div class="justify-center">
							<v-form
								ref="form"
								v-model="loading"
								lazy-validation
							>
								<v-text-field
									v-model="loggedinemail"
									:rules="[rules.required, rules.email]"
									label="Email"
									clearable
								></v-text-field>
								<v-text-field
									v-model="loggedinpassword"
									:rules="[rules.required]"
									label="Password"
									clearable
									:append-icon="show3 ? 'mdi-eye' : 'mdi-eye-off'"
									@click:append="show3 = !show3"
									:type="show3 ? 'text' : 'password'"
								></v-text-field>
								<v-btn
									class="col"
									elevation="1"
									@click="dologin"
									color="primary"
									large
									raised
									:loading="btnloading"
									:disabled="btnloading"
									>Login</v-btn
								>
							</v-form>
						</div>
					</v-col>
				</v-row>
			<!-- </v-card> -->
			<v-snackbar v-model="snackbar">
				{{ erorrs.email }}

				<template v-slot:action="{ attrs }">
					<v-btn
						color="pink"
						text
						v-bind="attrs"
						@click="snackbar = false"
					>
						Close
					</v-btn>
				</template>
			</v-snackbar>
		</v-container>
	</div>
</template>
<script>
import loginservice from "@services/auth/login";
export default {
	name: "Login",
	components: {},
	mounted() {
		this.$nextTick(function () {
			// this.$store.commit("setAppCls", "login-screen-main");
		});
	},
	data() {
		return {
			loader: null,
			loading: false,
			btnloading: false,
			snackbar: false,
			loggedinemail: "",
			loggedinpassword: "",
			show3: false,
			password: "Password",
			erorrs: {
				email: "",
				password: "",
			},
			rules: {
				required: (value) => !!value || "Required.",
				email: (value) => {
					const pattern =
						/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
					return pattern.test(value) || "Invalid e-mail.";
				},
			},
		};
	},
	methods: {
		dologin: async function () {
			if (this.$refs.form.validate()) {
				this.btnloading = true;
				var logindetail = await loginservice.dologin(
					this.loggedinemail,
					this.loggedinpassword
				);
				this.btnloading = false;
				if (logindetail.data) {
					if (logindetail.status) {
						this.$store.commit("setLoginStatus", true);
						this.$store.commit("setAuthToken", logindetail.data.token);
                        var user = await loginservice.me();
						this.$store.commit("setloggedInUser", user);
						this.$router.push({ name: "auth.blogs.listing" });
					} else {
						this.erorrs.email = logindetail.data;
						this.snackbar = true;
					}
				}
			}
		},
	},
	watch: {},
};
</script>