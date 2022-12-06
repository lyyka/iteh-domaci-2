export default class PetTypeResource {
    constructor(petType) {
        this.petType = petType;
    }

    getValue() {
        return this.petType;
    }

    getLabel() {
        return this.petType.charAt(0).toUpperCase() + this.petType.slice(1);
    }
}
