import axios from 'axios';

class FeedService {
    constructor() {
        this.api = axios.create({
            baseURL: '/api', // 기본 API URL
        });
    }

    async getFeeds() {
        try {
            const response = await this.api.get('/feeds') // Laravel Api Route
            return response.data;
        } catch ( error ) {
            console.log('Axios error : ',error);
            return [];
        }
    }

}

export default new FeedService();
