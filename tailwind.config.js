module.exports = {
  theme: {
    extend: {
      colors: {
        mainColor: "#008EFF",
        githubColor: "#333333",
        facebookColor: "#3B5998"
      },
      fontFamily: {
        sans: ['Ubuntu', 'Montserrat']
      }
    }
  },
  variants: {},
  plugins: [
    require('@tailwindcss/custom-forms')
  ]
}
