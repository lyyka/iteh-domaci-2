export default class UnsplashImage {
    constructor(imageObj) {
        this.imageObj = imageObj;
    }

    getDescription() {
        return this.imageObj.description;
    }

    getSrc() {
        return this.imageObj.urls.small;
    }

    getId() {
        return this.imageObj.id;
    }
}
