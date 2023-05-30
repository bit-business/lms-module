// @ts-check
// Note: type annotations allow type checking and IDEs autocompletion

const lightCodeTheme = require("prism-react-renderer/themes/github");
const darkCodeTheme = require("prism-react-renderer/themes/dracula");

/** @type {import('@docusaurus/types').Config} */
const config = {
  title: "Skijasi LMS Module Documentation",
  tagline: "Skijasi lms module official documentation",
  url: "https://skijasi-lms.nadzorserveraweb.hr",
  baseUrl: "/",
  onBrokenLinks: "throw",
  onBrokenMarkdownLinks: "warn",
  favicon: "img/favicon.ico",
  organizationName: "nadzorservera-croatia", // Usually your GitHub org/user name.
  projectName: "skijasi-lms-module", // Usually your repo name.
  trailingSlash: false,

  i18n: {
    defaultLocale: "en",
    locales: ["en"],
  },

  presets: [
    [
      "classic",
      /** @type {import('@docusaurus/preset-classic').Options} */
      ({
        docs: {
          sidebarPath: require.resolve("./sidebars.js"),
          // Please change this to your repo.
          editUrl:
            "https://github.com/nadzorservera-croatia/skijasi-lms-module/edit/main/website/",
          routeBasePath: "/",
        },
        blog: {
          showReadingTime: true,
          // Please change this to your repo.
          editUrl:
            "https://github.com/nadzorservera-croatia/skijasi-lms-module/edit/main/website/blog/",
        },
        theme: {
          customCss: require.resolve("./src/css/custom.css"),
        },
      }),
    ],
  ],

  themeConfig:
    /** @type {import('@docusaurus/preset-classic').ThemeConfig} */
    ({
      navbar: {
        title: "LMS",
        logo: {
          alt: "Skijasi Logo",
          src: "https://skijasi-web.s3-ap-southeast-1.amazonaws.com/files/shares/1619582634819_skijasi.png",
        },
        items: [
          // {
          //   type: "doc",
          //   docId: "introduction",
          //   position: "left",
          //   label: "Tutorial",
          // },

          {
            type: "localeDropdown",
            position: "right",
          },

          {
            href: "https://github.com/nadzorservera-croatia/skijasi-lms-module",
            label: "GitHub",
            position: "right",
          },
        ],
      },
      footer: {
        style: "dark",
        links: [
          {
            title: "Learn",
            items: [
              {
                label: "Introduction",
                to: "/",
              },
              {
                label: "Installation",
                to: "/getting-started/installation",
              },
            ],
          },
          {
            title: "Community",
            items: [
              {
                label: "Facebook",
                href: "https://www.facebook.com/groups/skijasi",
              },
              {
                label: "Telegram",
                href: "https://t.me/skijasi_developers",
              },
            ],
          },
          {
            title: "More",
            items: [
              {
                label: "Donation",
                to: "https://opencollective.com/skijasi",
              },
            ],
          },
        ],
        copyright: `Copyright © ${new Date().getFullYear()} NADZORSERVERA. All right reserved`,
      },
      prism: {
        theme: lightCodeTheme,
        darkTheme: darkCodeTheme,
      },
    }),
};

module.exports = config;
