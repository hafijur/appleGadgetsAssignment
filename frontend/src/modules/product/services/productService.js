import axios from 'axios';

// Fetch the base URL from the environment variables
const apiBaseUrl = import.meta.env.VITE_API_BASE_URL;

// Create an axios instance with the base URL
const api = axios.create({
    baseURL: apiBaseUrl,
    headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${localStorage.getItem('authToken')}`,
    },
});

export const fetchProducts = async (page = 1, limit = 10, filters = {}) => {
    try {
        const response = await api.get(`/products`, {
            params: {
                page,
                limit,
                ...filters,
            },
        }); // Adjust the API endpoint if needed
        return response.data;
    } catch (error) {
        throw error;
    }
};

export const createProduct = async (newProduct) => {
    try {
        const response = await api.post('/products', newProduct); // Adjust the API endpoint if needed
        return response.data;
    } catch (error) {
        console.error('Error creating product:', error);
        throw error;
    }
};

export const deleteProduct = async (productId) => {
    try {
        const response = await api.delete(`/products/${productId}`);
        return response.data;
    } catch (error) {
        throw error;
    }
};

export const updateProduct = async (productId, updatedProduct) => {
    try {
        const response = await api.put(`/products/${productId}`, updatedProduct);
        return response.data;
    } catch (error) {
        throw error;
    }
};

// fetch categories
export const fetchCategories = async (filters = {}) => {
    try {
        const response = await api.get('/products/categories',
            { params: filters });
        return response.data;
    } catch (error) {
        throw error;
    }
};
