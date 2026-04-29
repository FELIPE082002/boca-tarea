<?php
/**
 * Shared Tailwind (CDN) + design tokens aligned with judge UI mocks.
 * Include once per document; uses a static guard to avoid duplicate tags.
 */
if (!function_exists('boca_tailwind_print_head_assets')) {
	function boca_tailwind_print_head_assets() {
		static $printed = false;
		if ($printed) {
			return;
		}
		$printed = true;
		?>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&amp;display=swap" rel="stylesheet"/>
<script id="boca-tailwind-config">
tailwind.config = {
  darkMode: "class",
  theme: {
    extend: {
      colors: {
        "on-primary": "#003d88",
        "inverse-primary": "#005bc4",
        "on-background": "#dee5ff",
        "surface-container-high": "#031d4b",
        "surface-container-lowest": "#000000",
        "surface-bright": "#002867",
        "on-surface-variant": "#91aaeb",
        "inverse-on-surface": "#4d556b",
        "tertiary-fixed": "#69f6b8",
        "outline": "#5b74b1",
        "outline-variant": "#2b4680",
        "secondary-dim": "#8f9fb7",
        "error": "#ee7d77",
        "on-tertiary-fixed": "#00452d",
        "primary-fixed": "#d8e2ff",
        "primary-container": "#004395",
        "tertiary-container": "#69f6b8",
        "on-primary-fixed-variant": "#0057bd",
        "error-container": "#7f2927",
        "primary": "#adc6ff",
        "tertiary-fixed-dim": "#58e7ab",
        "on-primary-container": "#bdd0ff",
        "on-error-container": "#ff9993",
        "primary-fixed-dim": "#c3d4ff",
        "surface-container-highest": "#00225a",
        "on-secondary-container": "#b0c0da",
        "on-secondary": "#102134",
        "on-tertiary-fixed-variant": "#006544",
        "surface-dim": "#060e20",
        "on-tertiary-container": "#005a3c",
        "on-surface": "#dee5ff",
        "surface-container": "#05183c",
        "secondary-fixed-dim": "#c5d6f0",
        "secondary-fixed": "#d3e4fe",
        "surface-tint": "#adc6ff",
        "on-secondary-fixed-variant": "#4d5d73",
        "secondary": "#8f9fb7",
        "surface-variant": "#00225a",
        "tertiary-dim": "#58e7ab",
        "primary-dim": "#98b8ff",
        "inverse-surface": "#faf8ff",
        "secondary-container": "#2d3c51",
        "tertiary": "#9bffce",
        "surface-container-low": "#06122d",
        "error-dim": "#bb5551",
        "on-tertiary": "#006443",
        "background": "#060e20",
        "on-secondary-fixed": "#314055",
        "on-primary-fixed": "#003c86",
        "on-error": "#490106",
        "surface": "#060e20"
      },
      fontFamily: {
        headline: ["Inter", "ui-sans-serif", "system-ui", "sans-serif"],
        body: ["Inter", "ui-sans-serif", "system-ui", "sans-serif"],
        label: ["Inter", "ui-sans-serif", "system-ui", "sans-serif"]
      },
      borderRadius: { DEFAULT: "0.125rem", lg: "0.25rem", xl: "0.5rem", full: "0.75rem" }
    }
  }
};
</script>
<style>
.material-symbols-outlined {
  font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
  vertical-align: middle;
}
::-webkit-scrollbar { width: 6px; height: 6px; }
::-webkit-scrollbar-track { background: #060e20; }
::-webkit-scrollbar-thumb { background: #2b4680; border-radius: 10px; }
.glass-panel {
  background: rgba(0, 34, 90, 0.55);
  backdrop-filter: blur(20px);
}
.primary-gradient {
  background: linear-gradient(135deg, #adc6ff 0%, #004395 100%);
}
.tonal-layering-bg {
  background: radial-gradient(circle at 50% 50%, #05183c 0%, #060e20 100%);
}

/* --- Global typography / chrome --- */
body.boca-app-ui {
  -webkit-font-smoothing: antialiased;
  text-rendering: optimizeLegibility;
}

/* --- Data tables (BOCA uses border=1 / #myscoretable; layout forms use border=0) --- */
body.boca-app-ui :is(table[border="1"], table#myscoretable) {
  width: 100%;
  max-width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  font-size: 0.875rem;
  font-variant-numeric: tabular-nums;
  line-height: 1.45;
  background: linear-gradient(165deg, rgba(8, 28, 62, 0.92) 0%, rgba(5, 18, 44, 0.88) 100%);
  border: 1px solid rgba(43, 70, 128, 0.85);
  border-radius: 0.75rem;
  overflow: hidden;
  box-shadow:
    0 12px 40px rgba(0, 0, 0, 0.42),
    0 1px 0 rgba(173, 198, 255, 0.08) inset;
  margin: 0.75rem 0 1.5rem;
}

body.boca-app-ui :is(table[border="1"], table#myscoretable) td,
body.boca-app-ui :is(table[border="1"], table#myscoretable) th {
  border: 1px solid rgba(43, 70, 128, 0.55);
  padding: 0.625rem 0.875rem;
  color: #e8edff;
  vertical-align: middle;
}

body.boca-app-ui :is(table[border="1"], table#myscoretable) > thead > tr > th,
body.boca-app-ui :is(table[border="1"], table#myscoretable) > tr:first-child > td,
body.boca-app-ui :is(table[border="1"], table#myscoretable) > tr:first-child > th {
  background: linear-gradient(180deg, rgba(0, 58, 130, 0.98) 0%, rgba(4, 22, 52, 0.99) 100%);
  color: #c8d8ff;
  font-weight: 700;
  font-size: 0.72rem;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  border-color: rgba(91, 116, 177, 0.5);
  border-bottom: 2px solid rgba(173, 198, 255, 0.28);
  padding: 0.7rem 0.875rem;
  white-space: nowrap;
}
body.boca-app-ui :is(table[border="1"], table#myscoretable) > tr:first-child b,
body.boca-app-ui :is(table[border="1"], table#myscoretable) > thead b {
  font-weight: inherit;
  color: inherit;
}

/* Zebra + hover (skip cells that use legacy bgcolor, e.g. clar status) */
body.boca-app-ui :is(table[border="1"], table#myscoretable) > tr:nth-child(n+2):nth-child(odd) > td:not([bgcolor]),
body.boca-app-ui :is(table[border="1"], table#myscoretable) > tr:nth-child(n+2):nth-child(odd) > th:not([bgcolor]) {
  background: rgba(6, 18, 42, 0.55);
}
body.boca-app-ui :is(table[border="1"], table#myscoretable) > tr:nth-child(n+2):nth-child(even) > td:not([bgcolor]),
body.boca-app-ui :is(table[border="1"], table#myscoretable) > tr:nth-child(n+2):nth-child(even) > th:not([bgcolor]) {
  background: rgba(4, 14, 36, 0.72);
}
body.boca-app-ui :is(table[border="1"], table#myscoretable) > tr:nth-child(n+2):hover > td:not([bgcolor]),
body.boca-app-ui :is(table[border="1"], table#myscoretable) > tr:nth-child(n+2):hover > th:not([bgcolor]) {
  background: rgba(0, 67, 149, 0.42) !important;
  box-shadow: inset 0 0 0 1px rgba(173, 198, 255, 0.12);
}

body.boca-app-ui :is(table[border="1"], table#myscoretable) a {
  color: #adc6ff;
  text-decoration: none;
  font-weight: 600;
  border-bottom: 1px solid rgba(173, 198, 255, 0.35);
  transition: color 0.15s ease, border-color 0.15s ease;
}
body.boca-app-ui :is(table[border="1"], table#myscoretable) a:hover {
  color: #d8e2ff;
  border-bottom-color: rgba(173, 198, 255, 0.65);
}

/* Nested tables inside data grids — compact, no outer “card” shadow */
body.boca-app-ui :is(table[border="1"], table#myscoretable) table {
  width: auto;
  max-width: 100%;
  margin: 0.35rem 0;
  border-radius: 0.5rem;
  border: 1px solid rgba(43, 70, 128, 0.4);
  background: rgba(5, 16, 38, 0.65);
  box-shadow: none;
  overflow: visible;
  border-collapse: separate;
  border-spacing: 0;
}
body.boca-app-ui :is(table[border="1"], table#myscoretable) table td,
body.boca-app-ui :is(table[border="1"], table#myscoretable) table th {
  border: none;
  border-bottom: 1px solid rgba(43, 70, 128, 0.28);
  padding: 0.4rem 0.55rem;
  font-size: 0.8125rem;
  text-transform: none;
  letter-spacing: normal;
  font-weight: 500;
  background: transparent !important;
  white-space: normal;
}
body.boca-app-ui :is(table[border="1"], table#myscoretable) table > tr:last-child > td,
body.boca-app-ui :is(table[border="1"], table#myscoretable) table > tr:last-child > th {
  border-bottom: none;
}
body.boca-app-ui :is(table[border="1"], table#myscoretable) table > tr:first-child > td,
body.boca-app-ui :is(table[border="1"], table#myscoretable) table > tr:first-child > th {
  background: rgba(0, 40, 95, 0.35) !important;
  font-weight: 600;
  color: #b8c8f0;
}

/* Standalone layout tables (border=0) */
body.boca-app-ui table[border="0"] {
  width: auto;
  max-width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  margin: 0.5rem auto;
  background: transparent;
  border: none;
  border-radius: 0.5rem;
  box-shadow: none;
  overflow: visible;
}
body.boca-app-ui table[border="0"] td,
body.boca-app-ui table[border="0"] th {
  border: none;
  padding: 0.4rem 0.65rem;
  vertical-align: middle;
  color: #dee5ff;
  background: transparent !important;
}
body.boca-app-ui table[border="0"] > tr > td:first-child {
  color: #91aaeb;
  font-weight: 600;
  text-align: right;
  padding-right: 0.85rem;
  white-space: nowrap;
}

/* --- Forms: layout + “card” for label/field tables --- */
body.boca-app-ui form {
  color-scheme: dark;
  margin: 0.5rem 0 1.5rem;
}
body.boca-app-ui form table[border="0"] {
  margin: 0.75rem auto;
  padding: 1rem 1.15rem 1.2rem;
  background: linear-gradient(165deg, rgba(6, 22, 52, 0.72) 0%, rgba(4, 14, 36, 0.85) 100%);
  border: 1px solid rgba(43, 70, 128, 0.55);
  border-radius: 0.75rem;
  box-shadow:
    0 8px 28px rgba(0, 0, 0, 0.35),
    inset 0 1px 0 rgba(173, 198, 255, 0.06);
  width: min(100%, 44rem);
}
body.boca-app-ui form table[border="0"] td,
body.boca-app-ui form table[border="0"] th {
  padding: 0.55rem 0.7rem;
  vertical-align: middle;
}
body.boca-app-ui form table[border="0"] > tr > td:first-child {
  width: 32%;
  max-width: 12rem;
  color: #a8bce8;
  font-size: 0.8125rem;
  letter-spacing: 0.02em;
}
body.boca-app-ui form table[border="0"] > tr > td:first-child + td {
  width: auto;
}
body.boca-app-ui form table[border="0"] > tr > td:first-child + td input[type="text"],
body.boca-app-ui form table[border="0"] > tr > td:first-child + td input[type="password"],
body.boca-app-ui form table[border="0"] > tr > td:first-child + td select,
body.boca-app-ui form table[border="0"] > tr > td:first-child + td textarea {
  width: min(100%, 28rem);
  max-width: 100%;
  box-sizing: border-box;
}

body.boca-app-ui textarea {
  min-height: 2.75rem;
  line-height: 1.45;
  resize: vertical;
}
body.boca-app-ui table textarea {
  width: 100%;
  max-width: 42rem;
  margin: 0.15rem 0;
}

/* --- Buttons --- */
body.boca-app-ui input[type="submit"],
body.boca-app-ui input[type="button"],
body.boca-app-ui input[type="reset"],
body.boca-app-ui button:not(.boca-btn-plain) {
  border-radius: 0.5rem;
  padding: 0.5rem 1.15rem;
  font-weight: 600;
  font-size: 0.8125rem;
  letter-spacing: 0.02em;
  background: linear-gradient(180deg, #0a2858 0%, #05183c 100%);
  color: #e8edff;
  border: 1px solid rgba(91, 116, 177, 0.65);
  box-shadow: 0 1px 0 rgba(255, 255, 255, 0.06) inset;
  cursor: pointer;
  transition: background 0.15s ease, border-color 0.15s ease, box-shadow 0.15s ease, transform 0.1s ease;
}
body.boca-app-ui input[type="submit"]:hover,
body.boca-app-ui input[type="button"]:hover,
body.boca-app-ui input[type="reset"]:hover,
body.boca-app-ui button:not(.boca-btn-plain):hover {
  background: linear-gradient(180deg, #0d3270 0%, #062048 100%);
  border-color: rgba(173, 198, 255, 0.45);
  box-shadow: 0 0 0 1px rgba(173, 198, 255, 0.12);
}
body.boca-app-ui input[type="submit"]:active,
body.boca-app-ui input[type="button"]:active,
body.boca-app-ui input[type="reset"]:active,
body.boca-app-ui button:not(.boca-btn-plain):active {
  transform: translateY(1px);
}
body.boca-app-ui input[type="submit"]:focus-visible,
body.boca-app-ui input[type="button"]:focus-visible,
body.boca-app-ui input[type="reset"]:focus-visible,
body.boca-app-ui button:not(.boca-btn-plain):focus-visible {
  outline: none;
  box-shadow: 0 0 0 3px rgba(0, 67, 149, 0.45);
}

/* Submit rows: space between buttons */
body.boca-app-ui form center:has(input[type="submit"]),
body.boca-app-ui form center:has(input[type="button"]),
body.boca-app-ui form center:has(input[type="reset"]) {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
  gap: 0.65rem;
  margin: 1rem 0 0.35rem;
}

/* --- Text fields --- */
body.boca-app-ui input[type="text"],
body.boca-app-ui input[type="password"],
body.boca-app-ui input[type="number"],
body.boca-app-ui input[type="email"],
body.boca-app-ui input[type="search"],
body.boca-app-ui input[type="url"],
body.boca-app-ui input[type="tel"],
body.boca-app-ui input[type="date"],
body.boca-app-ui input[type="time"],
body.boca-app-ui input[type="datetime-local"],
body.boca-app-ui input[type="file"],
body.boca-app-ui select,
body.boca-app-ui textarea {
  border-radius: 0.5rem;
  background: rgba(6, 18, 45, 0.95);
  border: 1px solid rgba(43, 70, 128, 0.75);
  color: #e8edff;
  padding: 0.5rem 0.7rem;
  font-size: 0.875rem;
  transition: border-color 0.15s ease, box-shadow 0.15s ease;
  box-sizing: border-box;
}
body.boca-app-ui input[type="text"]:focus,
body.boca-app-ui input[type="password"]:focus,
body.boca-app-ui input[type="number"]:focus,
body.boca-app-ui input[type="email"]:focus,
body.boca-app-ui input[type="search"]:focus,
body.boca-app-ui input[type="url"]:focus,
body.boca-app-ui select:focus,
body.boca-app-ui textarea:focus {
  outline: none;
  border-color: rgba(173, 198, 255, 0.55);
  box-shadow: 0 0 0 3px rgba(0, 67, 149, 0.35);
}
body.boca-app-ui input::placeholder,
body.boca-app-ui textarea::placeholder {
  color: rgba(145, 170, 235, 0.65);
  opacity: 1;
}
body.boca-app-ui input:disabled,
body.boca-app-ui select:disabled,
body.boca-app-ui textarea:disabled {
  opacity: 0.55;
  cursor: not-allowed;
  border-color: rgba(43, 70, 128, 0.45);
}
body.boca-app-ui input[readonly],
body.boca-app-ui textarea[readonly] {
  opacity: 0.88;
  border-style: dashed;
  border-color: rgba(91, 116, 177, 0.55);
  cursor: default;
}

body.boca-app-ui select {
  min-height: 2.5rem;
  cursor: pointer;
  -webkit-appearance: none;
  appearance: none;
  background-color: rgba(6, 18, 45, 0.95);
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2391aaeb'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 0.55rem center;
  background-size: 1rem;
  padding-right: 2.25rem;
}
body.boca-app-ui select[multiple] {
  min-height: 8rem;
  background-image: none;
  padding-right: 0.7rem;
}

body.boca-app-ui input[type="file"] {
  padding: 0.4rem 0.5rem;
  font-size: 0.8125rem;
  cursor: pointer;
}
body.boca-app-ui input[type="file"]::file-selector-button {
  margin-right: 0.75rem;
  padding: 0.4rem 0.85rem;
  border-radius: 0.375rem;
  border: 1px solid rgba(91, 116, 177, 0.65);
  background: linear-gradient(180deg, #0a2858 0%, #05183c 100%);
  color: #e8edff;
  font-weight: 600;
  font-size: 0.75rem;
  cursor: pointer;
  font-family: inherit;
}
body.boca-app-ui input[type="file"]::file-selector-button:hover {
  border-color: rgba(173, 198, 255, 0.45);
}

body.boca-app-ui input[type="checkbox"],
body.boca-app-ui input[type="radio"] {
  width: 1.05rem;
  height: 1.05rem;
  accent-color: #6b9dff;
  vertical-align: middle;
  cursor: pointer;
}

body.boca-app-ui fieldset {
  margin: 1rem 0;
  padding: 1rem 1.1rem;
  border: 1px solid rgba(43, 70, 128, 0.55);
  border-radius: 0.65rem;
  background: rgba(5, 18, 44, 0.5);
}
body.boca-app-ui legend {
  padding: 0 0.5rem;
  font-size: 0.8125rem;
  font-weight: 700;
  letter-spacing: 0.04em;
  text-transform: uppercase;
  color: #adc6ff;
}

body.boca-app-ui center {
  display: block;
  margin: 0.75rem 0;
}
body.boca-app-ui form > center > b,
body.boca-app-ui form center > b {
  display: inline-block;
  line-height: 1.55;
  font-size: 0.875rem;
  font-weight: 600;
  color: #c8d8ff;
  max-width: 42rem;
}
body.boca-app-ui font[size="-2"] {
  font-size: 0.7rem;
  opacity: 0.92;
}
</style>
		<?php
	}

	/**
	 * @param string $href e.g. run.php
	 * @param string $label HTML-safe text
	 * @param bool   $active
	 */
	function boca_tailwind_nav_pill($href, $label, $active) {
		$base = 'inline-flex items-center rounded-md px-3 py-1.5 text-xs font-semibold uppercase tracking-wide transition-colors duration-200 ';
		if ($active) {
			$base .= 'text-primary border-b-2 border-primary';
		} else {
			$base .= 'text-on-surface-variant hover:bg-outline-variant/25 hover:text-on-surface';
		}
		echo '<a class="' . $base . '" href="' . htmlspecialchars($href) . '">' . $label . '</a>';
	}
}
