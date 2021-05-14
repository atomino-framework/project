import ListConfig, {ListAction} from "magic/src/components/list/list-config";
import ListCard from "magic/src/components/list/list-card";
import List from "magic/src/components/list/list";
import MagicForm from "magic/src/magic-form";
import {userForm} from "./user";
import actions from "magic/src/modules/standard-actions";
import articleModel from "../descriptor/article-model";

let list: List;
let form: typeof MagicForm.Doc;
let fields = articleModel.fields;

let cardify: Function = (item: any) => {
	return ListCard.Cardify(
		item.id,
		() => form.open(item.id),
		item.title,
		item.publishDate !== null,
		"https://picsum.photos/380/120" + "?" + Math.random(),
		"https://picsum.photos/50/50" + "?" + Math.random(),
		[
			ListCard.Icon("fas", "fa-newspaper", "yellow"),
			ListCard.Icon("fas", "fa-users", "orangered", "useresfaszaság")
		],
		[
			ListCard.Property("megjelenés", item.publishDate),
			ListCard.Property("guid", item.guid),
		],
		[
			ListCard.Action("fas fa-plus", "büff", list => list.reload()),
			ListCard.Action("fas fa-plus", "baff", list => console.log(item.title))
		]
	);
};

list = List.create(
	"Articles",
	"far fa-newspaper",
	100,
	[ListConfig.Sorting('publikálva', true).asc('publishDate'),],
	'/magic/article',
	{component: ListCard.Component, cardify}
);

form = MagicForm.create(
	list,
	"article",
	"far fa-newspaper",
	'/magic/article',
	(item: any) => item.title ?? 'új cikk',
);

list.addAction(actions.list.reload(list));
list.addAction(actions.list.add(form));

form.addAction(actions.form.attachment(articleModel.collections));
form.addAction(actions.form.save());
form.addAction(actions.form.delete());

form.addSection('Adatok', false).add(
	MagicForm.inputs.string(fields.title),
	MagicForm.inputs.checkbox(fields.status),
	MagicForm.inputs.datetime(fields.publishDate),
	MagicForm.inputs.selector(fields.authorId).api('/magic/user-selector').form(userForm),
	MagicForm.inputs.color(fields.iconColor),
	MagicForm.inputs.string(fields.icon),
);
form.addSection('Meta', false).add(
	MagicForm.inputs.string(fields.permalink),
	MagicForm.inputs.string(fields.metaKeywords),
	MagicForm.inputs.text(fields.metaDescription),
	MagicForm.inputs.selector(fields.relatedIds).api('/magic/article-selector').multi.form(form),
)
form.addSection('Content', true).add(
	MagicForm.inputs.text(fields.lead).code.wide,
	MagicForm.inputs.text(fields.body).code.wide,
)


export {list as articleList, form as articleForm};
