<template>
	<div>
		<div class="alert alert-danger text-center" v-if="didRegistrationFail">
			we're sorry, it looks like registration wasn't successful.  please try again.
		</div>
		<basic-card>
			<form class="mx-auto col-10 p-5">
				<p>
					<label class="text-red mr-2">name:</label><br>
					<input class="p-2 w-100" type="text" v-model="name" placeholder="Mickey Mantle" required>
				</p>
				<p>
					<label class="text-red mr-2">email:</label><br>
					<input class="p-2 w-100" autocomplete="username" type="text" v-model="email" placeholder="mickey.mantle@gmail.com" required>
				</p>
				<p>
					<label class="text-red mr-2">password:</label><br>
					<input class="p-2 w-100" autocomplete="new-password" type="password" v-model="password" required>
				</p>
				<p>
					<label class="text-red mr-2">confirm password:</label><br>
					<input class="p-2 w-100" autocomplete="new-password" type="password" v-model="passwordConfirmation" required>
				</p>
				<div class="alert alert-warning" v-if="!passwordsMatch">
					looks like the passwords don't match
				</div>

				<div class="mt-4 text-center">
					<button class="btn btn-primary" v-on:click="this.registerUser">sign up</button>
				</div>

				<div class="mt-5 border-top text-center">
					<a class="btn mt-3 btn-outline-primary" :href="googleAuthRoute">
						<font-awesome-icon :icon="['fab', 'google']" />
						<span class="ml-2">sign up with google</span>
					</a>
				</div>

			</form>
		</basic-card>
	</div>
</template>

<script>
	import BasicCard from '../utility/BasicCard.vue';
	import { store } from '../../store.js';
	
	export default {

		data() {
			return {
				name: null,
				email: null,
				password: null,
				passwordConfirmation: null,
				passwordsMatch: true,
				didRegistrationFail: false,
				googleAuthRoute: route('api.auth.login.oauth', {provider: 'google'})
			}
		},

		methods: {
			registerUser: function() {
				this.passwordsMatch = this.password === this.passwordConfirmation;
				if (!this.passwordsMatch) {
					return;
				}
				window.axios.post(route('api.auth.register'), {
					name: this.name, 
					email: this.email, 
					password: this.password,
					password_confirmation: this.passwordConfirmation
				})
					.then(res => {
						store.mutations.setUserAuthentication(store.state, true);
						this.$router.push('/')

					})
					.catch(err => {
						this.didRegistrationFail = true;
					})
			}
		},

		components: { BasicCard }

	}
</script>

<style>

</style>