import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],
    darkMode: "false",
    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito Sans", ...defaultTheme.fontFamily.sans],
                lobster: ["lobster"],
            },
            animation: {
                "running-image": "running-image 30s linear infinite",
                bounce: "bounce 2s infinite",
            },
            keyframes: {
                "running-image": {
                    "0%": { transform: "translateX(0)" },
                    "100%": { transform: "translateX(-100%)" },
                },
                bounce: {
                    "0%, 100%": {
                        transform: "translateY(0)",
                        animationTimingFunction: "ease-in-out",
                    },
                    "50%": {
                        transform: "translateY(20px)",
                        animationTimingFunction: "ease-in-out",
                    },
                },
            },
        },
    },

    plugins: [forms],
};
