import 'bootstrap/dist/css/bootstrap.min.css';
import './style.css';
import 'jsoneditor/dist/jsoneditor.css'

import {ConsoleTool} from "./utils/ConsoleTool";
import {Tab} from 'bootstrap/js/dist/tab';
import JSONEditor from 'jsoneditor/dist/jsoneditor.min.js';


class WebpackLessons {
    constructor(element){
        this.version = '0.1';
        this.element = element;
        this.c = new ConsoleTool();
    }

    init() {
        this.c.cl(this);

        let h1 = this.element.querySelector('h1');
        h1.textContent = 'Webpack lessons. Start!';

        const container = document.getElementById("jsoneditor");
        const options = {};
        const editor = new JSONEditor(container, options);

        // set json
        const initialJson = {
            "Array": [1, 2, 3],
            "Boolean": true,
            "Null": null,
            "Number": 123,
            "Object": {"a": "b", "c": "d"},
            "String": "Hello World"
        };

        editor.set(initialJson);

        // get json
        const updatedJson = editor.get();

    }
}

let wp = new WebpackLessons(document.getElementById('container'));
wp.init();