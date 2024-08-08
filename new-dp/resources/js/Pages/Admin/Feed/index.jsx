import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import React, { useState, useEffect } from 'react';
import FeedService from '@/Services/Feed/FeedService';
import RssService from "@/Services/Feed/RssService";
import FeedList from '@/Components/Admin/Feed/FeedList.jsx'; // Existing FeedList component
import FetchNewsButton from "@/Components/Admin/Feed/FetchNewsButton";
import InputSnsButton from "@/Components/Admin/Feed/InputSnsButton";
import { Inertia } from '@inertiajs/inertia';


export default function FeedIndexPage({ auth }) {
    const [lastFeed, setLastFeed] = useState([]);
    const [feeds, setFeeds] = useState([]);
    const [loading, setLoading] = useState(true); // 로딩 상태 관리

    useEffect(() => {
        // Component did mount logic

        lastFetchFeed();
        listData();
    }, []);

    const formatDateWithTimezone = (dateString, timeZone = 'Asia/Seoul') => {
        const date = new Date(dateString);

        // Use Intl.DateTimeFormat to format the date according to the specified time zone
        const options = {
            timeZone,
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false // 24-hour time format
        };

        const formatter = new Intl.DateTimeFormat('en-GB', options); // 'en-GB' is used for date format (e.g., DD/MM/YYYY)
        const parts = formatter.formatToParts(date);

        const year = parts.find(part => part.type === 'year').value;
        const month = parts.find(part => part.type === 'month').value;
        const day = parts.find(part => part.type === 'day').value;
        const hour = parts.find(part => part.type === 'hour').value;
        const minute = parts.find(part => part.type === 'minute').value;
        const second = parts.find(part => part.type === 'second').value;

        return `${year}-${month}-${day} ${hour}:${minute}:${second}`;
    };


    const lastFetchFeed = async ()=> {
        try {
            const lastFeed = await FeedService.lastFetchFeed();
            lastFeed.updated_at = formatDateWithTimezone(lastFeed.updated_at);
            console.log(lastFeed);
            setLastFeed(lastFeed);
        } catch ( error ) {
            console.log(error);
        } finally {
            setLoading(false);
        }
    }

    const listData = async () => {
        try {
            const feeds = await FeedService.getFeeds();
            setFeeds(feeds);
        } catch (error) {
            console.log(error);
        } finally {
            setLoading(false);
        }
    };

    const handleFetchNews = async () => {
        setLoading(true); // 로딩 상태 시작
        try {
            // RSS 데이터를 가져오기
            await RssService.getRss();
            const feeds = await FeedService.getFeeds();
            setFeeds(feeds); // 상태 업데이트
        } catch (error) {
            console.log(error); // 에러 처리
        } finally {
            setLoading(false); // 로딩 상태 종료
        }
    };

    const handleSnsStore =  ()=>{
        setLoading(true);
        Inertia.visit('/Admin/Sns/Store');
    }


    // 피드를 타입별로 필터링
    const newsFeeds = feeds.filter(feed => feed.type === 'news');
    const snsFeeds = feeds.filter(feed => feed.type === 'sns');

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Feed</h2>}
        >
            <Head title="Feed"/>

            <div className="py-12">
                <div className="max-w-9xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="flex flex-col md:flex-row gap-10 bg-gray-100">
                            {/* Feed Section */}
                            <div className="w-full md:w-1/2 p-4 bg-white max-h-screen overflow-y-auto">
                                <div className="flex items-center justify-between mb-4">
                                    <h3 className="text-2xl font-bold">News&nbsp;[{lastFeed.updated_at}]</h3>
                                    <FetchNewsButton onClick={handleFetchNews}/>
                                </div>
                                {loading ? (
                                    <div className="text-center text-gray-600">Loading...</div>
                                ) : (
                                    <FeedList feeds={newsFeeds}/>
                                )}
                            </div>

                            {/* SNS Section */}
                            <div className="w-full md:w-1/2 p-4 bg-white max-h-screen overflow-y-auto">
                                <div className="flex items-center justify-between mb-4">
                                    <h3 className="text-2xl font-bold">SNS</h3>
                                    <InputSnsButton onClick={handleSnsStore}/>
                                </div>
                                {loading ? (
                                    <div className="text-center text-gray-600">Loading...</div>
                                ) : (
                                    <FeedList feeds={snsFeeds}/>
                                )}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
