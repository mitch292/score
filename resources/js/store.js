import { fetchUserHighlightIds, fetchUserGameIds } from './global.js';
export const store = {
    state: {
		isAuthenticated: false,
		savedHighlights: [],
		savedGames: [],
	},
	mutations: {
		setUserAuthentication(state, authBool) {
			state.isAuthenticated = authBool;
		},
		setSavedHighlights(state, savedHighlights, appendMode=false) {
			state.savedHighlights = appendMode ? [...state.savedHighlights, ...savedHighlights] : savedHighlights;
		},
		setSavedGames(state, savedGames, appendMode=false) {
			state.savedGames = appendMode ? [...state.savedGames, ...savedGames] : savedGames;

		}
	},
	getters: {
		getUserAuthenticated() {
			return this.state.isAuthenticated;
		},
		getSavedHighlights(state) {
			return state.savedHighlights;
		},
		getSavedGames(state) {
			return state.savedGames;
		}
	},
	initializers: {
		initializeSavedHighlights(state) {
			if (state.isAuthenticated) {
				fetchUserHighlightIds().then(resp => state.savedHighlights = resp.data);
			} else {
				state.savedHighlights = [];
			}
		},
		initializeSavedGames(state) {
			console.log('state', state, state.isAuthenticated)
			if (state.isAuthenticated) {
				fetchUserGameIds().then(resp => state.savedGames = resp.data);
			} else {
				state.savedGames = [];
			}
		},
	}
}