## 要件

* リスト型のシンプルな横断求人検索サービス
* 会員登録などユーザー情報は管理しない
* 条件絞込みとキーワード検索機能（ユーザー・管理側両方）
* 企業情報と求人情報（ユーザー・管理側両方）
* 関連求人などのリコメンド機能
* 評判の星評価機能
* 簡単に編集も削除もできる管理画面
* 画面遷移しない単一ページの登録画面
* 一度に複数登録・追加も複数可能にする
* SEOで上位にしたい

## app概要

phpとjQueryとbootstrapで構築されたCMSプロジェクトです。

### 課題

* レンタルサーバーであった為、phpのみ使用可能
* cakePHPなどのフレームワークが使用できない
* nodeがない為jsフレームワークも不可
* wordpressやMovableTypeなどのCMSも不可
* リコメンドエンジンの実装はしたことがなった
* sentinelが使えない状態で認証しなければならない
* 企業情報や評価値は会社ごとに調べなければ分からない
* そもそもDBがない

## 開発環境

* php 7
* goutte.phar
* jquery 3.3.1
* bootstrap 4.0

## ディレクトリ構成

<pre>
myapp...プロジェクトディレクトリ
  ├── css ...cssファイル
  ├── edit_list ...管理画面用ディレクトリ
  │     ├── goutte.phar
  │     └── edit ...管理画面用コンポーネント
  ├── img ...画像ファイル
  ├── job_content ...ユーザー用コンポーネント
  ├── js ...jsファイル
  ├── index.html ...管理画面インデックス
  └── job_index.php ...ユーザー用インデックス
</pre>

## ポイント

### DBとデータ構造

* 入力フォームから多次元配列でJSが受け取りphpで整形しDBへ格納する
* 管理画面インデックスとDBならびにバックアップはアクセス制限ができる任意のサーバーやクラウドへ設置する
* 管理画面はベーシック認証を設置する

<pre>
{
  "data": {
      "id": [
          { ...企業単位
              "corp": { ...企業情報
                  "num": "00001",
                  "comp_name": "",
                  "comp_info": "",
                  "comp_key": [
                      ""
                  ],
                  "comp_code": null,
                  "comp_review": [
                      ""
                  ],
                  "comp_gyo": "",
                  "comp_gyokai": "",
                  "comp_taigu": null,
                  "comp_pr": "",
                  "comp_yukyu": "",
                  "comp_fukuri": "",
                  "comp_syouyo": "",
                  "comp_risyoku": "",
                  "comp_kinzoku": "",
                  "dom_code": null,
                  "review_val": [
                      [
                          0.0
                      ]
                  ],
                  "review_avg": 0.00
              },
              "time": 1000000000,
              "job": [ ...求人情報
                  {
                      "carr_syok": [
                          ""
                      ],
                      "carr_plc": [
                          ""
                      ],
                      "carr_app": "",
                      "carr_info": [
                          ""
                      ],
                      "carr_sty": [
                          ""
                      ],
                      "carr_sal": [
                          ""
                      ],
                      "carr_key": "",
                      "carr_url": "",
                      "carr_acaback": [
                          ""
                      ],
                      "carr_age": null,
                      "carr_overtime": null,
                      "carr_holy": [
                          ""
                      ],
                      "carr_time": 1000000000,
                      "carr_check": "完了"
                  },
              ]
          }, 
      ]
  }
}
</pre>

### ngram類似度計算関数

* 企業や求人のデータから必要情報だけ抜き出しngram関数で類似度を返してレコメンドを作成

<pre>
function get_ngram($str, $n, &$ngrams) {
	$str = preg_replace("/[　\t\n\r ]+/um", '', $str);
	$len = mb_strlen($str);
	if ($len <= 0 || $len <= $n)	return FALSE;

	$cnt = 0;
	for ($pos = 0; $pos < $len; $pos++) {
		$cc = mb_substr($str, $pos, $n);
		if (isset($cc)) {
			$ngrams[$cnt] = $cc;
			$cnt++;
		}
	}
	return $cnt;
}

function similar_ngram($sour, $dest) {
	$n = 3;		//N-gramのN数
	if (($n1 = get_ngram($sour, $n, $ngrams_sour)) == FALSE)	return FALSE;
	if (($n2 = get_ngram($dest, $n, $ngrams_dest)) == FALSE)	return FALSE;

	$result = count(array_intersect($ngrams_sour, $ngrams_dest));
	return (double)$result / $n2;
}
</pre>

###　自動入力

* goutteのスクレイピングで必要な情報を取得し自動入力する

<pre>
$client = new Client(); 
$goutteurl = '***/?code='.$comp_code.'.T';
$crawler = $client->request('GET', $goutteurl);
$dom_code3 = $crawler->filter('***')->each(function($node){
  if( $node->text() === "***"  || $node->text() === "***"){
    $dom_code2 = $node->nextAll()->text();
    return $dom_code2;
  }else{
    return false;
  }
});
</pre>

### SEO

* ページの文書構造化は当たり前だが、URIに日本語によるキーワードを入れるためクエリを繋げるような形式にし、
インデックスされるページ量を増やした

### 画面構成

* 開発環境の狭さと時間的なことで選定はbootstrapとjqueryの組み合わせ
* jquery UIやvue CDNでも良かったが機能が要件と異なるため自作する
* 親子cloneを駆使して画面遷移無しの管理画面や同時に複数登録などを実装

## 反省点

7,8年前のプロジェクト。久々のPHPによる開発という事で開発環境を知らずに調子に乗って自ら余計な提案をしてしまった。
短納期の安請け合いで見切り発車、気付けばとんでもないコードの行数になってしまった。
しかしながら、当時はまだ新しいサービスだったので何とか形にしたかった。
フォームからの値の型が数値になっているのに気付かずエラーに悩み、各種項目をもっと少なくすればよかった。
コードやデータの量が増えてしまったが当初は速度的に問題なかったが、レコメンド機能表示が徐々に遅くなってしまった。
html部分はもう少しテンプレート化や分離分割できたが余裕がないのがうかがえる。
個人情報などはないのでハッシュ化はしなかったが、セッション管理が甘くセキュリティ的に脆弱と感じる。
indeedやgoogleが競合になってしまい閉鎖する。
今となってはフレームワークのありがたみが分かる案件である。