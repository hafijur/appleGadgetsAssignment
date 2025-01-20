import axios from 'axios';

// Fetch the base URL from the environment variables
const apiBaseUrl = 'http://localhost:8000/api';

// Create an axios instance with the base URL
const api = axios.create({
    baseURL: apiBaseUrl,
});

export async function fetchSuppliers(name = '', page = 1, limit = 10) {
    try {
        const response = await api.get(`/suppliers?page=${page}&limit=${limit}`);
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
