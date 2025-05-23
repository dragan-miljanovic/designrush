# ⚡️ Laravel + Vue 3 Provider App

This project is a single-page application built using **Laravel (API)** and **Vue 3 (frontend)**, optimized for performance with a focus on **Core Web Vitals**, especially **LCP (Largest Contentful Paint)** and **TTFB (Time To First Byte)**.

---

## 🚀 Performance Optimization Overview

### ✅ Frontend (Vue 3 + Vite)

#### 1. **Image Loading Strategy**
- **Lazy Load**: All provider logos use `loading="lazy"` to avoid loading offscreen images on initial render.
- **Eager Load Above-the-Fold**: The first few provider cards (`index < 3`) use `loading="eager"` to prioritize LCP.

```vue
<img
  :src="provider.logo_url"
  alt="logo"
  class="provider-logo"
  :loading="index < 3 ? 'eager' : 'lazy'" />
```

#### 2. **Critical CSS**
- Core layout and base styles (nav, grid, cards, typography) are included directly in `app.css`.
- Tailwind CSS is configured to **purge unused styles**, keeping the final CSS minimal.
- Vite compiles and injects only critical styles on first load.

#### 3. **JavaScript Optimization**
- Vite handles **code-splitting** and **minification**.
- Page components are dynamically loaded using Vue Router:

```js
const routes = [
  {
    path: '/providers',
    component: () => import('./pages/Providers.vue'),
  },
];
```

- This defers the loading of large JS chunks until needed, improving initial load time.

#### 4. **Paginated Content**
- Providers are fetched in paginated chunks to limit DOM size and avoid LCP delays from rendering all cards at once.

#### 5. **Modern Build Tools**
- `vite.config.js` is configured with `laravel-vite-plugin` and Vue plugin for optimal asset handling.
- Asset versioning and preloading are managed automatically.

---

### ✅ Backend (Laravel API)

#### 1. **Optimized API Responses**
- API returns only the required data for the current page.
- Pagination is handled using Laravel’s built-in pagination methods.

#### 2. **TTFB Improvements**
- Laravel views are compiled and cached via `storage/framework/views`.
- JSON API endpoints are lean, with no unnecessary database or logic overhead.
- Laravel route and config caching (`php artisan route:cache`) can be enabled for further speedups.

#### 3. **Vite Integration**
- Assets are served efficiently using `@vite('resources/js/main.js')` and `@vite('resources/css/app.css')`.
- Vite’s dev server offers hot module replacement in development and optimized output in production.

---

## 🧪 Metrics to Track

Use Lighthouse or PageSpeed Insights to validate:

| Metric                             | Target         |
|------------------------------------|----------------|
| **LCP (Largest Contentful Paint)** | ≤ 2.5 seconds  |
| **TTFB (Time to First Byte)**      | ≤ 200 ms       |
| **CLS (Cumulative Layout Shift)**  | < 0.1          |
| **FCP (First Contentful Paint)**   | ≤ 1.8 seconds  |

---

## 🛠️ Dev Commands

```bash
# Install dependencies
npm install
composer install

# Database migration with seeder
sh checkall.sh

# Run Vite (Dev)
npm run dev

# Run Laravel server
php artisan serve

# Build for production
npm run build
```

---
