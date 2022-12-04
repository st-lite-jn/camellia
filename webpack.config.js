//path モジュールの読み込み
const path = require('path');

//MiniCssExtractPlugin の読み込み
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

//FixStyleOnlyEntriesの読み込み
const FixStyleOnlyEntries = require("webpack-fix-style-only-entries");

// production モード以外の場合、変数 enabledSourceMap は true
const enabledSourceMap = process.env.NODE_ENV !== 'production';

const entryPoints = {
	js: {
	  main : "./_src/js/main.js",
	},
	scss: {
	  style : "./_src/scss/style.scss",
	  editor : "./_src/scss/editor.scss",
	}
};

module.exports = {
	//エントリポイント（デフォルトと同じなので省略可）
	entry: {
		main : entryPoints.js.main,
		style : entryPoints.scss.style,
		editor : entryPoints.scss.editor
	},
	//出力先（デフォルトと同じなので省略可）
	output: {
		filename: 'js/[name].js',
		path: path.resolve(__dirname, 'assets'),
	},
	module: {
		rules: [
			{
				// 対象となるファイルの拡張子(scss)
				test: /\.scss$/,
				// Sassファイルの読み込みとコンパイル
				use: [
					// CSSファイルを抽出するように MiniCssExtractPlugin のローダーを指定
					{
						loader: MiniCssExtractPlugin.loader,
					},
					// CSSをバンドルするためのローダー
					{
						loader: "css-loader",
						options: {
							//URL の解決を無効に
							url: false,
							// ソースマップを有効に
							sourceMap: enabledSourceMap,
						},
					},
					// Sass を CSS へ変換するローダー
					{
						loader: "sass-loader",
						options: {
							// dart-sass を優先
							implementation: require('sass'),
							sassOptions: {},
							// ソースマップを有効に
							sourceMap: enabledSourceMap,
						},
					},
				],
			},
		],
	},
	//プラグインの設定
	plugins: [
		new FixStyleOnlyEntries(),
		new MiniCssExtractPlugin({
			// 抽出する CSS のファイル名
			filename: "css/[name].css",
		}),
	],

	//source-map タイプのソースマップを出力する
	devtool: "source-map",

	// node_modules を監視（watch）対象から除外する
	watchOptions: {
		ignored: /node_modules/  //正規表現で指定
	},
};
