import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import React, { useState, useEffect } from 'react';
import FeedService from '@/Services/Feed/FeedService';

export default function FeedViewPage({ auth , id }) {
    const [feed, setFeeds] = useState(null);
    const [loading, setLoading] = useState(true); // 로딩 상태 관리

    useEffect(() => {
        // Component did mount logic
        viewData();
    }, []);

    const viewData = async () => {
        try {
            console.log({id});
            const feed = await FeedService.getFeed(id);
            console.log(feed);
            setFeeds(feed);
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
                <div className="max-w-9xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            {loading ? (
                                <div className="text-center text-gray-600">Loading...</div>
                            ) : (
                                <div>
                                    {feed.length > 0 ? (
                                        <ul className="space-y-4">
                                            {feed.map((info) => (
                                                <li key={info.id}
                                                    className="border border-gray-300 rounded-lg p-4 shadow-md">
                                                    <h3 className="text-xl font-semibold mb-2">{info.title}</h3>
                                                    <div
                                                        className="text-gray-700 mb-4"
                                                        dangerouslySetInnerHTML={{__html: info.content}}
                                                    />
                                                    <a
                                                        href={info.media_url}
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
