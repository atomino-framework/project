import FaIcon from "gold-admin/fa-icon";
import AttachmentApi from "gold-admin/form-attachment/attachment-api";
import attachmentButton from "gold-admin/form-attachment/form-button";
import controls from "gold-admin/form-input/controls"
import Form, {button, buttons, form} from "gold-admin/form/form";
import type Entity from "gold-admin/entity-type";
import CustomStringControl from "src/controls/custom-string/control";

@form(
	FaIcon.s("user"),
	"/api/user/item",
	(item, id) => id === null ? "new user" : item.name
)
@button(buttons.save)
@button(buttons.delete)
@button(buttons.reload)
@button(attachmentButton(new AttachmentApi("/api/user/attachment"), {"avatar": "Avatar"}))
export default class UserForm extends Form {
	build(item: Entity, options: any) {
		this.addSection("User properties", FaIcon.s("user"))
			.addControl(controls.string("email", "e-mail"))
			.addControl(new CustomStringControl("name", "name"))
			.addControl(controls.password("password", "password"))
			.addControl(controls.select("group",).setOptions(options.groups))

	}
}
