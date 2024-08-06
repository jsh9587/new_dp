// components/FeedList.jsx
import React from 'react';
import News from './News';

const NewsList = ({ feeds }) => {
    return (
        <ul className="space-y-4">
            {feeds.length > 0 ? (
                feeds.map(feed => <News key={feed.id} feed={feed} />)
            ) : (
                <div className="text-center text-gray-600">No data available</div>
            )}
        </ul>
    );
};

export default NewsList;
