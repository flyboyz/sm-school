const path = require('path');
const webpack = require('webpack');

const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const FixStyleOnlyEntriesPlugin = require('webpack-fix-style-only-entries');

module.exports = {
    entry: {
        app: './src/js/app.js',
        main: './src/less/app.less',
        '../template-parts/blocks/about-author/about-author': './src/less/blocks/about-author.less',
    },
    output: {
        path: path.resolve(__dirname),
        filename: 'js/[name].min.js',
        pathinfo: false
    },
    module: {
        rules: [
            {
                test: /\.jsx?$/,
                use: [{
                    loader: 'babel-loader',
                    options: {
                        filename: 'js/[name].min.js',
                        exclude: '/node_modules/'
                    }
                }]
            },
            {
                test: /\.css$/,
                use: ['css-loader']
            },
            {
                test: /\.less$/,
                use: [{
                    loader: MiniCssExtractPlugin.loader,
                    options: {
                        name: 'css/[name].css'
                    },
                }, 'css-loader', 'less-loader']
            },
            {
                test: /\.(ico|jpg|jpeg|png|gif|eot|otf|webp|svg|ttf|woff|woff2)(\?.*)?$/,
                use: {
                    loader: 'file-loader',
                    options: {
                        name: '[path][name].[ext]',
                    },
                },
            },

        ]
    },
    plugins: [
        new FixStyleOnlyEntriesPlugin(),
        new MiniCssExtractPlugin({
            filename: 'css/[name].min.css'
        }),
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
            'window.jQuery': 'jquery'
        })
    ],
    externals: {
        'jquery': 'jQuery'
    }
};