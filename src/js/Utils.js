class Utils {
    constructor() {
        this.version = '0.1';
    }

    static getVersion(){
        let version = '0.1';
        return "<p class='alert alert-secondary'>Version: " + version + "</p>"
    }
}

export {Utils}