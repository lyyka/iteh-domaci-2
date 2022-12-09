import UnsplashImage from "@/api/dto/UnsplashImage";

export default {
    search: async (query, page = 1, perPage = 10) => {
        const route = window.appConfig.api.unsplashPhotoSearch;
        let res = await window.axios.get(
            `${route}?search=${query}&page=${page}&per_page=${perPage}`,
        );

        console.log(res);

        const images = res.data.results.map(image => {
            return new UnsplashImage(image);
        });

        return {
            images: images,
        }
    },
};
