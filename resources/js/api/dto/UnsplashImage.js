export default class UnsplashImage {
    constructor(imageObj) {
        this.imageObj = imageObj;
    }

    getImageUrl() {
        return this.imageObj.links.html;
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
