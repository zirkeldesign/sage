module.exports = {
  variants: {
    boxShadow: ["responsive", "hover", "focus", "group-hover"],
    margin: ["responsive", "hover", "focus", "first"],
  },
  theme: {
    fontFamily: {
      display: ["'Open Sans'", "sans-serif"],
      body: ["'Arbutus Slab'", "serif"],
    },

    colors: {
      "gross-green": {
        100: "#f6f9e8",
        200: "#e8f1c5",
        300: "#dae8a2",
        400: "#bfd65c",
        500: "#a3c516",
        600: "#93b114",
        700: "#62760d",
        800: "#49590a",
        900: "#313b07",
      },
      "dark-blue-grey": {
        100: "#e9edee",
        200: "#c8d2d5",
        300: "#a7b7bb",
        400: "#648189",
        500: "#224b56",
        600: "#1f444d",
        700: "#142d34",
        800: "#0f2227",
        900: "#0a171a",
      },
      "off-white": {
        100: "#fefefd",
        200: "#fdfcf9",
        300: "#fbfaf5",
        400: "#f8f7ee",
        500: "#f5f3e7",
        600: "#dddbd0",
        700: "#93928b",
        800: "#6e6d68",
        900: "#4a4945",
      },
    },
    extend: {},
  },
};
