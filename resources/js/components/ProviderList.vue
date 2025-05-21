<template>
    <div>
        <select v-model="selectedCategory" @change="fetchProviders(1)">
            <option value="">All</option>
            <option v-for="cat in categories" :key="cat.id" :value="cat.id">
                {{ cat.name }}
            </option>
        </select>

        <div class="grid">
            <ProviderCard v-for="p in providers" :key="p.id" :provider="p" />
        </div>

        <!-- Pagination Controls -->
        <div class="pagination" v-if="lastPage > 1">
            <button :disabled="page === 1" @click="fetchProviders(page - 1)">Prev</button>
            <span>Page {{ page }} of {{ lastPage }}</span>
            <button :disabled="page === lastPage" @click="fetchProviders(page + 1)">Next</button>
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
        this.fetchCategories();
        this.fetchProviders();
    },
    methods: {
        async fetchProviders(page = 1) {
            const res = await axios.get('/api/providers', {
                params: {
                    category_id: this.selectedCategory,
                    page: page,
                },
            });

            this.providers = res.data.data || res.data; // adapt based on response
            this.page = res.data.current_page || 1;
            this.lastPage = res.data.last_page || 1;
        },
        async fetchCategories() {
            const res = await axios.get('/api/categories');
            this.categories = res.data;
        },
    },
};
</script>
