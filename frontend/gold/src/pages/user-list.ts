import Api from "gold-entity/lib/list/api";
import List, {button, list, buttons} from "gold-entity/lib/list/list";
import FaIcon from "gold/lib/fa-icon";
import UserForm from "./user-form";

@list(
	"Felhasználók",
	FaIcon.s("users"),
	new Api("/gold/user"),
	() => UserForm
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
				{label: 'email', value: item.email},
				{label: 'created', value: item.created}
			],
			//image: "https://picsum.photos/600/200",
			avatar: "https://picsum.photos/96/96",
			click: () => this.open(item),
			buttons: [
				{
					label: FaIcon.s('user'),
					action: () => null
				},
				{
					label: "open",
					action: () => this.open(item)
				}
			]
		}
	}
}
