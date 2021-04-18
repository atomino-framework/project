import ListConfig from "magic/src/components/list/list-config";
import ListCard from "magic/src/components/list/list-card";
import ListFetcher from "magic/src/components/list/list-fetcher";
import List from "magic/src/components/list/list";
import MagicForm from "magic/src/magic-form";
import FormAction from "magic/src/components/document/form/action";
import type FormDoc from "magic/src/components/document/form/doc";
import AttachmentModal from "magic/src/components/document/attachment/attachment-modal.svelte";
import modalManager from "magic/src/elements/modal-manager";
import {articleForm} from "./article";


let userList: List = List.create(
	'Users',
	"fad fa-users",
	[
		ListConfig.Action("fas fa-recycle", '', list => list.reload()),
		ListConfig.Action("fas fa-plus", '', list => userForm.open(null))
	],
	100,
	[
		ListConfig.Sorting('név', true).asc('name'),
	],
	new ListFetcher('/magic/user'),
	ListCard.Component,
	(item: any) => ListCard.Cardify(
		item.id,
		() => userForm.open(item.id),
		item.name,
		item.publishDate !== null,
		null,
		"https://picsum.photos/50/50" + "?" + Math.random(),
		[],
		[
			ListCard.Property("created", item.created),
			ListCard.Property("updated", item.updated),
		],
		[]
	)
);

let userForm: typeof MagicForm.Doc = MagicForm.create(
	"user",
	userList,
	"fad fa-user",
	new MagicForm.Fetcher('/magic/user'),
	[
		new FormAction('far fa-folder-open', 'attachments', (doc: FormDoc) => modalManager.show(
			AttachmentModal,
			{
				doc,
				categories: [
					{name: 'avatar', label: 'avatár'},
				]
			}),
			(doc: FormDoc) => doc.exists
		),
		new FormAction('far fa-save', 'save', (doc: FormDoc) => doc.save()),
		new FormAction('fas fa-times', 'delete', (doc: FormDoc) => doc.delete(), (doc: FormDoc) => doc.exists)
	],
	(item: any) => item.name ?? 'new user',
);

userForm.addSection('Adatok', false).add(
	MagicForm.inputs.string('name'),
	MagicForm.inputs.string('email'),
	MagicForm.inputs.select('group').options(['admin','moderator','visitor']),
	MagicForm.inputs.string('setpassword'),
);

export {userList, userForm};