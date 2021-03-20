const {merge} = require('webpack-merge');
const common = require('./webpack.common.js');

const TerserPlugin = require('terser-webpack-plugin');
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');

module.exports = merge(common, {
    mode: 'production',
    optimization: {
        minimize: true,
        minimizer: [
            new TerserPlugin({
                extractComments: false,
                parallel: true,
            }),
            new OptimizeCSSAssetsPlugin({
                assetNameRegExp: /\.min\.css$/
            })
        ],
        removeAvailableModules: false,
        removeEmptyChunks: false,
        splitChunks: false,
    }
});