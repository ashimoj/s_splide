const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CopyPlugin = require('copy-webpack-plugin');
const FixStyleOnlyEntries = require('webpack-fix-style-only-entries');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

// エントリポイント・出力先など指定
const THEME_NAME = process.env.npm_package_config_theme_name;
const entryPath = process.env.npm_package_config_src_path;
const outputDir = process.env.npm_package_config_dist_path + '/' + THEME_NAME + '/';

const froms = {
  js: {
    index: entryPath + '/js/app.js',
  },
  scss: {
    style: entryPath + '/scss/style.scss',
    editorStyle: entryPath + '/scss/editor-style.scss',
  },
};
const MODE = process.env.MODE;
const flag = MODE === 'production' ? true : false;

module.exports = {
  mode: MODE,
  //map
  devtool: 'source-map',
  // 圧縮設定
  optimization: {
    minimize: flag,
  },

  // エントリーポイントの設定
  entry: {
    // コンパイル対象のファイルを指定
    bundle: froms.js.index,
    'style.css': froms.scss.style,
    'editor-style.css': froms.scss.editorStyle,
  },

  // 出力設定
  output: {
    filename: 'js/[name].js',
    path: path.resolve(__dirname, outputDir),
    assetModuleFilename: 'images/[name][ext][query]',
  },

  module: {
    rules: [
      {
        // node_module内のcss
        test: /node_modules\/(.+)\.css$/,
        use: [
          {
            loader: 'style-loader',
          },
          {
            loader: 'css-loader',
            options: { url: false },
          },
        ],
        sideEffects: true, // production modeでもswiper-bundle.cssが使えるように
      },
      {
        test: /\.s(a|c)ss$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
            options: { publicPath: '../' },
          },
          'css-loader',
          'postcss-loader',
          {
            loader: 'sass-loader',
            options: {
              sassOptions: {
                outputStyle: 'expanded',
              },
            },
          },
        ],
      },
      {
        test: /\.(png|jpg|webp|svg)$/i,
        type: 'asset/resource',
        generator: {
          filename: (pathData) => {
            const imagePath = pathData.module.resource.split('img/')[1];
            return `img/${imagePath}`;
          },
        },
      },
      {
        test: /\.m?js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env'],
          },
        },
      },
    ],
  },

  // warning表示を回避
  performance: {
    hints: false,
    maxEntrypointSize: 512000,
    maxAssetSize: 512000,
  },

  // webpack実行時の追加タスク設定
  plugins: [
    new BrowserSyncPlugin({
      // host: 'localhost',
      proxy: 'http://localhost:10039', //LocalのURL
      notify: false, //通知を非表示
      open: 'external', //外部URL化
      port: '80',
      files: [`${outputDir}/**/*.php`],
    }),
    // 対象フォルダ・ファイルを複製
    new CopyPlugin({
      patterns: [
        {
          // 変換元の画像もdistへ
          from: path.resolve(__dirname, entryPath, 'img'),
          to: path.resolve(__dirname, outputDir, 'img'),
        },
      ],
    }),
    new FixStyleOnlyEntries(),
    new MiniCssExtractPlugin({
      filename: './css/[name]',
    }),
  ],

  // node_module を監視（watch）対象から除外
  watchOptions: {
    ignored: /node_module/,
  },
};
