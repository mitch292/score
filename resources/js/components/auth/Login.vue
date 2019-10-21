<template>
	<div>
		<div class="alert alert-danger text-center" v-if="didLoginFail">
			looks like there was a problem logging in, please try again.
		</div>
		<basic-card>
			<form class="mx-auto col-sm-8 p-5">
				<p>
					<label class="text-red mr-2">email:</label><br>
					<input class="p-2 w-100" autocomplete="username" type="text" v-model="email" placeholder="mickey.mantle@gmail.com" required>
				</p>
				<p>
					<label class="text-red mr-2">password:</label><br>
					<input class="p-2 w-100" autocomplete="new-password" type="password" v-model="password" required>
				</p>
				<div class="mt-4 text-center">
					<button class="btn btn-primary" v-on:click="this.loginUser">login</button>
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
				email: null,
				password: null,
				didLoginFail: false
			}
		},

		methods: {
			loginUser: function() {
				window.axios.post('api/auth/login', {
					email: this.email,
					password: this.password
				})
					.then(res => {
						store.setLoggedIn();
						this.$router.push('/')

					})
					.catch(err => {
						this.didLoginFail = true;
					})
			}
		},

		components: { BasicCard }

	}
</script>

<style>

</style>