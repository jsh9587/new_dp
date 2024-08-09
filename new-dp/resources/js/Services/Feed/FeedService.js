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
            return await this.api.post('/feed/store', feedData);
        } catch (error) {
            if (error.response) {
                if (error.response.status === 409) {
                    console.error('Conflict error:', error.response.data);
                    // 사용자에게 충돌 오류를 알리는 코드 추가
                } else {
                    console.error('Error response data:', error.response.data);
                }
            } else if (error.request) {
                console.error('Error request:', error.request);
            } else {
                console.error('Error message:', error.message);
            }
            throw error; // 오류를 상위로 던짐
        }
    }

}

export default new FeedService();
