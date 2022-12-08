const path = require('path');
const mode = process.env.NODE_ENV || 'development';
const devMode = mode === 'development';
const HtmlWebpackPlugin = require('html-webpack-plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");


const target = devMode ? 'web' : 'browserslist';
const devtool = devMode ? 'source-map' : undefined;
module.exports = {
    mode,
    target,
    devtool,
    entry: path.resolve(__dirname, 'assets', 'index.js'),
    output: {
        path: path.resolve(__dirname, 'dist'),
        clean: true,
        filename: '[name].js',
    },
    plugins: [
        new MiniCssExtractPlugin({filename: '[name].css',})
    ],
    module: {
        rules: [
            {
                test: /\.(c|sa|sc|)ss$/i,
                use: [devMode ? "style-loader" : MiniCssExtractPlugin.loader, "css-loader", "sass-loader" ],
            },
            {
                test: /\.woff2?$/i,
                type: 'asset/resource',
                generator: {
                    filename: 'fonts/[name][ext]'
                }
            },
            {
                test: /\.m?js$/,
                exclude: /(node_modules|bower_components)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env']
                    }
                }
            }
        ],
    },
    experiments: {
        topLevelAwait: true
    },

};
