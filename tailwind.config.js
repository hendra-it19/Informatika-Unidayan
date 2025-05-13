/** @type {import('tailwindcss').Config} */

const defaultTheme = require("tailwindcss/defaultTheme");

export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    50: "#f3f6fc",
                    100: "#e6ecf8",
                    200: "#c8d7ef",
                    300: "#98b6e1",
                    400: "#608ed0",
                    500: "#396bb2",
                    600: "#2b579e",
                    700: "#244680",
                    800: "#213d6b",
                    900: "#213659",
                    950: "#16223b",
                },
            },
        },
    },
    plugins: [require("flowbite/plugin")],
};
