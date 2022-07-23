export default class {
    constructor () {
        this.errors = {};
    }

    setErrors(data) {
        data.map(data => {
            this.errors[data['title']] = data['message'];
        })
    }

    reset() {
        this.errors = {};
    }

    has(field) {
        return this.errors[field] !== undefined;
    }

    get(field) {
        if (this.has(field)) {
            return this.errors[field];
        }
    }
}
