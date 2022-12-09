export default class UpdateUserData {
    constructor(
        name,
        email
    ) {
        this._name = name;
        this._email = email;
    }

    toRequest() {
        return {
            name: this.name,
            email: this.email,
        }
    }

    get name() {
        return this._name;
    }

    get email() {
        return this._email;
    }
}
