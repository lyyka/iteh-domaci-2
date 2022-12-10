import PetImageResource from "./PetImageResource";
import UserProfile from "@/api/dto/UserProfile";

export default class PetResource {
    constructor(pet) {
        this.pet = pet;
    }

    getId() {
        return this.pet.id;
    }

    getName() {
        return this.pet.name;
    }

    getType() {
        return this.pet.type;
    }

    getColors() {
        return this.pet.colors;
    }

    /**
     * @returns {Array<PetImageResource>}
     */
    getImages() {
        const images = this.pet.images;

        return images.map(o => new PetImageResource(o));
    }

    /**
     * @returns {UserProfile}
     */
    getUser() {
        return new UserProfile(this.pet.user);
    }

    /**
     * @returns {PetImageResource}
     */
    getFirstImage() {
        const all = this.getImages();

        if (all.length > 0) {
            return all[0];
        }

        return null;
    }

    /**
     * @returns {null|string|*}
     */
    getDateOfBirth() {
        return this.pet.date_of_birth;
    }
}
