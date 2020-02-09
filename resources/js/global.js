import Swal from 'sweetalert2';

export const fetchUserHighlightIds = () => {
	return window.axios.get('/mlb/highlights/my-highlights', {params: {idOnly: true}})
		.then(resp => resp)
		.catch(err => {
			console.error('there was a problem fetching saved highlight ids', err)
			return [];
		});
}

export const fetchUserGameIds = () => {
	return window.axios.get('/mlb/game/my-games', {params: {gamePkOnly: true}})
		.then(resp => resp)
		.catch(err => {
			console.error('there was a problem fetching saved game ids', err)
			return [];
		});
}

export const fireSweetAlert = (config={}) => {
	Swal.fire({
		position: 'bottom-end',
		icon: 'success',
		title: 'success',
		showConfirmButton: false,
		timer: 1250,
		toast: true,
		...config
	})
}