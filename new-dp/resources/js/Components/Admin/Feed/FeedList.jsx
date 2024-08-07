// components/FeedList.jsx
import React from 'react';
import Feed from './Feed.jsx';

const FeedList = ({ feeds }) => {
    return (
        <ul className="space-y-4">
            {feeds.length > 0 ? (
                feeds.map(feed => <Feed key={feed.id} feed={feed} />)
            ) : (
                <div className="text-center text-gray-600">No data available</div>
            )}
        </ul>
    );
};

export default FeedList;
