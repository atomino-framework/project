import ListConfig, {ListAction} from "magic/src/components/list/list-config";
import ListCard from "magic/src/components/list/list-card";
import List from "magic/src/components/list/list";
import MagicForm from "magic/src/magic-form";
import actions from "magic/src/modules/standard-actions";
import userModel from "../descriptor/user-model";

let list: List;
let form: typeof MagicForm.Doc;
let fields = userModel.fields;

let cardify: Function = (item: any) => ListCard.Cardify(
	item.id,
	() => form.open(item.id),
	item.name,
true,
	null,
	null,
	[],
	[
		ListCard.Property("created", item.created),
		ListCard.Property("updated", item.updated),
	],
	[]
);

list = List.create(
	'Users',
	"fas fa-users",
	100,
	[
		ListConfig.Sorting('name', true).asc('name'),
	],
	'/magic/user',
	{component: ListCard.Component, cardify}
);

form = MagicForm.create(
	list,
	"user",
	"far fa-user",
	'/magic/user',
	(item: any) => item.name ?? 'new user',
);

list.addAction(actions.list.reload(list));
list.addAction(actions.list.add(form));

form.addAction(actions.form.attachment(userModel.collections));
form.addAction(actions.form.save());
form.addAction(actions.form.delete());

form.addSection("User properties", false).add(
	MagicForm.inputs.string(fields.name),
	MagicForm.inputs.string(fields.email),
	MagicForm.inputs.select(fields.group).options(fields.group.options),
	MagicForm.inputs.string('setpassword', 'password'),
);

export {list as userList, form as userForm};