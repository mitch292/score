export const store = {
    state: {
        isAuthenticated: false
	},
	mutations: {
		setUserAuthentication(state, authBool) {
			state.isAuthenticated = authBool;
		}
	},
	getters: {
		getUserAuthenticated() {
			return this.state.isAuthenticated;
		}
	}
}