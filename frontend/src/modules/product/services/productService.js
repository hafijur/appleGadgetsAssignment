import axios from 'axios';

// Fetch the base URL from the environment variables
const apiBaseUrl = import.meta.env.VITE_API_BASE_URL;

// Create an axios instance with the base URL
const api = axios.create({
    baseURL: apiBaseUrl,
});

export const fetchProducts = async (page = 1, limit = 10) => {
    try {
        const response = await api.get(`/products?page=${page}&limit=${limit}`); // Adjust the API endpoint if needed
        console.log('response:', response.data);
        return response.data;
    } catch (error) {
        console.error('Error fetching products:', error);
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
        console.error('Error deleting product:', error);
        throw error;
    }
};

export const updateProduct = async (productId, updatedProduct) => {
    try {
        console.log('productId:', productId);
        const response = await api.put(`/products/${productId}`, updatedProduct);
        return response.data;
    } catch (error) {
        console.error('Error updating product:', error);
        throw error;
    }
};
