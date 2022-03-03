const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CopyPlugin = require("copy-webpack-plugin");

const config = {
    entry: ["./index.js"],
    plugins: [
        new MiniCssExtractPlugin({
            filename: '[name].css'
        })
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

module.exports = (env, argv) => {
    if (argv.mode === 'production') {
        config.output = {
            path: path.resolve(__dirname, "./dist/scripts/"),
            filename: '[name].js'
        };

        config.plugins.push(
            new CopyPlugin({
                patterns: [
                    { from: "*.php", to: path.resolve(__dirname, "./dist") },
                    { from: "*.css", to: path.resolve(__dirname, "./dist") },
                    { from: "screenshot.png", to: path.resolve(__dirname, "./dist") },
                    { from: ".github", to: path.resolve(__dirname, "./dist/.github") },
                    { from: "acf-json", to: path.resolve(__dirname, "./dist/acf-json") },
                    { from: "assets", to: path.resolve(__dirname, "./dist/assets") },
                    { from: "includes", to: path.resolve(__dirname, "./dist/includes") },
                    { from: "modules/**/*.php", to: path.resolve(__dirname, "./dist") },
                    { from: "modules/**/*.svg", to: path.resolve(__dirname, "./dist") }
                ],
            })
        );
    }

    if (argv.mode === 'development') {
        config.output = {
            path: path.resolve(__dirname, "./scripts/"),
            filename: '[name].js'
        };
    }

    return config;
}