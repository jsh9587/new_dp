import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import React, { useState, useEffect } from 'react';
import FeedService from '@/Services/Feed/FeedService';

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

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Feed</h2>}
        >
            <Head title="Feed" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            {loading ? (
                                <div className="text-center text-gray-600">Loading...</div>
                            ) : (
                                <div>
                                    {feeds.length > 0 ? (
                                        <ul className="space-y-4">
                                            {feeds.map((feed) => (
                                                <li key={feed.id} className="border border-gray-300 rounded-lg p-4 shadow-md">
                                                    <h3 className="text-xl font-semibold mb-2">{feed.title}</h3>
                                                    <div
                                                        className="text-gray-700 mb-4"
                                                        dangerouslySetInnerHTML={{ __html: feed.content }}
                                                    />
                                                    <a
                                                        href={feed.media_url}
                                                        className="text-blue-500 hover:underline"
                                                        target="_blank"
                                                        rel="noopener noreferrer"
                                                    >
                                                        Read more
                                                    </a>
                                                </li>
                                            ))}
                                        </ul>
                                    ) : (
                                        <div className="text-center text-gray-600">No data available</div>
                                    )}
                                </div>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
