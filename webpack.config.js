process.traceDeprecation = true;
module.exports = (env, argv) => {

	var development_mode = (argv.mode === 'development');

	var webpack = require('webpack');
	var UglifyJsPlugin = require("uglifyjs-webpack-plugin");
	var MiniCssExtractPlugin = require("mini-css-extract-plugin");
	var OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");

	var node_dir = __dirname + '/node_modules';
	var output_dir = __dirname +"/app/production";

	var config = {
		mode: process.env.NODE_ENV,
		context: __dirname,
		entry: "./app/js/index.js",
		devtool: (development_mode ? 'source-map' : false),
		output: {
			path: output_dir,
			filename: (development_mode ? 'index.js' : 'index.min.js')
		},
		module: {
			rules: [
				{
					test: require.resolve('jquery'),
	        		exclude: [
	        			/node_modules/
	        		],
					use: 'expose-loader?jQuery!expose?$'
				},
				{
					test: /\.scss$/,
					use: [
						MiniCssExtractPlugin.loader,
						{
							loader: 'css-loader',
							options: {
								url: false,
								sourceMap: true
							}
						},
						{
							loader: 'sass-loader',
							options: {
								sourceMap: true
							}
						}
					]
				},
				{
					// load external resources (ie Google fonts)
					test: /.(gif|jpg|png|woff(2)?|eot|ttf|svg)(\?[a-z0-9=\.]+)?$/,
					use: {
						loader: 'file-loader',
						options: {
							name: '[name].[ext]?[hash]',
							limit: 10000000
						}
					}
				}
			]
		},
		plugins: [
			new webpack.optimize.OccurrenceOrderPlugin(),
			new webpack.ProvidePlugin({
			    $: "jquery",
			    jQuery: "jquery",
			    "window.jQuery": "jquery"
			}),
			new MiniCssExtractPlugin({
				path: output_dir,
				filename: (development_mode ? 'index.css' : 'index.min.css'),
				sourceMap: true
			})
		],
		optimization: {
			minimize: !development_mode,
			minimizer: [
				new UglifyJsPlugin({
					cache: true,
					parallel: true,
					sourceMap: true
				}),
				new OptimizeCSSAssetsPlugin({})
			]
		},
	};

	return config;
}
