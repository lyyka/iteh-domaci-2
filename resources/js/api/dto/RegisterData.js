export default class RegisterData {
    constructor(
        name,
        email,
        password
    ) {
        this._name = name;
        this._email = email;
        this._password = password;
    }

    toRequest() {
        return {
            name: this.name,
            email: this.email,
            password: this.password,
        }
    }

    get name() {
        return this._name;
    }

    get email() {
        return this._email;
    }

    get password() {
        return this._password;
    }
}
