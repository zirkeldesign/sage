module.exports = {
  variants: {
    boxShadow: ["responsive", "hover", "focus", "group-hover"],
    margin: ["responsive", "hover", "focus", "first"],
  },
  theme: {
    fontFamily: {
      display: ["Open Sans", "sans-serif"],
      body: ["Arbutus Slab", "serif"],
    },
    extend: {
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
    },
    gutenberg: theme => ({
      /**
       * Disable CSS generation for feature subsets
       */
      supports: {
        wideAlignments: true,
        wpGenerated: {
          fontSizes: true,
        },
      },

      /**
       * Screensizes for media queries
       */
      screens: {
        sm: theme("screens.sm"),
        md: theme("screens.md"),
        lg: theme("screens.lg"),
        xl: theme("screens.xl"),
      },

      /**
       * Max-width of contents. Top-level keys are
       * mapped to `screens` and secondary keys
       * are mapped to containing block's alignment
       */
      contentWidths: {
        xs: {
          normal: theme("maxWidth.xl"),
          wide: theme("maxWidth.full"),
          full: theme("maxWidth.full"),
        },
        sm: {
          normal: theme("maxWidth.2xl"),
          wide: theme("maxWidth.full"),
          full: theme("maxWidth.full"),
        },
        md: {
          normal: theme("maxWidth.3xl"),
          wide: theme("maxWidth.4xl"),
          full: theme("maxWidth.full"),
        },
        lg: {
          normal: theme("maxWidth.4xl"),
          wide: theme("maxWidth.5xl"),
          full: theme("maxWidth.full"),
        },
        xl: {
          normal: theme("maxWidth.5xl"),
          wide: theme("maxWidth.6xl"),
          full: theme("maxWidth.full"),
        },
      },

      /**
       * Baseline vertical and horizontal spacing
       */
      columnGap: theme("spacing.2"),
      rowGap: {
        default: theme("spacing.8"),
        wide: theme("spacing.12"),
        full: theme("spacing.16"),
      },

      /**
       * Wordpress generated colors
       * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/
       */
      colors: {
        "gross-green": theme("colors.gross-green.500"),
        "dark-blue-grey": theme("colors.dark-blue-grey.500"),
      },

      /**
       * Typography: fontset
       */
      fontFamily: {
        h1: theme("fontFamily.display"),
        h2: theme("fontFamily.display"),
        h3: theme("fontFamily.display"),
        h4: theme("fontFamily.display"),
        h5: theme("fontFamily.body"),
        h6: theme("fontFamily.body"),
        p: theme("fontFamily.body"),
        ul: theme("fontFamily.body"),
        ol: theme("fontFamily.body"),
      },

      /**
       * Typography: type scale
       */
      fontSizes: {
        h1: theme("fontSize.4xl"),
        h2: theme("fontSize.3xl"),
        h3: theme("fontSize.2xl"),
        h4: theme("fontSize.xl"),
        h5: theme("fontSize.lg"),
        h6: theme("fontSize.lg"),
        /**
         * WordPress generated type scale
         * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/
         */
        wpGenerated: {
          small: "12px",
          normal: "16px",
          large: "36px",
          huge: "50px",
        },
      },

      /**
       * Keys for `gutenberg.images.figCaption.textAlign`
       * map to the alignment of the containing block
       */
      figCaption: {
        textAlign: {
          left: "left",
          right: "right",
          center: "center",
          wide: "center",
        },
        fontFamily: theme("fontFamily.sans"),
      },

      /**
       * Lists: unordered & ordered
       */
      lists: {
        inset: theme("spacing.2"),
        orderedStyle: "lower-roman",
        unorderedStyle: "square",
      },

      /**
       * Block specific configuration values
       */
      blocks: {
        cover: {
          verticalPadding: theme("spacing.64"),
        },
      },
    }),
  },
  plugins: [require("@zirkeldesign/tailwind-gutenberg-components")],
};
