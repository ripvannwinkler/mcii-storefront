const path = require('path');
const webpack = require('webpack');
const childProcess = require('child_process');
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const AppCachePlugin = require('appcache-webpack-plugin');
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer')
	.BundleAnalyzerPlugin;

const extractCss = new ExtractTextPlugin('main.css');

const hsm = 'hidden-source-map';
const cme = 'cheap-module-eval-source-map';

const PRODUCTION = process.env.NODE_ENV === 'production';
const DEVTOOL = PRODUCTION ? hsm : cme;
const ENABLE_APPCACHE = true;

module.exports = {
	devtool: DEVTOOL,

	entry: {
		main: [
			'core-js/fn/typed',
			'core-js/fn/promise',
			'core-js/fn/object/assign',
			'core-js/fn/array/find',
			'core-js/fn/array/includes',
			'whatwg-fetch',
			'./inc/js/main.js',
		],
	},

	output: {
		pathinfo: !PRODUCTION,
		filename: '[name].js',
		path: path.resolve('./dist')
	},

	devServer: {
		contentBase: path.resolve('./dist'),
		historyApiFallback: true,
		inline: true,
		port: 9000,
	},

	module: {
		rules: [{
				test: /\.tsx?$/i,
				loader: ['babel-loader', 'ts-loader'],
			},
			{
				test: /\.jsx?$/i,
				include: path.resolve('./src'),
				use: ['babel-loader'],
			},
			{
				test: /\.css$/i,
				use: ['style-loader', 'css-loader'],
			},
			{
				test: /\.s[ca]ss$/i,
				use: extractCss.extract(['css-loader', 'resolve-url-loader', 'sass-loader?sourceMap=true'])
			},
			{
				test: /\.(woff|woff2|eot|otf|ttf|map|svg|png|gif|jpg)$/i,
				use: {
					loader: 'file-loader',
					options: {
						name: 'assets/[name]-[hash:8].[ext]',
					},
				},
			},
		],
	},

	resolve: {
		modules: ['./src', 'node_modules'],
		extensions: ['.ts', '.tsx', '.js'],
	},

	node: {
		fs: 'empty',
		net: 'empty',
	},

	plugins: [
		extractCss,
		new webpack.NamedModulesPlugin(),
		new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/),


		new webpack.optimize.CommonsChunkPlugin({
			name: 'common',
			minChunks: function (module) {
				return /node_modules/i.test(module.resource);
			},
		}),

		new webpack.optimize.CommonsChunkPlugin({
			name: 'app',
			minChunks: 2,
		}),

		new webpack.optimize.CommonsChunkPlugin({
			name: 'manifest',
			minChunks: Infinity,
		}),

		new BundleAnalyzerPlugin({
			openAnalyzer: false,
			analyzerMode: 'static',
			reportFilename: 'analysis.html',
		})
	],
};
