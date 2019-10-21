<template>
	<div>
		<div class="alert alert-danger text-center" v-if="didRegistrationFail">
			we're sorry, it looks like registration wasn't successful.  please try again.
		</div>
		<basic-card>
			<form class="mx-auto col-sm-8 p-5">
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
			</form>
		</basic-card>
	</div>
</template>

<script>
	import BasicCard from '../utility/BasicCard.vue';
	import { store } from '../../app.js';
	
	export default {

		data() {
			return {
				name: null,
				email: null,
				password: null,
				passwordConfirmation: null,
				passwordsMatch: true,
				didRegistrationFail: false
			}
		},

		methods: {
			registerUser: function() {
				this.passwordsMatch = this.password === this.passwordConfirmation;
				if (!this.passwordsMatch) {
					return;
				}
				window.axios.post('api/auth/register', {
					name: this.name, 
					email: this.email, 
					password: this.password,
					password_confirmation: this.passwordConfirmation
				})
					.then(res => {
						store.setLoggedIn();
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