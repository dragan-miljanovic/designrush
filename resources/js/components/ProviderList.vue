<template>
    <div class="p-6 space-y-6">
        <div>
            <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
            <select id="category"
                v-model="selectedCategory"
                @change="fetchProviders(1)"
                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">All</option>
                <option v-for="cat in categories" :key="cat.id" :value="cat.id">
                    {{ cat.name }}
                </option>
            </select>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <ProviderCard
                v-for="(p, index) in providers"
                :key="p.id"
                :provider="p"
                :index="index"
            />
        </div>

        <!-- Pagination Controls -->
        <div class="flex justify-between items-center mt-6" v-if="lastPage > 1">
            <button class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 disabled:opacity-50"
                :disabled="page === 1"
                @click="fetchProviders(page - 1)">
                Prev
            </button>

            <span class="text-sm text-gray-700">Page {{ page }} of {{ lastPage }}</span>

            <button class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 disabled:opacity-50"
                :disabled="page === lastPage"
                @click="fetchProviders(page + 1)">
                Next
            </button>
        </div>
    </div>

</template>

<script>
import axios from 'axios';
import ProviderCard from './ProviderCard.vue';

export default {
    components: { ProviderCard },
    data() {
        return {
            providers: [],
            categories: [],
            selectedCategory: '',
            page: 1,
            lastPage: 1,
        };
    },
    mounted() {
        this.selectedCategory = this.$route.query.category_id || '';
        this.page = parseInt(this.$route.query.page) || 1;

        this.fetchCategories();
        this.fetchProviders(this.page);
    },
    methods: {
        async fetchProviders(page = 1) {
            this.page = page;

            // Update URL query params
            this.$router.replace({
                query: {
                    category_id: this.selectedCategory || undefined,
                    page: this.page !== 1 ? this.page : undefined,
                },
            });

            const res = await axios.get('/api/providers', {
                params: {
                    category_id: this.selectedCategory,
                    page: this.page,
                },
            });

            this.providers = res.data.data;
            this.page = res.data.meta.current_page || 1;
            this.lastPage = res.data.meta.last_page || 1;

            window.scrollTo({ top: 0, behavior: 'smooth' });
        },
        async fetchCategories() {
            const res = await axios.get('/api/categories');
            this.categories = res.data.data;
        },
    },
};
</script>
