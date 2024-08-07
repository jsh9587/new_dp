import axios from 'axios';

class FeedService {
    constructor() {
        this.api = axios.create({
            baseURL: '/api', // 기본 API URL
        });
    }

    async getFeeds() {
        try {
            const response = await this.api.get(`/feeds`) // Laravel Api Route
            return response.data;
        } catch ( error ) {
            console.log('Axios error : ',error);
            return [];
        }
    }

    async getFeed(id) {
        try{
            const response = await this.api.get(`/feeds/${id}`);
            return response.data;
        } catch ( error ) {
            console.log('Axios error : ',error);
            return null;
        }
    }
    async lastFetchFeed(){
        try {
            const response = await this.api.get('/lastFetchFeed');
            return response.data;
        } catch (error) {
            console.log('Axios error:', error.response ? error.response.data : error.message);
            return null;
        }
    }
    async createFeed(feedData) {
        const response = await this.api.post('/feed/store', feedData);
        return response.data;
    }


}

export default new FeedService();
