const path = require('path');
const paths = '/home/imran/Apache-Server/html/wp-content';
const CopyPlugin = require('copy-webpack-plugin');
const projectName = 'recurse-theme';
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
// const HtmlWebpackPlugin = require('html-webpack-plugin');

module.exports = {

  entry: './src/script/index.js',
  output: {
    filename: 'js/scripts-bundled.js',
    path: `${paths}/themes/${projectName}`
  },
  // exclude: /(node_modules|bower_components)/,
  mode: 'development',
  // watch: true,
  devServer: {
    port: 5555,
    open: false,
    writeToDisk: true
  },

  //Shows the source file error line
  devtool: "inline-source-map",

  module: {
    rules: [
      {
        test: /\.jsx?$/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env','@babel/preset-react'],
            plugins: ["@babel/plugin-proposal-class-properties"]
          }
        }
      },

      {
        test: /\.(png|jpeg|gif|jpg|svg)$/i,
        loader: 'file-loader',
        options: {
          name: './images/[name].[ext]',
        },
      },
      {
        test: /\.s[ac]ss$/i,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
            options: {
              publicPath: (resourcePath, context) => {
                // publicPath is the relative path of the resource to the context
                // e.g. for ./css/admin/main.css the publicPath will be ../../
                // while for ./css/main.css the publicPath will be ../
                return path.relative(path.dirname(resourcePath), context) + '/';
              },
              // by default it uses publicPath in webpackOptions.output

              hmr: process.env.NODE_ENV === 'development',

            },
          },
          //'css-loader?url=false',
          'css-loader',
          'sass-loader'
        ],
      },
      {
        test: /\.html$/,
        use: [{
          loader: 'html-loader',
          options: {
            minimize: false,
            removeComments: false,
            collapseWhitespace: false
          }
        }],
      },
    ]
  },
  plugins: [
    new MiniCssExtractPlugin({
      // Options similar to the same options in webpackOptions.output
      // all options are optional
      filename: './style.css',
      chunkFilename: '[id].css',
      ignoreOrder: false, // Enable to remove warnings about conflicting order
    }),
    new CopyPlugin([
      { from: './src/images', to: `${paths}/themes/${projectName}/images` },
      { from: './src/theme_php_files', to: `${paths}/themes/${projectName}` },
      { from: './src/theme_cover_image', to: `${paths}/themes/${projectName}` },
      { from: './src/template-parts', to: `${paths}/themes/${projectName}/template-parts` },
      { from: './src/inc', to: `${paths}/themes/${projectName}/inc` },
      { from: './src/mu-plugins', to: `${paths}/mu-plugins` }
    ]),
  ],

}
