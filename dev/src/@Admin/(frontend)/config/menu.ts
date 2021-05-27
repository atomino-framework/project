import MenuItem from "magic/src/modules/menu-item";
import {userList} from "./user";

let menu = [
    MenuItem.List("Users", "fas fa-users", userList).activate(),
];

export default menu;