<!-- src/components/NavBar.vue -->
<template>
    <nav class="bg-white shadow p-4 border-b border-gray-200 flex space-x-4">
        <RouterLink to="/" class="text-gray-700 hover:text-black font-medium"
            active-class="text-black font-semibold">Home</RouterLink>
        <RouterLink to="/providers" class="text-gray-700 hover:text-black font-medium"
            active-class="text-black font-semibold">Providers</RouterLink>
    </nav>
</template>

<script>
export default {
    name: 'NavBar'
}
</script>
