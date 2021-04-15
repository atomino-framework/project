import ListConfig from "magic/src/components/list/list-config";
import ListCard from "magic/src/components/list/list-card";
import ListFetcher from "magic/src/components/list/list-fetcher";
import List from "magic/src/components/list/list";
import MagicForm from "magic/src/magic-form";
import FormAction from "magic/src/components/document/form/action";
import type FormDoc from "magic/src/components/document/form/doc";
import MyEditor from "./editors/my-editor.svelte";

import AttachmentModal from "magic/src/components/document/attachment/attachment-modal.svelte";
import modalManager from "magic/src/elements/modal-manager";


let articleList: List = List.create(
	'My article list',
	"fad fa-book",
	[
		ListConfig.Action("fas fa-recycle", null, list => list.reload()),
		ListConfig.Action("fas fa-plus", null, list => articleForm.open(null))
	],
	100,
	[
		ListConfig.Sorting('publikálva', true).asc('publishDate'),
		ListConfig.Sorting('complex', true, false, 'my-key')
	],
	new ListFetcher('/magic/article'),
	ListCard.Component,
	(item) => ListCard.Cardify(
		item.id,
		() => articleForm.open(item.id),
		item.title,
		item.publishDate !== null,
		"https://picsum.photos/380/120" + "?" + Math.random(),
		"https://picsum.photos/50/50" + "?" + Math.random(),
		[
			ListCard.Icon("fas", "fa-crown", "yellow"),
			ListCard.Icon("fas", "fa-users", "orangered", "useresfaszaság")
		],
		[
			ListCard.Property("megjelenés", item.publishDate),
			ListCard.Property("guid", item.guid),
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
	"fad fa-crown",
	new MagicForm.Fetcher('/magic/article'),
	[
		new FormAction('fad fa-folder-open', 'attachments', (doc: FormDoc) => modalManager.show(
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
		new FormAction('fad fa-save', 'save', (doc: FormDoc) => doc.save()),
		new FormAction('fas fa-times', 'delete', (doc: FormDoc) => doc.delete(), (doc: FormDoc) => doc.exists)
	],
	(item: Object) => item['title'] ?? 'új cikk',
);

articleForm.addSection('relatedIds', false).add(MagicForm.inputs.related('relatedIds').api('/api/article-selector').form(articleForm))

articleForm.addSection('Adatok', false).add(
	MagicForm.inputs.string('title', 'cím'),
	MagicForm.inputs.string('authorId'),
	MagicForm.inputs.selector('authorId').api('/api/article-selector'),
	MagicForm.inputs.selector('relatedIds').api('/api/article-selector').multi.form(articleForm),
	MagicForm.inputs.string('iconColor'),
	MagicForm.inputs.checkbox('status'),
	MagicForm.inputs.datetime('publishDate'),
	MagicForm.inputs.string('publishDate'),
	MagicForm.inputs.time('test'),
	MagicForm.inputs.float('comment_count'),
	MagicForm.inputs.color('iconColor'),
	MagicForm.inputs.editor('body').editor(MyEditor).buttonText("Szerk"),
	MagicForm.inputs.checkboxes('label').options([{label: 'Blogpost', value: 'Blog'}, 'Ad', {News: 'Hír'}]).options({Blog: 'Bloggpost', News: 'Hírbaszod'}),
	MagicForm.inputs.select('comment_status').options(["open", "closed", "hidden"]),
	MagicForm.inputs.integer('authorId'),
	MagicForm.inputs.string('relatedIds')
)
articleForm.addSection('Content', true).add(
	MagicForm.inputs.text('body').code.wide,
	MagicForm.inputs.text('body').code
)


export {articleList, articleForm};