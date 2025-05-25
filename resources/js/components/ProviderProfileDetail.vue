<template>
    <div class="max-w-5xl mx-auto px-4 py-8">
        <!-- Sidebar / Back Button -->
        <div class="mb-6">
            <!-- Back Button -->
            <button
                @click="goBackWithQuery"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-700 hover:bg-gray-800 rounded-md transition"
            >
                ← Back
            </button>

        </div>

        <!-- Provider Profile -->
        <div v-if="provider" class="bg-white shadow rounded-lg p-6 space-y-4">
            <img
                :src="provider.logo_url"
                alt="logo"
                loading="lazy"
                class="w-24 h-24 rounded-full object-cover border border-gray-300"
            />
            <h1 class="text-2xl font-bold text-gray-900">{{ provider.name }}</h1>
            <p class="text-gray-700 leading-relaxed">{{ provider.description }}</p>
            <p class="text-sm text-gray-600">
                <strong class="font-semibold">Category:</strong> {{ provider.category_name }}
            </p>
        </div>

        <!-- Loading State -->
        <div v-else class="text-gray-500 italic">Loading provider info...</div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            provider: null,
            error: null,
        };
    },
    methods: {
        goBackWithQuery() {
            const query = this.$route.query;
            this.$router.push({ name: 'provider-list', query });
        },
    },
    async created() {
        const id = this.$route.params.id;
        try {
            const res = await axios.get(`/api/providers/${id}`);
            this.provider = res.data.data;
        } catch (e) {
            this.error = 'Failed to load provider data.';
            console.error(e);
        }
    },
};
</script>
