import PetImageResource from "./PetImageResource";

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

    getImages() {
        const images = this.pet.images;

        return images.map(o => new PetImageResource(o));
    }

    getFirstImage() {
        const all = this.getImages();

        if (all.length > 0) {
            return all[0];
        }

        return null;
    }

    getDateOfBirth() {
        return this.pet.date_of_birth;
    }
}
