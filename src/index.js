import {Utils} from "./js/Utils";
import "./css/main.css";

document.addEventListener('DOMContentLoaded', function () {
    let d = document.createElement('div');
    d.innerHTML = Utils.getVersion();

    document.getElementById('container').appendChild(d);
});