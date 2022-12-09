export default class PetUpdateData {
    constructor(
        pet_id,
        name,
        type,
        colors,
        date_of_birth,
        image
    ) {
        this._pet_id = pet_id;
        this._name = name;
        this._type = type;
        this._colors = colors;
        this._date_of_birth = date_of_birth;
        this._image = image;
    }

    get pet_id() {
        return this._pet_id;
    }

    get name() {
        return this._name;
    }

    get type() {
        return this._type;
    }

    get colors() {
        return this._colors;
    }

    get date_of_birth() {
        return this._date_of_birth;
    }

    get image() {
        return this._image;
    }
}
