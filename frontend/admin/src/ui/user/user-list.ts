import FaIcon from "gold-admin/fa-icon";
import List, {button, buttons, list} from "gold-admin/list/list";
import UserForm from "./user-form";

@list(
	"Users",
	FaIcon.s("users"),
	"/api/user/list",
	UserForm
)
@button(buttons.new)
export default class UserList extends List {
	cardifyItem(item: any) {
		return {
			id: item.id + " | " + item.guid,
			title: item.name,
			active: true,
			subtitle: item.email,
			properties: [
				{label: 'updated', value: item.updated},
				{label: 'created', value: item.created}
			],
			//image: "https://picsum.photos/600/200",
			avatar: item.avatar,
			click: () => this.open(item.id),
			buttons: []
		}
	}
}
