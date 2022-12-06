export default class PetImageResource {
    constructor(image) {
        this.image = image;
    }

    getFileName() {
        return this.image.filename;
    }
}
