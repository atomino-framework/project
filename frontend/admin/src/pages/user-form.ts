import FaIcon from "gold-admin/fa-icon";
import attachmentButton from "gold-admin/form-attachment/form-button";
import controls from "gold-admin/form-input/controls"
import Form, {button, buttons, form} from "gold-admin/form/form";

@form(
	FaIcon.s("user"),
	"/gold/user",
	(item, id)=> id === null ? "new user" : item.name
)
@button(buttons.save)
@button(buttons.delete)
@button(buttons.reload)
@button(attachmentButton('/gold/user/attachemnts', {"avatar":"Avatar"}))
export default class UserForm extends Form {
	build() {
		this.addSection()
			.addControl(controls.string("name"))
			.addControl(controls.string("email"))
			.addControl(controls.password('password'))
			.addControl(controls.select("group", ).setOptions(['admin', 'visitor']))
	}
}
