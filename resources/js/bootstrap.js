import axios from 'axios';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.body.querySelector('meta[name="csrf-token"]');
// console.log("Axios test (CDN):", window.axios);

if (token) {
	window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
	// console.error("CSRF token not found!");
}