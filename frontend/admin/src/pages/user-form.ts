
import AttachmentApi from "gold-attachment/lib/attachment-api";
import attachmentButton from "gold-attachment/lib/form-button";
import ItemApi from "gold-entity/lib/form/api";
import CheckboxesInput from "gold-entity/lib/form/input/checkboxes";
import ComboboxInput from "gold-entity/lib/form/input/combobox";
import PasswordInput from "gold-entity/lib/form/input/password";
import RadioInput from "gold-entity/lib/form/input/radio";
import SelectInput from "gold-entity/lib/form/input/select";
import StringInput from "gold-entity/lib/form/input/string";
import SwitchInput from "gold-entity/lib/form/input/switch";
import TextInput from "gold-entity/lib/form/input/text";
import Form, {button, buttons, form} from "gold-entity/lib/form/form";
import FaIcon from "gold/lib/fa-icon";
import UserList from "./user-list";

@form(
	FaIcon.l("user"),
	new ItemApi("/gold/user"),
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
			.addControl(new StringInput("name", "név"))
			.addControl(new StringInput("email", "e-mail"))
			.addControl(new PasswordInput('password'))
			.addControl(new SelectInput("group", ).Options([{value: 'admin', label: "admin"}, {value:"visitor", label:'visitor'}]))
	}

}
