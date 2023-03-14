const MIX = require("laravel-mix");

const PROJECT_FOLDER = path.basename(process.cwd());
const THEME_PATH = "htdocs/content/themes/meat-theme";
const THEME_ASSETS_PATH = "htdocs/content/themes/meat-theme/dist";

/*
  |--------------------------------------------------------------------------
  | Mix Asset Management
  |--------------------------------------------------------------------------
  |
  | Mix provides a clean, fluent API for defining some Webpack build steps
  | for your Laravel application. By default, we are compiling the Sass
  | file for the application as well as bundling up all the JS files.
  |
  | For more documentation about `laravel-mix` refer to: https://laravel-mix.com/docs/4.0/
  |
*/

MIX.setResourceRoot("../")
  .setPublicPath(THEME_ASSETS_PATH)
  .js("resources/js/app.js", "js")
  .sass("resources/scss/app.scss", "css")
  .extract()
  .version()
  .copy("./resources/images", `${THEME_ASSETS_PATH}/images`)
  .browserSync({
    proxy: process.env.BROWSERSYNC_PROXY_URL || `localhost:8080`,
    files: [
      `${THEME_PATH}/resources/views/**/*.php`,
      `${THEME_ASSETS_PATH}/js/**/*.js`,
      `${THEME_ASSETS_PATH}/css/**/*.css`,
    ],
    host: "127.0.0.1",
    port: 3000,
    open: false,
    watchOptions: {
      usePolling: true,
      interval: 150,
    },
  })
  .disableSuccessNotifications()
  .autoload({
    jquery: ["$", "window.jQuery", "jQuery"],
    axios: "axios",
    vue: "Vue",
  })
  .then((stats) => {
    console.log(Object.keys(stats.compilation.assets));
  });

// Full API
// mix.js(src, output);
// mix.react(src, output); <-- Identical to mix.js(), but registers React Babel compilation.
// mix.preact(src, output); <-- Identical to mix.js(), but registers Preact compilation.
// mix.coffee(src, output); <-- Identical to mix.js(), but registers CoffeeScript compilation.
// mix.ts(src, output); <-- TypeScript support. Requires tsconfig.json to exist in the same folder as webpack.mix.js
// mix.extract(vendorLibs);
// mix.sass(src, output);
// mix.less(src, output);
// mix.stylus(src, output);
// mix.postCss(src, output, [require('postcss-some-plugin')()]);
// mix.browserSync('my-site.test');
// mix.combine(files, destination);
// mix.babel(files, destination); <-- Identical to mix.combine(), but also includes Babel compilation.
// mix.copy(from, to);
// mix.copyDirectory(fromDir, toDir);
// mix.minify(file);
// mix.sourceMaps(); // Enable sourcemaps
// mix.version(); // Enable versioning.
// mix.disableNotifications();
// mix.setPublicPath('path/to/public');
// mix.setResourceRoot('prefix/for/resource/locators');
// mix.autoload({}); <-- Will be passed to Webpack's ProvidePlugin.
// mix.webpackConfig({}); <-- Override webpack.config.js, without editing the file directly.
// mix.babelConfig({}); <-- Merge extra Babel configuration (plugins, etc.) with Mix's default.
// mix.then(function () {}) <-- Will be triggered each time Webpack finishes building.
// mix.dump(); <-- Dump the generated webpack config object t the console.
// mix.extend(name, handler) <-- Extend Mix's API with your own components.
// mix.options({
//   extractVueStyles: false, // Extract .vue component styling to file, rather than inline.
//   globalVueStyles: file, // Variables file to be imported in every component.
//   processCssUrls: true, // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
//   purifyCss: false, // Remove unused CSS selectors.
//   terser: {}, // Terser-specific options. https://github.com/webpack-contrib/terser-webpack-plugin#options
//   postCss: [] // Post-CSS options: https://github.com/postcss/postcss/blob/master/docs/plugins.md
// });
