import MenuItem from "magic/src/modules/menu-item";
import {articleForm, articleList} from "./article";

let menu = [
    MenuItem.List("Books", "fad fa-users", articleList).activate(),
    MenuItem.Page("Books", "fad fa-users", articleForm, 54437).activate(),
    MenuItem.Menu("Második menüpont", "fad fa-crow", [
        MenuItem.Custom("Első al menüpont", "fad fa-crow", ()=>console.log('selected')),
        MenuItem.Custom("Második al menüpont", "fad fa-crow", ()=>console.log('selected')),
    ]),
    MenuItem.Custom("Első mefnüpont", "fad fa-crow", ()=>console.log('selected')),
    MenuItem.Custom("Első menüpont", "fad fa-crow", ()=>console.log('selected')),
    MenuItem.Menu("Második menüpont", "fad fa-crow", [
        MenuItem.Custom("Első aa menüpont", "fad fa-crow", ()=>console.log('selected')),
        MenuItem.Custom("Második al menüpont", "fad fa-crow", ()=>console.log('selected')),
        MenuItem.Custom("Első al menüpont", "fad fa-crow", ()=>console.log('selected')),
        MenuItem.Custom("Első al menüpont", "fad fa-crow", ()=>console.log('selected')),
        MenuItem.Custom("Második al menüpont", "fad fa-crow", ()=>console.log('selected')),
    ]),
    MenuItem.Menu("Második menüpont", "fad fa-crow", [
        MenuItem.Custom("Első al menüpont", "fad fa-crow", ()=>console.log('selected')),
        MenuItem.Custom("Második al menüpont", "fad fa-crow", ()=>console.log('selected')),
    ]),
];

export default menu;