<template>
    <router-link :to="`/providers/${provider.id}`">
        <div class="card">
            <img alt="logo" :src="provider.logo_url" :loading="index < 3 ? 'eager' : 'lazy'"  />
            <h3>{{ provider.name }}</h3>
            <p>{{ truncatedDescription }}</p>
            <small>{{ provider.category_name }}</small>
        </div>
    </router-link>
</template>

<script>
export default {
    props: ['provider', 'index'],
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
