import PetResource from "@/api/dto/PetResource";

export default class UserProfile {
    constructor(userResource) {
        this.userResource = userResource;
    }

    getUsername() {
        return this.userResource.username;
    }

    getPets() {
        const pets = this.userResource.pets;

        return pets.map(o => new PetResource(o));
    }
}
