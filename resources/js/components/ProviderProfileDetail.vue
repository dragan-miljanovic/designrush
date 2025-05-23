<template>
    <div class="profile-wrapper">
        <div class="profile-sidebar">
            <button @click="$router.back()" class="back-button">← Back</button>
        </div>

        <div v-if="provider" class="profile">
            <img
                :src="provider.logo_url"
                alt="logo"
                loading="lazy"
                class="profile-logo"
            />
            <h1>{{ provider.name }}</h1>
            <p>{{ provider.description }}</p>
            <p><strong>Category:</strong> {{ provider.category_name}}</p>
        </div>

        <div v-else class="loading">Loading provider info...</div>
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
