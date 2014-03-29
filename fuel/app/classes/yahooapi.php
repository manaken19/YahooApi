<?php
define("APPLICATION_ID", "dj0zaiZpPVhpQXQ1d1RTNE43NyZzPWNvbnN1bWVyc2VjcmV0Jng9YjY-");
define("SEARCH_URL", "http://auctions.yahooapis.jp/AuctionWebService/V2/search");
define("DETAIL_URL", "http://auctions.yahooapis.jp/AuctionWebService/V2/auctionItem");
define("PARSE_URL", "http://jlp.yahooapis.jp/MAService/V1/parse");
define("MAX_STRING", 2750);

/**
 * Description of yahooApi
 * Yahooが提供するAPIを実行するクラス
 * 本クラスでは以下のAPIを実行することができる。
 * search: 商品検索
 * detail: 商品詳細データ取得
 * parse:　日本語形態素解析
 * 処理の詳細については各メソッドドキュメントを参照
 *
 * @author kenji.manabe
 */
class Yahooapi {
        /**
         * yahooの検索APIを呼び出し、商品の検索を行う
         * APIのレスポンスはxmlの形で返す
         * 
         * @param type $query  検索文字列
         * @param type $page   ページ数
         * @param type &$data  検索結果格納用（参照渡し）
         * 
         */
        public static function search($query, $page, &$data)
        {
            $auc_query = urlencode(mb_strcut($query, 0, MAX_STRING));
            $url = SEARCH_URL."?appid=".APPLICATION_ID."&query=$auc_query&page=$page&sort=end&order=d&type=all";
            $data["xml"] = YahooApi::callApi($url);

            if (isset($data["xml"])){
                $data["disp_pagenation"] = YahooApi::calcPage($data["xml"]->attributes());
            }
        }

        /**
         * yahooの商品詳細APIを呼び出し、詳細データを取得する。
         * APIのレスポンスはxmlの形で返す
         * 
         * @param type $id          商品ID
         * @param type $data        商品詳細データ格納用（参照渡し）
         * @param boolean $ary_flg  商品詳細データの形を配列に変換するか判定するフラグ
         */
        public static function detail($id, &$data, $ary_flg = FALSE)
        {
            $url = DETAIL_URL."?appid=".APPLICATION_ID."&auctionID=$id";
            $data["xml"] = YahooApi::callApi($url);

            if($ary_flg == TRUE){
                $data["xml"] = (array)$data["xml"]->Result;            
            }
        }

        /**
         * yahooの日本語形態素解析APIを呼び出し、形態素解析を行う
         * APIのレスポンスはxmlの形で返す
         * 
         * @param type $sentence 解析対象の文字列
         * @return SimpleXMLElement APIの結果をxmlに変換したもの
         */
        public static function parse($sentence)
        {
            $query = urlencode(mb_strcut($sentence, 0, MAX_STRING));
            $url = PARSE_URL."?appid=".APPLICATION_ID."&sentence=$query&result=ma";
            $xml = YahooApi::callApi($url);
            return $xml;
        }

        /**
         * API呼び出してXMLに変換して返す
         * 
         * @param string  $url APIのURL
         * @return SimpleXMLElement APIの結果をxmlに変換したもの
         */
        private static function callApi($url)
        {
            $response = file_get_contents($url);
            $parsed_xml = null;
            if(isset($response)){
                $parsed_xml = simplexml_load_string($response);
            }
            return $parsed_xml;
        }

        /**
         * 次へ、前へのリンクを表示させるか判定する
         * 
         * @param xml $attributes
         * @return array 次へ、前へのリンクを表示させるかどうかのbool型の配列
         */
        private static function calcPage($attributes) 
        {
            $currnt_num = intval($attributes->totalResultsReturned) + intval($attributes->firstResultPosition) - 1;
            $returnArray = array();
            $returnArray["next"] = $attributes->totalResultsAvailable > $currnt_num;
            $returnArray["prev"] = intval($attributes->firstResultPosition) != 1;
            return $returnArray;
        }
}
