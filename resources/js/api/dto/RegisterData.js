export default class RegisterData {
    constructor(
        name,
        username,
        email,
        password
    ) {
        this._name = name;
        this._username = username;
        this._email = email;
        this._password = password;
    }

    toRequest() {
        return {
            name: this.name,
            username: this.username,
            email: this.email,
            password: this.password,
        }
    }

    get name() {
        return this._name;
    }

    get username() {
        return this._username;
    }

    get email() {
        return this._email;
    }

    get password() {
        return this._password;
    }
}
