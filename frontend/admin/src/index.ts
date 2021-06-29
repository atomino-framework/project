import App from "magic/src/components/app.svelte";
import {settings} from "magic/src/modules/store";
import menu from "./config/menu";
import {userList} from "./config/user";

// @ts-ignore
window.addEventListener('load', ()=>{
	settings.update(settings=>({
		...settings,
		menu: menu,
		lists: [userList]
	}));
	// @ts-ignore
	const app = new App({target: document.body});
});
