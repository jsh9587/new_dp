class FeedService {
    constructor() {
        this.api = axios.create({
            baseURL: '/api', // 기본 API URL
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        });
    }

    async getFeeds() {
        try {
            const response = await this.api.get('/feeds');
            return response.data;
        } catch (error) {
            console.log('Axios error:', error);
            return [];
        }
    }

    async getFeed(id) {
        try {
            const response = await this.api.get(`/feeds/${id}`);
            return response.data;
        } catch (error) {
            console.log('Axios error:', error);
            return null;
        }
    }

    async lastFetchFeed() {
        try {
            const response = await this.api.get('/lastFetchFeed');
            return response.data;
        } catch (error) {
            console.log('Axios error:', error.response ? error.response.data : error.message);
            return null;
        }
    }

    async createFeed(feedData) {
        try {
            const response = await this.api.post('/feed/store', feedData);
            return response.data;
        } catch (error) {
            console.log('Axios error:', error.response ? error.response.data : error.message);
            throw error; // 추가적으로 에러를 상위로 던질 수 있음
        }
    }
}

export default new FeedService();
