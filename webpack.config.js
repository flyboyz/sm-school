const path = require('path');

const UglifyJSPlugin = require('uglifyjs-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const FixStyleOnlyEntriesPlugin = require('webpack-fix-style-only-entries');

module.exports = {
    entry: {
        app: './src/js/app.js',
        style: './src/less/app.less'
    },
    output: {
        path: path.resolve(__dirname, './'),
        filename: 'js/[name].min.js'
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
                test: /\.less$/,
                use: [{
                    loader: MiniCssExtractPlugin.loader,
                    options: {
                        name: 'css/[name].css'
                    },
                }, 'css-loader', 'less-loader']
            },
            {
                test: /\.(jpe?g|png|ttf|eot|svg|woff(2)?)(\?[a-z0-9=&.]+)?$/,
                use: 'base64-inline-loader?limit=1000&name=[name].[ext]'
            }
        ]
    },
    plugins: [
        new FixStyleOnlyEntriesPlugin(),
        // extract css into dedicated file
        new MiniCssExtractPlugin({
            filename: '[name].css'
        }),
    ],
    optimization: {
        minimizer: [
            // enable the js minification plugin
            new UglifyJSPlugin({
                include: /\.min\.js$/,
                cache: true,
                parallel: true
            }),
            // enable the css minification plugin
            // new OptimizeCSSAssetsPlugin({
            //     assetNameRegExp: /\.css$/,
            // })
        ]
    }
};