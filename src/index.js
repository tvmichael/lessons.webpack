import {ConsoleTool} from "./utils/ConsoleTool";
import 'bootstrap/dist/css/bootstrap.min.css';
import './style.css';

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
    }
}

let wp = new WebpackLessons(document.getElementById('container'));
wp.init();