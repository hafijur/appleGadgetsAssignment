import axios from 'axios';

// Fetch the base URL from the environment variables
const apiBaseUrl = import.meta.env.VITE_API_BASE_URL;

// Create an axios instance with the base URL
const api = axios.create({
    baseURL: apiBaseUrl,
});

export async function fetchSuppliers(page = 1, limit = 10, filters = {}) {
    try {
        const response = await api.get(`/suppliers`, {
            params: {
                page,
                limit,
                ...filters,
            },
        });
        return response.data;
    } catch (error) {
        console.error("Error fetching suppliers:", error);
        throw error;
    }
}

export async function createSupplier(supplier) {
    try {
        const response = await api.post(`/suppliers`, supplier);
        return response.data;
    } catch (error) {
        console.error("Error creating supplier:", error);
        throw error;
    }
}

export async function updateSupplier(id, supplier) {

    try {
        const response = await api.put(`/suppliers/${id}`, supplier);
        return response.data;
    } catch (error) {
        console.error("Error updating supplier:", error);
        throw error;
    }
}

export async function deleteSupplier(id) {
    try {
        await api.delete(`/suppliers/${id}`);
    } catch (error) {
        console.error("Error deleting supplier:", error);
        throw error;
    }
}
