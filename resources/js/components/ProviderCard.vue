<template>
    <router-link :to="`/providers/${provider.id}`">
        <div class="card">
            <img :src="provider.logo_url" alt="logo" loading="lazy" />
            <h3>{{ provider.name }}</h3>
            <p>{{ truncatedDescription }}</p>
            <small>{{ provider.category.name }}</small>
        </div>
    </router-link>
</template>

<script>
export default {
    props: ['provider'],
    computed: {
        truncatedDescription() {
            const desc = this.provider.description || '';
            if (desc.length > 100) {
                return desc.substring(0, 100) + '...';
            }
            return desc;
        }
    }
};
</script>
