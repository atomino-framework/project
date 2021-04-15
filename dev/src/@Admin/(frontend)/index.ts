//import App from "./magic/components/app.svelte"
import App from "magic/src/components/app.svelte";
import {settings} from "magic/src/modules/store";
import menu from "./config/menu";
import {articleList} from "./config/article";
import { gestures } from '@composi/gestures'
import {userList} from "./config/user";

window.addEventListener('load', ()=>{
	gestures();
	settings.update(settings=>({
		...settings,
		menu: menu,
		lists: [articleList, userList]
	}));
	const app = new App({target: document.body});
});