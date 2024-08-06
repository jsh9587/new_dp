import React, { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';
import { Head } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

export default function FeedStorePage({ auth }) {
    const [formData, setFormData] = useState({
        type: '',
        title: '',
        slug: '',
        content: '',
        media_url: '',
    });

    const handleChange = (e) => {
        setFormData({
            ...formData,
            [e.target.id]: e.target.value,
        });
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        Inertia.post('/admin/feeds', formData);
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Create Feed</h2>}
        >
            <Head title="Create Feed" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div className="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <section className="max-w-xl">
                            <header>
                                <h2 className="text-lg font-medium text-gray-900">Create New Feed</h2>
                                <p className="mt-1 text-sm text-gray-600">
                                    Fill in the details below to create a new feed.
                                </p>
                            </header>
                            <form onSubmit={handleSubmit} className="mt-6 space-y-6">
                                <div>
                                    <label htmlFor="type" className="block font-medium text-sm text-gray-700">
                                        Type
                                    </label>
                                    <input
                                        id="type"
                                        type="text"
                                        required
                                        value={formData.type}
                                        onChange={handleChange}
                                        className="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                    />
                                </div>
                                <div>
                                    <label htmlFor="title" className="block font-medium text-sm text-gray-700">
                                        Title
                                    </label>
                                    <input
                                        id="title"
                                        type="text"
                                        required
                                        value={formData.title}
                                        onChange={handleChange}
                                        className="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                    />
                                </div>
                                <div>
                                    <label htmlFor="slug" className="block font-medium text-sm text-gray-700">
                                        Slug
                                    </label>
                                    <input
                                        id="slug"
                                        type="text"
                                        value={formData.slug}
                                        onChange={handleChange}
                                        className="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                    />
                                </div>
                                <div>
                                    <label htmlFor="content" className="block font-medium text-sm text-gray-700">
                                        Content
                                    </label>
                                    <textarea
                                        id="content"
                                        rows="4"
                                        value={formData.content}
                                        onChange={handleChange}
                                        className="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                    />
                                </div>
                                <div>
                                    <label htmlFor="media_url" className="block font-medium text-sm text-gray-700">
                                        Media URL
                                    </label>
                                    <input
                                        id="media_url"
                                        type="text"
                                        value={formData.media_url}
                                        onChange={handleChange}
                                        className="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                    />
                                </div>
                                <div className="flex items-center gap-4">
                                    <button
                                        type="submit"
                                        className="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    >
                                        Save
                                    </button>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
