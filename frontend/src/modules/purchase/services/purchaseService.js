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

export async function fetchProductsByName(query) {
    try {
        const response = await api.get(`/products`, { params: { name: query } });
        return response.data;
    } catch (error) {
        console.error("Error searching for products:", error);
        throw error;
    }
}

export async function createPurchase(purchase) {
    try {
        const response = await api.post(`/purchases`, purchase);
        console.log("purchase response:", response.data);
        return response.data;
    } catch (error) {
        console.error("Error creating purchase:", error);
        throw error;
    }
}

export async function fetchPurchases(page = 1, limit = 10) {
    try {
        const response = await api.get(`/purchases?page=${page}&limit=${limit}`);
        return response.data;
    } catch (error) {
        console.error("Error fetching purchases:", error);
        throw error;
    }
}
