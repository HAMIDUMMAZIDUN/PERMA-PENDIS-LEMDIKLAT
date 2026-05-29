/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      borderRadius: {
        'none': '0px',
        'xs': '0px',
        'sm': '0px',
        'DEFAULT': '0px',
        'md': '0px',
        'lg': '0px',
        'xl': '0px',
        '2xl': '0px',
        '3xl': '0px',
        '4xl': '0px',
        'full': '0px',
      },
      colors: {
        primary: {
          DEFAULT: '#208457',
          50: '#f0faf5',
          100: '#dcf5e9',
          200: '#bcead4',
          300: '#8bd6b4',
          400: '#54bc8f',
          500: '#2ea270',
          600: '#208457',
          700: '#176a47',
          800: '#135439',
          900: '#0a2d1d',
          950: '#03140e',
        },
        secondary: {
          DEFAULT: '#cca43b',
          50: '#fdfcf7',
          100: '#f9f6e6',
          200: '#f0e9c1',
          300: '#e4d893',
          400: '#cca43b',
          500: '#b08b2c',
          600: '#917021',
          700: '#725619',
          800: '#584114',
          900: '#42300f',
        },
      },
      fontFamily: {
        sans: ['Plus Jakarta Sans', 'Inter', 'ui-sans-serif', 'system-ui', '-apple-system', 'sans-serif'],
      },
      animation: {
        'fade-in': 'fadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards',
        'slide-up': 'slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards',
        'slide-in': 'slideIn 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0', filter: 'blur(4px)' },
          '100%': { opacity: '1', filter: 'blur(0)' },
        },
        slideUp: {
          '0%': { opacity: '0', transform: 'translateY(30px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
        slideIn: {
          '0%': { opacity: '0', transform: 'translateX(-30px)' },
          '100%': { opacity: '1', transform: 'translateX(0)' },
        },
      },
    },
  },
  plugins: [],
}
