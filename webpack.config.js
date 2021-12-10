const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

const config = {
    mode: "development",
    entry: "./src/index.js",
    devtool: "source-map",
    output: {
        filename: "main.js",
        path: path.resolve(__dirname, 'dist')
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: "style.css",
        })
    ],
    module: {
        rules: [
            {
                test: /\.m?js$/,
                exclude: /(node_modules|bower_components)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env']
                    }
                }
            },
            {
                test: /\.css$/i,
                use: [MiniCssExtractPlugin.loader, "css-loader"],
            },
        ]
    }
}

module.exports = config;