import React from 'react';

const FetchNewsButton = ({ onClick }) => {
    return (
        <button className="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600" onClick={onClick}>
            갱신
        </button>
    );
};

export default FetchNewsButton;
