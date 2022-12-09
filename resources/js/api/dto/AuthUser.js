export default class AuthUser {
    constructor(userResource) {
        this.userResource = userResource;
    }

    getId() {
        return this.userResource.id;
    }

    getName() {
        return this.userResource.name;
    }

    getEmail() {
        return this.userResource.email;
    }
}
