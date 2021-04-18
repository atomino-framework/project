import ListConfig from "magic/src/components/list/list-config";
import ListCard from "magic/src/components/list/list-card";
import ListFetcher from "magic/src/components/list/list-fetcher";
import List from "magic/src/components/list/list";
import MagicForm from "magic/src/magic-form";
import FormAction from "magic/src/components/document/form/action";
import type FormDoc from "magic/src/components/document/form/doc";
import AttachmentModal from "magic/src/components/document/attachment/attachment-modal.svelte";
import modalManager from "magic/src/elements/modal-manager";
import {userForm} from "./user";


let articleList: List = List.create(
	'Articles',
	"fad fa-newspaper",
	[
		ListConfig.Action("fas fa-recycle", '', list => list.reload()),
		ListConfig.Action("fas fa-plus", '', list => articleForm.open(null))
	],
	100,
	[
		ListConfig.Sorting('publikálva', true).asc('publishDate'),
	],
	new ListFetcher('/magic/article'),
	ListCard.Component,
	(item:any) => ListCard.Cardify(
		item.id,
		() => articleForm.open(item.id),
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
			ListCard.Action("fas fa-minus", "baff", list => console.log(item.title))
		]
	)
);

let articleForm: typeof MagicForm.Doc = MagicForm.create(
	"article",
	articleList,
	"fad fa-newspaper",
	new MagicForm.Fetcher('/magic/article'),
	[
		new FormAction('far fa-folder-open', 'attachments', (doc: FormDoc) => modalManager.show(
			AttachmentModal,
			{
				doc,
				categories: [
					{name: 'image', label: 'kép'},
					{name: 'avatar', label: 'avatár'},
					{name: 'file', label: 'letöltés'}
				]
			}),
			(doc: FormDoc) => doc.exists
		),
		new FormAction('far fa-save', 'save', (doc: FormDoc) => doc.save()),
		new FormAction('fas fa-times', 'delete', (doc: FormDoc) => doc.delete(), (doc: FormDoc) => doc.exists)
	],
	(item: any) => item.title ?? 'új cikk',
);

articleForm.addSection('Adatok', false).add(
	MagicForm.inputs.string('title', 'cím'),
	MagicForm.inputs.checkbox('status'),
	MagicForm.inputs.datetime('publishDate'),
	MagicForm.inputs.selector('authorId').api('/api/user-selector').form(userForm),
	MagicForm.inputs.color('iconColor'),
	MagicForm.inputs.string('icon'),
);
articleForm.addSection('Meta', false).add(
	MagicForm.inputs.string('permalink'),
	MagicForm.inputs.string('metaKeywords'),
	MagicForm.inputs.text('metaDescription'),
	MagicForm.inputs.selector('relatedIds').api('/api/article-selector').multi.form(articleForm),
)
articleForm.addSection('Content', true).add(
	MagicForm.inputs.text('lead').code.wide,
	MagicForm.inputs.text('body').code.wide,
)


export {articleList, articleForm};