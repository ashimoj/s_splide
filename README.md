# tane-be テンプレート使用方法について

## 初期設定

- Local で all in one WP Migration をインストールし、template.wordpess を食べさせる

- themes の中から start-theme のフォルダ名を案件用に変更

- style.cssも同様に、 Theme Name を案件名に変更

-   package.json の中から"config"-> "theme_name"を自分のテーマ名に変更する

-   gitignore のフォルダ名を対応する案件名に入れ替える

```
!Local Sites/app/public/wp-content/themes/フォルダ名/
Local Sites/app/public/wp-content/themes/フォルダ名/css/
Local Sites/app/public/wp-content/themes/フォルダ名/js/
Local Sites/app/public/wp-content/themes/フォルダ名/img/
```

## 作業手順

- `npm i`

- `npm run dev`

- 本番よう圧縮ファイル生成 `npm run build`

## オプション設定

- webpack.config.cjs

ブラウザシンクプラグイン(Live reload)

115行目らへん BrowserSyncPlugin
```
  proxy: 'http://localhost:10024/', //LocalのURL
  notify: false,  //通知の非表示
  open: 'external', //外部URL化
  port: '80',
  files: [`${outputDir}/**/*.php`],
```

- webp画像の生成 imagemin.mjs

30行目らへん コメントアウト外すとwebpも一緒に吐き出される