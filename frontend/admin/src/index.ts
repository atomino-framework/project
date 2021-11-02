import "./options";
import App from "gold-admin/app.svelte";
import ListManager from "gold-admin/app/list-manager";
import MenuItem from "gold-admin/app/menu-item";
import PageManager from "gold-admin/app/page-manager";
import AuthApi from "gold-admin/auth/auth-api";
import FaIcon from "gold-admin/fa-icon";
import DashboardPage from "./pages/dashboard-page";
import UserList from "./pages/user-list";


let pageManager = new PageManager();
let listManager = new ListManager();
let authApi = new AuthApi("/gold/auth", ()=>{
	pageManager.add(new DashboardPage());
	listManager.add(new UserList());
});

let menu = [
	new MenuItem("Dashboard", FaIcon.s("dice-d6"), () => {pageManager.add(new DashboardPage())}),
	new MenuItem("Users", FaIcon.s("users"), () => {listManager.add(new UserList())}),
]

window.addEventListener('load', () => new App({target: document.body, props: {pageManager, listManager, menu, authApi}}));
