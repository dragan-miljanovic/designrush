<template>
    <router-link :to="`/providers/${provider.id}`" class="block group">
        <div class="bg-white rounded-lg shadow p-4 hover:shadow-md transition">
            <img
                :src="provider.logo_url"
                :alt="provider.name + ' logo'"
                :loading="index < 3 ? 'eager' : 'lazy'"
                class="w-full h-40 object-contain mb-4"
            />
            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600">
                {{ provider.name }}
            </h3>
            <p class="text-sm text-gray-600 mt-1 line-clamp-3">
                {{ truncatedDescription }}
            </p>
            <small class="text-xs text-gray-500 mt-2 block">
                {{ provider.category_name }}
            </small>
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
