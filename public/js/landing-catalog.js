/**
 * Landing Page Catalog API Integration
 * 
 * This file contains functions to fetch and display catalog data
 * from the public API endpoints.
 */

const API_BASE_URL = '/api/public';

/**
 * Fetch categories from API
 */
async function fetchCategories(params = {}) {
    try {
        const queryString = new URLSearchParams(params).toString();
        const url = `${API_BASE_URL}/categories${queryString ? '?' + queryString : ''}`;
        
        const response = await fetch(url);
        const data = await response.json();
        
        if (data.success) {
            return data;
        } else {
            throw new Error('Failed to fetch categories');
        }
    } catch (error) {
        console.error('Error fetching categories:', error);
        return null;
    }
}

/**
 * Fetch single category by ID
 */
async function fetchCategory(id) {
    try {
        const response = await fetch(`${API_BASE_URL}/categories/${id}`);
        const data = await response.json();
        
        if (data.success) {
            return data.data;
        } else {
            throw new Error('Category not found');
        }
    } catch (error) {
        console.error('Error fetching category:', error);
        return null;
    }
}

/**
 * Fetch subcategories from API
 */
async function fetchSubCategories(params = {}) {
    try {
        const queryString = new URLSearchParams(params).toString();
        const url = `${API_BASE_URL}/subcategories${queryString ? '?' + queryString : ''}`;
        
        const response = await fetch(url);
        const data = await response.json();
        
        if (data.success) {
            return data;
        } else {
            throw new Error('Failed to fetch subcategories');
        }
    } catch (error) {
        console.error('Error fetching subcategories:', error);
        return null;
    }
}

/**
 * Fetch products from API
 */
async function fetchProducts(params = {}) {
    try {
        const queryString = new URLSearchParams(params).toString();
        const url = `${API_BASE_URL}/products${queryString ? '?' + queryString : ''}`;
        
        const response = await fetch(url);
        const data = await response.json();
        
        if (data.success) {
            return data;
        } else {
            throw new Error('Failed to fetch products');
        }
    } catch (error) {
        console.error('Error fetching products:', error);
        return null;
    }
}

/**
 * Fetch single product by ID
 */
async function fetchProduct(id) {
    try {
        const response = await fetch(`${API_BASE_URL}/products/${id}`);
        const data = await response.json();
        
        if (data.success) {
            return data.data;
        } else {
            throw new Error('Product not found');
        }
    } catch (error) {
        console.error('Error fetching product:', error);
        return null;
    }
}

/**
 * Render categories in the DOM
 */
function renderCategories(categories, containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;
    
    container.innerHTML = '';
    
    categories.forEach(category => {
        const categoryCard = `
            <div class="category-card" data-category-id="${category.id}">
                <h3>${category.name}</h3>
                <p>${category.description || ''}</p>
            </div>
        `;
        container.innerHTML += categoryCard;
    });
}

/**
 * Render products in the DOM
 */
function renderProducts(products, containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;
    
    container.innerHTML = '';
    
    products.forEach(product => {
        const productCard = `
            <div class="product-card" data-product-id="${product.id}">
                ${product.main_image ? `<img src="${product.main_image}" alt="${product.name}">` : ''}
                <h4>${product.name}</h4>
                <p>${product.description ? product.description.substring(0, 100) + '...' : ''}</p>
                <span class="category-badge">${product.category.name}</span>
                ${product.subcategory ? `<span class="subcategory-badge">${product.subcategory.name}</span>` : ''}
            </div>
        `;
        container.innerHTML += productCard;
    });
}

/**
 * Render pagination controls
 */
function renderPagination(pagination, containerId, onPageChange) {
    const container = document.getElementById(containerId);
    if (!container) return;
    
    container.innerHTML = '';
    
    const { current_page, last_page } = pagination;
    
    // Previous button
    if (current_page > 1) {
        const prevBtn = document.createElement('button');
        prevBtn.textContent = 'Previous';
        prevBtn.onclick = () => onPageChange(current_page - 1);
        container.appendChild(prevBtn);
    }
    
    // Page numbers
    for (let i = 1; i <= last_page; i++) {
        const pageBtn = document.createElement('button');
        pageBtn.textContent = i;
        pageBtn.className = i === current_page ? 'active' : '';
        pageBtn.onclick = () => onPageChange(i);
        container.appendChild(pageBtn);
    }
    
    // Next button
    if (current_page < last_page) {
        const nextBtn = document.createElement('button');
        nextBtn.textContent = 'Next';
        nextBtn.onclick = () => onPageChange(current_page + 1);
        container.appendChild(nextBtn);
    }
}

/**
 * Example: Load and display products on page load
 */
document.addEventListener('DOMContentLoaded', async function() {
    // Example: Load all categories
    const categoriesData = await fetchCategories({ per_page: 10 });
    if (categoriesData) {
        console.log('Categories:', categoriesData.data);
        // renderCategories(categoriesData.data, 'categories-container');
    }
    
    // Example: Load products
    const productsData = await fetchProducts({ per_page: 12 });
    if (productsData) {
        console.log('Products:', productsData.data);
        // renderProducts(productsData.data, 'products-container');
        // renderPagination(productsData.pagination, 'pagination-container', loadProductsPage);
    }
});

/**
 * Example: Load products by page
 */
async function loadProductsPage(page) {
    const productsData = await fetchProducts({ per_page: 12, page: page });
    if (productsData) {
        renderProducts(productsData.data, 'products-container');
        renderPagination(productsData.pagination, 'pagination-container', loadProductsPage);
    }
}

/**
 * Example: Filter products by category
 */
async function filterProductsByCategory(categoryId) {
    const productsData = await fetchProducts({ 
        category_id: categoryId,
        per_page: 12 
    });
    
    if (productsData) {
        renderProducts(productsData.data, 'products-container');
        renderPagination(productsData.pagination, 'pagination-container', (page) => {
            fetchProducts({ 
                category_id: categoryId,
                per_page: 12,
                page: page 
            }).then(data => {
                if (data) {
                    renderProducts(data.data, 'products-container');
                    renderPagination(data.pagination, 'pagination-container', loadProductsPage);
                }
            });
        });
    }
}

/**
 * Example: Search products
 */
async function searchProducts(searchTerm) {
    const productsData = await fetchProducts({ 
        search: searchTerm,
        per_page: 12 
    });
    
    if (productsData) {
        renderProducts(productsData.data, 'products-container');
        renderPagination(productsData.pagination, 'pagination-container', loadProductsPage);
    }
}
