import type Entity from "gold-admin/entity-type";
import FaIcon from "gold-admin/fa-icon";
import List, {button, buttons, filterComponent, list} from "gold-admin/list/list";
import UserForm from "./user-form";
import C_UserListFilter from "./user-list-filter.svelte";

@list(
	"Users",
	FaIcon.s("users"),
	"/api/user/list",
	UserForm
)
@button(buttons.new)
@filterComponent(C_UserListFilter)
export default class UserList extends List {
	cardifyItem(item: Entity) {
		return {
			click: () => this.open(item.id),
			id: item.id,
			title: item.name,
			icon: item.group === "admin" ? [FaIcon.s("user").prop("color", "orange")] : [FaIcon.s("user").prop("color", "gray")],
			active: true,
			subtitle: item.email,
			properties: [
				{label: 'updated', value: item.updated},
				{label: 'guid', value: item.guid},
			],
			avatar: item.avatar,
			//image: item.avatar,
			// buttons: [
			// 	{action:()=>alert('pressed'), label:"Press me!"},
			// 	{action:()=>alert('pressed'), label:FaIcon.s("user")}
			// ]
		}
	}
}
