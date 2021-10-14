
import AttachmentApi from "gold-admin/form-attachment/attachment-api";
import attachmentButton from "gold-admin/form-attachment/form-button";
import FormApi from "gold-admin/form/form-api";
import controls from "gold-admin/form-input/controls"
import Form, {button, buttons, form} from "gold-admin/form/form";
import FaIcon from "gold-admin/fa-icon";
import UserList from "./user-list";

@form(
	FaIcon.l("user"),
	new FormApi("/gold/user"),
	() => UserList
)
@button(buttons.save)
@button(buttons.delete)
@button(buttons.reload)
@button(attachmentButton(new AttachmentApi('/gold/user'), {"avatar":"Avatar"}))

export default class UserForm extends Form {

	setTitle(item: any) { this.title = this.id === null ? "new user" : item.name;}

	build() {
		this.addSection()
			.addControl(new controls.string("name", "név"))
			.addControl(new controls.string("email", "e-mail"))
			.addControl(new controls.password('password'))
			.addControl(new controls.select("group", ).Options([{value: 'admin', label: "admin"}, {value:"visitor", label:'visitor'}]))
	}

}
