import App from "./radium/component/app.svelte";
import "./radium/style.scss"

window.addEventListener('load', ()=>{
	// settings.update(settings=>({
	// 	...settings,
	// 	menu: menu,
	// 	lists: [articleList, userList]
	// }));
	const app = new App({target: document.body});
});
