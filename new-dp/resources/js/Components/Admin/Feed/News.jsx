import React from 'react';

const News = ({ feed }) => {
    return (
        <li key={feed.id} className="border border-gray-300 rounded-lg p-4 shadow-md">
            <h3 className="text-xl font-semibold mb-2">{feed.title}</h3>
            <div
                className="text-gray-700 mb-4"
                dangerouslySetInnerHTML={{ __html: feed.content }}
            />
            {feed.type === 'sns' && (
                <a
                    href={`/Admin/Feed/${feed.id}`}
                    className="text-blue-500 hover:underline"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    Read more
                </a>
            )}
        </li>
    );
};

export default News;
