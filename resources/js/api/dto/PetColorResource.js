export default class PetTypeResource {
    constructor(petColor) {
        this.petColor = petColor;
    }

    getValue() {
        return this.petColor;
    }

    getLabel() {
        return this.petColor.charAt(0).toUpperCase() + this.petColor.slice(1);
    }
}
