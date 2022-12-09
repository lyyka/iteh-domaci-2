export default class PaginatedResource {
    constructor(resources, meta) {
        this.resources = resources;
        this.currentPage = meta.current_page;
        this.lastPage = meta.last_page;
        this.perPage = meta.per_page;
        this.total = meta.total;
    }

    isStart() {
        return this.getCurrentPage() === 1;
    }

    hasMore() {
        return this.getCurrentPage() < this.getLastPage();
    }

    previous() {
        if (this.currentPage > 1) {
            this.currentPage -= 1;
        }
    }

    next() {
        if (this.hasMore()) {
            this.currentPage += 1;
        }
    }

    getResources() {
        return this.resources;
    }

    getCurrentPage() {
        return this.currentPage;
    }

    getLastPage() {
        return this.lastPage;
    }

    getPerPage() {
        return this.perPage;
    }

    getTotal() {
        return this.total;
    }
}
