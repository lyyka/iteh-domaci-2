export default class LoginData {
    constructor(
        email,
        password
    ) {
        this._email = email;
        this._password = password;
    }

    toRequest() {
        return {
            email: this.email,
            password: this.password,
        }
    }

    get email() {
        return this._email;
    }

    get password() {
        return this._password;
    }
}
