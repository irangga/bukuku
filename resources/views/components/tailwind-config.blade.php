{{--
|--------------------------------------------------------------------------
| Konfigurasi Tailwind CSS Design Token BUKUKU
|--------------------------------------------------------------------------
| Berisi seluruh palet warna, tipografi, spacing, dan border radius
| kustom yang diekstrak dari desain Figma BUKUKU. Digunakan bersama
| oleh seluruh layout (app, admin, guest).
|--------------------------------------------------------------------------
--}}
<script id="tailwind-config">
tailwind.config = {
    darkMode: "class",
    theme: {
        extend: {
            colors: {
                "secondary-container": "#fe6c64",
                "inverse-on-surface": "#f2f0f0",
                "on-secondary-fixed": "#410003",
                "error-container": "#ffdad6",
                "outline-variant": "#cfc4c5",
                "on-primary": "#ffffff",
                "surface-tint": "#5e5e5e",
                "primary": "#000000",
                "tertiary": "#000000",
                "surface-container-high": "#e9e8e7",
                "surface-container-low": "#f5f3f3",
                "secondary": "#ad312e",
                "outline": "#7e7576",
                "inverse-primary": "#c6c6c6",
                "surface-container-highest": "#e3e2e2",
                "surface": "#fbf9f9",
                "primary-container": "#1b1b1b",
                "secondary-fixed-dim": "#ffb3ad",
                "on-surface": "#1b1c1c",
                "surface-container-lowest": "#ffffff",
                "surface-container": "#efeded",
                "surface-variant": "#e3e2e2",
                "primary-fixed-dim": "#c6c6c6",
                "surface-dim": "#dbdad9",
                "on-surface-variant": "#4c4546",
                "tertiary-container": "#1b1b1b",
                "on-tertiary-container": "#848484",
                "on-tertiary": "#ffffff",
                "primary-fixed": "#e2e2e2",
                "tertiary-fixed": "#e2e2e2",
                "on-primary-fixed": "#1b1b1b",
                "on-secondary": "#ffffff",
                "on-background": "#1b1c1c",
                "background": "#fbf9f9",
                "on-primary-container": "#848484",
                "on-secondary-fixed-variant": "#8b181a",
                "on-primary-fixed-variant": "#474747",
                "secondary-fixed": "#ffdad6",
                "surface-bright": "#fbf9f9",
                "on-tertiary-fixed-variant": "#474747",
                "error": "#ba1a1a",
                "on-error": "#ffffff",
                "on-secondary-container": "#6d0009",
                "on-error-container": "#93000a",
                "inverse-surface": "#303031",
                "on-tertiary-fixed": "#1b1b1b",
                "tertiary-fixed-dim": "#c6c6c6"
            },
            borderRadius: {
                DEFAULT: "0.25rem",
                lg: "0.5rem",
                xl: "0.75rem",
                full: "9999px"
            },
            spacing: {
                "space-sm": "0.5rem",
                "margin": "1.5rem",
                "space-md": "1rem",
                "space-xl": "2rem",
                "space-xs": "0.25rem",
                "space-lg": "1.5rem",
                "gutter": "1rem"
            },
            fontFamily: {
                "body-sm": ["Inter"],
                "headline-lg-mobile": ["Inter"],
                "body-md": ["\"ui-sans-serif, -apple-system, BlinkMacSystemFont, \\\"Segoe UI\\\", Roboto, sans-serif\""],
                "headline-sm": ["Inter"],
                "label-sm": ["Inter"],
                "label-md": ["Inter"],
                "headline-lg": ["Inter"],
                "headline-md": ["Inter"],
                "label-lg": ["Inter"],
                "body-lg": ["Inter"]
            },
            fontSize: {
                "body-sm": ["14px", { lineHeight: "20px", fontWeight: "400" }],
                "headline-lg-mobile": ["26px", { lineHeight: "34px", letterSpacing: "-0.01em", fontWeight: "600" }],
                "body-md": ["16px", { lineHeight: "24px", fontWeight: "400" }],
                "headline-sm": ["20px", { lineHeight: "28px", fontWeight: "500" }],
                "label-sm": ["11px", { lineHeight: "14px", letterSpacing: "0.03em", fontWeight: "500" }],
                "label-md": ["12px", { lineHeight: "16px", letterSpacing: "0.02em", fontWeight: "500" }],
                "headline-lg": ["32px", { lineHeight: "40px", letterSpacing: "-0.02em", fontWeight: "600" }],
                "headline-md": ["24px", { lineHeight: "32px", letterSpacing: "-0.01em", fontWeight: "600" }],
                "label-lg": ["14px", { lineHeight: "20px", letterSpacing: "0.01em", fontWeight: "500" }],
                "body-lg": ["18px", { lineHeight: "26px", fontWeight: "400" }]
            }
        }
    }
};
</script>
