import axios from 'axios';

class RssService {
    constructor() {
        this.api = axios.create({
            baseURL: '/api', // 기본 API URL
        });
    }

    async getRss() {
        try {
            const response = await this.api.get(`/rss-fetch`) // Laravel Api Route
            return response.data;
        } catch ( error ) {
            console.log('Axios error : ',error);
            return [];
        }
    }

}

export default new RssService();
