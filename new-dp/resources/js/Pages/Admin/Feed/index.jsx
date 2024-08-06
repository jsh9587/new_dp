import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import React, { useState, useEffect } from 'react';
import FeedService from '@/Services/Feed/FeedService';
import RssService from "@/Services/Feed/RssService";
import NewsList from '@/Components/Admin/Feed/NewsList'; // Existing NewsList component
import FetchNewsButton from "@/Components/Admin/Feed/FetchNewsButton";
import InputSnsButton from "@/Components/Admin/Feed/InputSnsButton";
import { Inertia } from '@inertiajs/inertia';


export default function FeedIndexPage({ auth }) {
    const [feeds, setFeeds] = useState([]);
    const [loading, setLoading] = useState(true); // 로딩 상태 관리

    useEffect(() => {
        // Component did mount logic
        listData();
    }, []);

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
                        <div className="flex gap-10 bg-gray-100">
                            {/* News Section */}
                            <div className="w-1/2 p-4 bg-white max-h-screen overflow-y-auto">
                                <div className="flex items-center justify-between mb-4">
                                    <h3 className="text-2xl font-bold">News</h3>
                                    <FetchNewsButton onClick={handleFetchNews}/>
                                </div>
                                {loading ? (
                                    <div className="text-center text-gray-600">Loading...</div>
                                ) : (
                                    <NewsList feeds={newsFeeds}/>
                                )}
                            </div>

                            {/* SNS Section */}
                            <div className="w-1/2 p-4 bg-white max-h-screen overflow-y-auto">
                                <div className="flex items-center justify-between mb-4">
                                    <h3 className="text-2xl font-bold">SNS</h3>
                                    <InputSnsButton onClick={handleSnsStore}/>
                                </div>
                                {loading ? (
                                    <div className="text-center text-gray-600">Loading...</div>
                                ) : (
                                    <ul className="space-y-4">
                                        {snsFeeds.length > 0 ? (
                                            snsFeeds.map(feed => (
                                                <li key={feed.id}
                                                    className="border border-gray-300 rounded-lg p-4 shadow-md">
                                                    <h4 className="text-xl font-semibold mb-2">{feed.title}</h4>
                                                    <div
                                                        className="text-gray-700 mb-4"
                                                        dangerouslySetInnerHTML={{__html: feed.content}}
                                                    />
                                                    <a
                                                        href={`/Admin/Feed/${feed.id}`}
                                                        className="text-blue-500 hover:underline"
                                                        target="_blank"
                                                        rel="noopener noreferrer"
                                                    >
                                                        Read more
                                                    </a>
                                                </li>
                                            ))
                                        ) : (
                                            <div className="text-center text-gray-600">No SNS data available</div>
                                        )}
                                    </ul>
                                )}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
