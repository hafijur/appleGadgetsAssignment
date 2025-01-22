export default {

    methods: {
        showError(data) {
            if ("errors" in data) {
                const messages = Object.values(data.errors)
                    .flat()
                    .join("\n");
                this.$swal({
                    icon: "error",
                    title: "Oops..." + data.message,
                    text: messages,
                });
            } else {
                this.$swal({
                    icon: "error",
                    title: "Oops...",
                    text: data.message,
                });
            }
        },
    },
}