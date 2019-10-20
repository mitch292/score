<template>
	<div>
		<basic-card>
			<form class="mx-auto col-sm-8 p-5">
				<p>
					<label class="text-red mr-2">name:</label><br>
					<input class="p-2 w-100" type="text" v-model="name" placeholder="Mickey Mantle" required>
				</p>
				<p>
					<label class="text-red mr-2">email:</label><br>
					<input class="p-2 w-100" type="text" v-model="email" placeholder="mickey.mantle@gmail.com" required>
				</p>
				<p>
					<label class="text-red mr-2">password:</label><br>
					<input class="p-2 w-100" type="password" v-model="password" required>
				</p>
				<p>
					<label class="text-red mr-2">confirm password:</label><br>
					<input class="p-2 w-100" type="password" v-model="passwordConfirmation" required>
					<div class="alert alert-warning" v-if="!passwordsMatch">
						looks like the passwords don't match
					</div>
				</p>

				<div class="mt-4 text-center">
					<button class="btn btn-primary" v-on:click="this.registerUser">sign up</button>
				</div>
			</form>
		</basic-card>
	</div>
</template>

<script>
	import BasicCard from '../utility/BasicCard.vue';
	export default {

		data() {
			return {
				name: null,
				email: null,
				password: null,
				passwordConfirmation: null,
				passwordsMatch: true,
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
					.then(res => this.$router.push('/'))
					.error(err => console.error('error', err))
			}
		},

		components: { BasicCard }

	}
</script>

<style>

</style>