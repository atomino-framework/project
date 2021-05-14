import MenuItem from "magic/src/modules/menu-item";
import {articleList} from "./article";
import {userList} from "./user";

let menu = [

    MenuItem.List("Articles", "far fa-newspaper", articleList).activate(),
    MenuItem.List("Users", "fas fa-users", userList),

    /*MenuItem.Page("Books", "fad fa-users", articleForm, 54437).activate(),
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
    ]),*/
];

export default menu;