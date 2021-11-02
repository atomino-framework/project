
import AttachmentApi from "gold-admin/form-attachment/attachment-api";
import attachmentButton from "gold-admin/form-attachment/form-button";
import FormApi from "gold-admin/form/form-api";
import controls from "gold-admin/form-input/controls"
import Form, {button, buttons, form} from "gold-admin/form/form";
import FaIcon from "gold-admin/fa-icon";
import UserList from "./user-list";

@form(
	FaIcon.s("user"),
	"/gold/user"
)
@button(buttons.save)
@button(buttons.delete)
@button(buttons.reload)
@button(attachmentButton('/gold/user/attachemnts', {"avatar":"Avatar"}))

export default class UserForm extends Form {

	setTitle(item: any) { this.title = this.id === null ? "new user" : item.name;}

	build() {
		this.addSection()
			.addControl(controls.string("name"))
			.addControl(controls.string("email"))
			.addControl(controls.password('password'))
			.addControl(controls.select("group", ).setOptions(['admin', 'visitor']))
	}

}
