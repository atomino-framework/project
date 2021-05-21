import ListConfig, {ListAction} from "magic/src/components/list/list-config";
import ListCard from "magic/src/components/list/list-card";
import List from "magic/src/components/list/list";
import MagicForm from "magic/src/magic-form";
import actions from "magic/src/modules/standard-actions";
import podcastModel from "../descriptor/podcast-model";

let list: List;
let form: typeof MagicForm.Doc;
let fields = podcastModel.fields;

let cardify: Function = (item: any) => ListCard.Cardify(
	item.id,
	() => form.open(item.id),
	item.name,
	true,
	null,
	"https://picsum.photos/50/50" + "?" + Math.random(),
	[],
	[
		ListCard.Property("hossz", item.length)
	],
	[]
);

list = List.create(
	'Termékek',
	"fas fa-users",
	100,
	[
		ListConfig.Sorting('név', true).asc('name'),
	],
	'/magic/podcast',
	{component: ListCard.Component, cardify}
);

form = MagicForm.create(
	list,
	"podcast",
	"far fa-user",
	'/magic/podcast',
	(item: any) => item.name ?? 'new podcast',
);

list.addAction(actions.list.reload(list));
list.addAction(actions.list.add(form));

form.addAction(actions.form.save());
form.addAction(actions.form.delete());

form.addSection('Adatok', false).add(
	MagicForm.inputs.string(fields.name),
	MagicForm.inputs.integer(fields.length)
);

export {list as podcastList, form as podcastForm};