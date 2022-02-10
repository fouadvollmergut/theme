const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CopyPlugin = require("copy-webpack-plugin");


module.exports = {
    entry: ["./index.js"],
    output: {
        path: path.resolve(__dirname, "./dist/scripts/"),
        filename: '[name].js'
    },
    plugins: [
      new MiniCssExtractPlugin({
        filename: '[name].css'
      }),
      new CopyPlugin({
        patterns: [
          { from: "*.php", to: path.resolve(__dirname, "./dist") },
          { from: "assets", to: path.resolve(__dirname, "./dist/assets") },
          { from: "includes", to: path.resolve(__dirname, "./dist/includes") },
          { from: "modules/**/*.php", to: path.resolve(__dirname, "./dist/modules") },
          { from: "modules/**/*.svg", to: path.resolve(__dirname, "./dist/modules") }
        ],
      }),
    ],
    module: {
        rules: [
            {
                test: /\.(scss|css)$/,
                use: [MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader'],
            }
        ]
    },
    devServer: {
        static: path.join(__dirname, "/")
    }
}