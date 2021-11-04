module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors:{
        primary: '#FF6363',
        secondary: {
          100: '#E2E2D5',
          200: '#888883',
        },
        pinkpatris: '#F0628C',
        greypatris: '#ACACAC',
        brownpatris: '#60544C',
        bluepatris: '#2B98F0',
      },
      fontFamily:{
        body: ['Nunito']
      },
      height: {
        patrislogin: '496px',
       },
      width: {
        patrislogin: '496px',
       },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
