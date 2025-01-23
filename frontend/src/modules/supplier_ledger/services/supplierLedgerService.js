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

export const fetchLedgers = async (page = 1, params = {}) => {
    try {

        const response = await api.get(`/supplier-ledgers`, {
            params: {
                page,
                ...params,
            },
        });
        return response.data;
    } catch (error) {
        console.error("Error fetching supplier ledger:", error);
        throw error;
    }
};

export const createLedger = async (ledger) => {
    try {
        const response = await api.post('/supplier-ledgers', ledger);
        return response.data;
    } catch (error) {
        console.error("Error creating supplier ledger:", error);
        throw error;
    }
}

