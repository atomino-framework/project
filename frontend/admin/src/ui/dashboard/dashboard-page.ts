import FaIcon from "gold-admin/fa-icon";
import AbstractPage from "gold-admin/app/abstract-page";
import type {SvelteComponent} from "svelte";
import DashboardComponent from "./dashboard-page.svelte";
import {writable} from "svelte/store";
import type {Writable} from "svelte/store";

export default class DashboardPage extends AbstractPage {
	public closeable: boolean = false;
	get $title(): Writable<string> {return writable('Dashboard');}
	get $icon(): Writable<FaIcon> {return writable(FaIcon.s('dice-d6'));}
	get component(): typeof SvelteComponent { return DashboardComponent; }
}
